<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $query = User::query();
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%");
            });
        }
        $users = $query->orderBy('name')->paginate(10)->withQueryString();
        $roles = ['admin', 'user', 'manager'];
        $usersForJs = $users->map(function($u) {
            return [
                'id' => $u->id,
                'role' => $u->role,
                'status' => $u->status,
                'editUrl' => route('settings.user.update', $u),
            ];
        });
        return view('settings.index', [
            'users' => $users,
            'roles' => $roles,
            'usersForJs' => $usersForJs,
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|string']);
        $user->role = $request->role;
        $user->save();
        return back()->with('success', 'Role updated successfully.');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate(['password' => 'required|string|min:8|confirmed']);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Password updated successfully.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $user->status = $user->status === 'active' ? 'suspended' : 'active';
        $user->save();
        return back()->with('success', 'User status updated.');
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'nullable|string',
            'status' => 'nullable|in:active,suspended',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (isset($validated['role'])) {
            $user->role = $validated['role'];
        }
        if (isset($validated['status'])) {
            $user->status = $validated['status'];
        }
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();
        return back()->with('success', 'User updated successfully.');
    }
}
