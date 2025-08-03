@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- Total Assets -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Assets</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalAssets }}</p>
                </div>
            </div>
        </div>

        <!-- Active Assets -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Assets</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activeAssets }}</p>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Categories</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <!-- Departments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Departments</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalDepartments }}</p>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Users</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Assets by Category Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Assets by Category</h3>
            <div class="space-y-3">
                @foreach($assetsByCategory as $category)
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">{{ $category->name }}</span>
                    <div class="flex items-center">
                        <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                            @php
                                $percentage = $totalAssets > 0 ? ($category->assets_count / $totalAssets) * 100 : 0;
                            @endphp
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $category->assets_count }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Assets -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Assets</h3>
            <div class="space-y-3">
                @foreach($recentAssets as $asset)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">{{ $asset->name }}</p>
                        <p class="text-sm text-gray-600">{{ $asset->category->name ?? 'No Category' }}</p>
                    </div>
                    <span class="text-sm text-gray-500">{{ $asset->created_at->diffForHumans() }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Alerts and Notifications Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Upcoming Maintenance -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Maintenance</h3>
            @if($upcomingMaintenance->count() > 0)
                <div class="space-y-3">
                    @foreach($upcomingMaintenance as $maintenance)
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">{{ $maintenance->asset->name }}</p>
                            <p class="text-sm text-gray-600">{{ $maintenance->title }}</p>
                        </div>
                        <span class="text-sm text-yellow-600 font-medium">
                            {{ $maintenance->next_service_due->format('M d, Y') }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No upcoming maintenance</p>
            @endif
        </div>

        <!-- Overdue Assignments -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Overdue Assignments</h3>
            @if($overdueAssignments->count() > 0)
                <div class="space-y-3">
                    @foreach($overdueAssignments as $assignment)
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">{{ $assignment->asset->name }}</p>
                            <p class="text-sm text-gray-600">{{ $assignment->assignedUser->name ?? 'Unassigned' }}</p>
                        </div>
                        <span class="text-sm text-red-600 font-medium">
                            {{ $assignment->expected_return_at->diffForHumans() }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No overdue assignments</p>
            @endif
        </div>
    </div>

    <!-- Top Depreciating Assets -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Depreciating Assets</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchase Cost</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Depreciation Rate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Value</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($topDepreciatingAssets as $asset)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $asset->name }}</div>
                            <div class="text-sm text-gray-500">{{ $asset->asset_tag }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $asset->category->name ?? 'No Category' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($asset->purchase_cost, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $asset->depreciation_rate }}%
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($asset->current_value, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
