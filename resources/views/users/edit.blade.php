@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded" required>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded" required>
        </div>
        <div class="mb-4">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border rounded">
        </div>
        <div class="mb-4">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection