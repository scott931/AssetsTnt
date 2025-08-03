@extends('layouts.app')

@section('header', 'Asset Transfer Details')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow mt-8 mb-12">
    <h2 class="text-2xl font-bold mb-6">Asset Transfer #{{ $transfer->id }}</h2>
    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <div><span class="font-semibold">Initiator:</span> {{ $transfer->initiator->name ?? '-' }}</div>
            <div><span class="font-semibold">To User:</span> {{ $transfer->toUser->name ?? '-' }}</div>
            <div><span class="font-semibold">To Department:</span> {{ $transfer->toDepartment->name ?? '-' }}</div>
            <div><span class="font-semibold">To Location:</span> {{ $transfer->toLocation->name ?? '-' }}</div>
            <div><span class="font-semibold">Type:</span> {{ ucfirst($transfer->transfer_type) }}</div>
            <div><span class="font-semibold">Scheduled:</span> {{ $transfer->scheduled_at ? date('Y-m-d', strtotime($transfer->scheduled_at)) : '-' }}</div>
            <div><span class="font-semibold">Status:</span> <span class="capitalize">{{ $transfer->status }}</span></div>
        </div>
        <div>
            <div><span class="font-semibold">Comments:</span> {{ $transfer->comments ?? '-' }}</div>
            <div class="mt-2"><span class="font-semibold">Assets:</span>
                <ul class="list-disc ml-6">
                    @foreach($transfer->assets as $asset)
                        <li>{{ $asset->name }} ({{ $asset->asset_tag }}) - {{ $asset->category->name ?? '-' }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <hr class="my-6">
    <h3 class="text-xl font-semibold mb-4">Approval Workflow</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full border text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-3 py-2 border">Order</th>
                    <th class="px-3 py-2 border">Approver</th>
                    <th class="px-3 py-2 border">Role</th>
                    <th class="px-3 py-2 border">Status</th>
                    <th class="px-3 py-2 border">Timestamp</th>
                    <th class="px-3 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfer->approvals->sortBy('order') as $approval)
                    <tr>
                        <td class="px-3 py-2 border text-center">{{ $approval->order }}</td>
                        <td class="px-3 py-2 border">{{ $approval->user->name ?? '-' }}</td>
                        <td class="px-3 py-2 border">{{ $approval->role }}</td>
                        <td class="px-3 py-2 border capitalize">
                            @if($approval->status == 'pending')
                                <span class="text-yellow-600 font-semibold">Pending</span>
                            @elseif($approval->status == 'approved')
                                <span class="text-green-600 font-semibold">Approved</span>
                            @elseif($approval->status == 'rejected')
                                <span class="text-red-600 font-semibold">Rejected</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 border">{{ $approval->updated_at ? $approval->updated_at->format('Y-m-d H:i') : '-' }}</td>
                        <td class="px-3 py-2 border text-center">
                            @php
                                $isCurrentApprover = auth()->id() == $approval->user_id;
                                $isPending = $approval->status == 'pending';
                                $isFirstPending = $transfer->approvals->sortBy('order')->firstWhere('status', 'pending')->id == $approval->id;
                            @endphp
                            @if($isCurrentApprover && $isPending && $isFirstPending)
                                <form method="POST" action="{{ route('transfers.approve', $transfer) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('transfers.reject', $transfer) }}" class="inline ml-2">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700">Reject</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <a href="{{ route('transfers.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700">Back to Transfers</a>
    </div>
</div>
@endsection