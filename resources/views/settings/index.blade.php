@extends('layouts.app')

@section('header', 'Settings')

@section('content')
    <div
        class="max-w-6xl mx-auto bg-white p-8 rounded shadow mt-10 mb-16 bg-white rounded-lg shadow md:px-10 px-4 md:py-10 py-6">

        <h2 class="text-2xl font-bold mb-10">User Management</h2>
        <div class="mb-8"></div>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-4 flex flex-col md:flex-row md:items-center  gap-4" sty>
            <form method="GET" class="" style="margin-right: 900px;margin-top:10px;;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                    class="w-full border rounded px-3 py-2" />
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2 font-semibold">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="inline-block px-2 py-1 rounded {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-600' }}">{{ ucfirst($user->status) }}</span>
                            </td>
                            <td class="px-4 py-2">
                                <button onclick="openEditModal({{ $user->id }})"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6">{{ $users->links() }}</div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #888;
            cursor: pointer;
        }
    </style>
    <div id="editUserModal" class="modal-overlay">
        <div class="modal-box">
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
            <h3 class="text-lg font-bold mb-4">Edit User</h3>
            <form id="editUserForm" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Role</label>
                    <select name="role" id="editUserRole" class="border rounded px-2 py-1 w-full">
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" id="editUserStatus" class="border rounded px-2 py-1 w-full">
                        <option value="active">Active</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">New Password</label>
                    <input type="password" name="password" id="editUserPassword" class="border rounded px-2 py-1 w-full"
                        autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="editUserPasswordConfirmation"
                        class="border rounded px-2 py-1 w-full" autocomplete="new-password">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 rounded bg-gray-200 text-gray-700">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Store user data for JS
        const usersForJs = @json($usersForJs);
        function openEditModal(userId) {
            const modal = document.getElementById('editUserModal');
            const form = document.getElementById('editUserForm');
            const user = usersForJs.find(u => u.id === userId);
            if (!user) return;
            // Set form action
            form.action = user.editUrl;
            // Set role and status
            document.getElementById('editUserRole').value = user.role;
            document.getElementById('editUserStatus').value = user.status;
            // Clear password fields
            document.getElementById('editUserPassword').value = '';
            document.getElementById('editUserPasswordConfirmation').value = '';
            // Show modal
            modal.classList.add('active');
        }
        function closeEditModal() {
            document.getElementById('editUserModal').classList.remove('active');
        }
        // Optional: Close modal when clicking outside the box
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('editUserModal').addEventListener('click', function (e) {
                if (e.target === this) closeEditModal();
            });
        });
    </script>
@endsection