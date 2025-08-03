@extends('layouts.app')

@section('header', 'Schedule Maintenance')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Schedule Maintenance</h2>
    <form method="POST" action="{{ route('maintenance.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Asset</label>
            <select name="asset_id" class="w-full border rounded px-3 py-2">
                @foreach($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Maintenance Type</label>
            <select name="maintenance_type" class="w-full border rounded px-3 py-2">
                <option value="preventive">Preventive</option>
                <option value="corrective">Corrective</option>
                <option value="emergency">Emergency</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Service Date</label>
            <input type="date" name="service_date" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Next Service Due</label>
            <input type="date" name="next_service_due" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Cost</label>
            <input type="number" name="cost" step="0.01" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="scheduled">Scheduled</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Vendor</label>
            <select name="vendor_id" class="w-full border rounded px-3 py-2">
                <option value="">-- None --</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_recurring" id="is_recurring" class="mr-2">
            <label for="is_recurring" class="font-semibold">Recurring Maintenance</label>
        </div>
        <div class="mb-4 flex gap-2">
            <input type="number" name="recurrence_interval" min="1" placeholder="Interval" class="w-1/2 border rounded px-3 py-2">
            <select name="recurrence_unit" class="w-1/2 border rounded px-3 py-2">
                <option value="">Select Unit</option>
                <option value="days">Days</option>
                <option value="weeks">Weeks</option>
                <option value="months">Months</option>
                <option value="years">Years</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Schedule</button>
    </form>
</div>
@endsection