@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Create User</h2>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="w-full border rounded" required>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border rounded" required>
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border rounded" required>
        </div>
        <div class="mb-4">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
    </form>
</div>
@endsection