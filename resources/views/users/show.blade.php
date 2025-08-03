@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">User Details</h2>
    <div class="mb-4">
        <strong>Name:</strong> {{ $user->name }}
    </div>
    <div class="mb-4">
        <strong>Email:</strong> {{ $user->email }}
    </div>
    <a href="{{ route('users.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Back to List</a>
</div>
@endsection