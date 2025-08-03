@extends('layouts.app')

@section('header', 'Initiate Asset Transfer')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow mt-8 mb-12">
    <h2 class="text-2xl font-bold mb-6">Initiate Asset Transfer</h2>
    <form method="POST" action="#">
        @csrf
        <div class="mb-4">
            <label class="block font-medium mb-1">Select Assets <span class="text-red-500">*</span></label>
            <select name="assets[]" multiple required class="w-full border rounded px-3 py-2">
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }} ({{ $asset->asset_tag }})</option>
                @endforeach
            </select>
            <small class="text-gray-500">Hold Ctrl/Cmd to select multiple assets.</small>
        </div>
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block font-medium mb-1">To User</label>
                <select name="to_user_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- None --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium mb-1">To Department</label>
                <select name="to_department_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- None --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium mb-1">To Location</label>
                <select name="to_location_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- None --</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Transfer Type</label>
                <select name="transfer_type" class="w-full border rounded px-3 py-2">
                    <option value="permanent">Permanent</option>
                    <option value="temporary">Temporary (Loan)</option>
                </select>
            </div>
            <div>
                <label class="block font-medium mb-1">Scheduled Date</label>
                <input type="date" name="scheduled_at" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Comments / Reason</label>
            <textarea name="comments" rows="3" class="w-full border rounded px-3 py-2"></textarea>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('transfers.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700">Cancel</a>
            <button type="submit" class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 font-semibold">Submit Transfer</button>
        </div>
    </form>
</div>
@endsection