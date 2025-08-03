@extends('layouts.app')

@section('header', 'Maintenance')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="flex flex-row gap-6 mb-10 overflow-x-auto pb-2">
        <div class="flex-1 flex flex-col items-center bg-white rounded-xl shadow-lg border-t-4 border-blue-500 p-6">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-100 mb-3">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="text-3xl font-extrabold text-blue-700">{{ $total ?? 0 }}</div>
            <div class="text-gray-600 mt-1 font-medium">Total Maintenance</div>
        </div>
        <div class="flex-1 flex flex-col items-center bg-white rounded-xl shadow-lg border-t-4 border-green-500 p-6">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-green-100 mb-3">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="text-3xl font-extrabold text-green-700">{{ $upcoming ?? 0 }}</div>
            <div class="text-gray-600 mt-1 font-medium">Upcoming</div>
        </div>
        <div class="flex-1 flex flex-col items-center bg-white rounded-xl shadow-lg border-t-4 border-yellow-400 p-6">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-yellow-100 mb-3">
                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="text-3xl font-extrabold text-yellow-600">{{ $overdue ?? 0 }}</div>
            <div class="text-gray-600 mt-1 font-medium">Overdue</div>
        </div>
        <div class="flex-1 flex flex-col items-center bg-white rounded-xl shadow-lg border-t-4 border-gray-400 p-6">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gray-200 mb-3">
                <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="text-3xl font-extrabold text-gray-700">{{ $completed ?? 0 }}</div>
            <div class="text-gray-600 mt-1 font-medium">Completed</div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6" style="margin-top: 20px;">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Recent Maintenance</h1>
        <table class="min-w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 border">Asset</th>
                    <th class="px-3 py-2 border">Type</th>
                    <th class="px-3 py-2 border">Service Date</th>
                    <th class="px-3 py-2 border">Status</th>
                    <th class="px-3 py-2 border">Vendor</th>
                    <th class="px-3 py-2 border">Cost</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent ?? [] as $m)
                <tr>
                    <td class="px-3 py-2 border">{{ $m->asset->name ?? '-' }}</td>
                    <td class="px-3 py-2 border">{{ ucfirst($m->maintenance_type) }}</td>
                    <td class="px-3 py-2 border">{{ $m->service_date ? $m->service_date->format('Y-m-d') : '-' }}</td>
                    <td class="px-3 py-2 border">{{ ucfirst($m->status) }}</td>
                    <td class="px-3 py-2 border">{{ $m->vendor->name ?? '-' }}</td>
                    <td class="px-3 py-2 border">{{ $m->cost ? number_format($m->cost, 2) : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No recent maintenance records.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection