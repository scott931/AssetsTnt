<?php

namespace App\Http\Controllers;

use App\Models\AssetTransfer;
use App\Models\Asset;
use App\Models\Department;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Notifications\TransferApprovalRequested;
use App\Notifications\TransferFinalized;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = AssetTransfer::with(['assets', 'initiator', 'fromUser', 'toUser', 'fromDepartment', 'toDepartment', 'fromLocation', 'toLocation'])
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        $assets = Asset::all();
        $departments = Department::all();
        $users = User::all();
        $locations = Location::all();
        return view('transfers.create', compact('assets', 'departments', 'users', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'assets' => 'required|array|min:1',
            'assets.*' => 'exists:assets,id',
            'to_user_id' => 'nullable|exists:users,id',
            'to_department_id' => 'nullable|exists:departments,id',
            'to_location_id' => 'nullable|exists:locations,id',
            'transfer_type' => 'required|in:permanent,temporary',
            'scheduled_at' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        // Create the transfer
        $transfer = new \App\Models\AssetTransfer();
        $transfer->initiator_id = auth()->id();
        $transfer->to_user_id = $validated['to_user_id'] ?? null;
        $transfer->to_department_id = $validated['to_department_id'] ?? null;
        $transfer->to_location_id = $validated['to_location_id'] ?? null;
        $transfer->transfer_type = $validated['transfer_type'];
        $transfer->scheduled_at = $validated['scheduled_at'] ?? null;
        $transfer->comments = $validated['comments'] ?? null;
        $transfer->status = 'pending';
        $transfer->save();

        // Attach assets
        $transfer->assets()->attach($validated['assets']);

        // Determine required approvals
        $requiredApprovals = [];
        $assets = \App\Models\Asset::whereIn('id', $validated['assets'])->get();

        // 1. Always require destination department head
        if ($transfer->to_department_id) {
            $deptHead = \App\Models\User::where('department_id', $transfer->to_department_id)
                ->whereHas('roles', function($q){ $q->where('name', 'Department Head'); })
                ->first();
            if ($deptHead) {
                $requiredApprovals[] = [
                    'user_id' => $deptHead->id,
                    'role' => 'Department Head',
                ];
            }
        }

        // 2. Finance Manager if any asset > $1,000
        $financeNeeded = $assets->contains(function($asset){ return $asset->value > 1000; });
        if ($financeNeeded) {
            $financeManager = \App\Models\User::whereHas('roles', function($q){ $q->where('name', 'Finance Manager'); })->first();
            if ($financeManager) {
                $requiredApprovals[] = [
                    'user_id' => $financeManager->id,
                    'role' => 'Finance Manager',
                ];
            }
        }

        // 3. IT Admin if any asset is IT equipment
        $itNeeded = $assets->contains(function($asset){ return $asset->category && stripos($asset->category->name, 'IT') !== false; });
        if ($itNeeded) {
            $itAdmin = \App\Models\User::whereHas('roles', function($q){ $q->where('name', 'IT Admin'); })->first();
            if ($itAdmin) {
                $requiredApprovals[] = [
                    'user_id' => $itAdmin->id,
                    'role' => 'IT Admin',
                ];
            }
        }

        // Create TransferApproval records in order
        foreach ($requiredApprovals as $order => $approval) {
            $transfer->approvals()->create([
                'user_id' => $approval['user_id'],
                'role' => $approval['role'],
                'status' => 'pending',
                'order' => $order + 1,
            ]);
        }

        // Notify the first approver
        $firstApproval = $transfer->approvals()->orderBy('order')->first();
        if ($firstApproval && $firstApproval->user) {
            $firstApproval->user->notify(new TransferApprovalRequested($transfer, $firstApproval));
        }

        return redirect()->route('transfers.index')->with('success', 'Asset transfer initiated and pending approvals.');
    }

    public function show(\App\Models\AssetTransfer $transfer)
    {
        $transfer->load(['assets.category', 'approvals.user', 'initiator', 'toUser', 'toDepartment', 'toLocation']);
        return view('transfers.show', compact('transfer'));
    }

    public function approve(\App\Models\AssetTransfer $transfer)
    {
        $userId = auth()->id();
        $approval = $transfer->approvals()->where('status', 'pending')->orderBy('order')->first();
        if (!$approval || $approval->user_id !== $userId) {
            return back()->with('error', 'You are not authorized to approve this transfer at this stage.');
        }
        $approval->status = 'approved';
        $approval->save();

        // If there are no more pending approvals, mark transfer as approved
        $pending = $transfer->approvals()->where('status', 'pending')->count();
        if ($pending === 0) {
            $transfer->status = 'approved';
            $transfer->save();
            // Notify initiator
            if ($transfer->initiator) {
                $transfer->initiator->notify(new TransferFinalized($transfer, 'approved'));
            }
        } else {
            // Notify next approver
            $nextApproval = $transfer->approvals()->where('status', 'pending')->orderBy('order')->first();
            if ($nextApproval && $nextApproval->user) {
                $nextApproval->user->notify(new TransferApprovalRequested($transfer, $nextApproval));
            }
        }
        return back()->with('success', 'Transfer approved.');
    }

    public function reject(\App\Models\AssetTransfer $transfer)
    {
        $userId = auth()->id();
        $approval = $transfer->approvals()->where('status', 'pending')->orderBy('order')->first();
        if (!$approval || $approval->user_id !== $userId) {
            return back()->with('error', 'You are not authorized to reject this transfer at this stage.');
        }
        $approval->status = 'rejected';
        $approval->save();
        $transfer->status = 'rejected';
        $transfer->save();
        // Notify initiator
        if ($transfer->initiator) {
            $transfer->initiator->notify(new TransferFinalized($transfer, 'rejected'));
        }
        return back()->with('success', 'Transfer rejected.');
    }
}