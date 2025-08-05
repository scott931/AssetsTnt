@extends('layouts.app')

@section('header', 'Reports')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 mt-12 mb-16 px-4">
    <div class="bg-white rounded-lg shadow md:px-10 px-4 md:py-10 py-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Reports & Analytics</h1>
        <p class="text-gray-700 mb-6">Access comprehensive reports, analytics, and insights for your assets and operations. All reports support Excel export functionality.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Asset Reports -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-blue-900 mb-4">Asset Management Reports</h2>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-blue-700">Asset Register</span>
                            <p class="text-gray-600 text-sm">Complete asset inventory with filters and Excel export</p>
                        </div>
                        <a href="{{ route('reports.asset-register') }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">View</a>
                    </li>
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-gray-700">Depreciation Report</span>
                            <p class="text-gray-600 text-sm">Asset depreciation tracking and analysis</p>
                        </div>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm">Coming Soon</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-gray-700">Maintenance History</span>
                            <p class="text-gray-600 text-sm">Maintenance records and schedules</p>
                        </div>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm">Coming Soon</span>
                    </li>
                </ul>
            </div>

            <!-- Property Reports -->
            <div class="bg-green-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-green-900 mb-4">Property Management Reports</h2>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-green-700">Land Register</span>
                            <p class="text-gray-600 text-sm">Land properties with ownership details and Excel export</p>
                        </div>
                        <a href="{{ route('reports.land-register') }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">View</a>
                    </li>
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-green-700">Building Register</span>
                            <p class="text-gray-600 text-sm">Building properties with specifications and Excel export</p>
                        </div>
                        <a href="{{ route('reports.building-register') }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">View</a>
                    </li>
                </ul>
            </div>

            <!-- Organization Reports -->
            <div class="bg-purple-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-purple-900 mb-4">Organization Reports</h2>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-purple-700">Departments</span>
                            <p class="text-gray-600 text-sm">Department listing with budgets and Excel export</p>
                        </div>
                        <a href="{{ route('reports.departments') }}" class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">View</a>
                    </li>
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-purple-700">Users</span>
                            <p class="text-gray-600 text-sm">User management with roles and Excel export</p>
                        </div>
                        <a href="{{ route('reports.users') }}" class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">View</a>
                    </li>
                </ul>
            </div>

            <!-- Operational Reports -->
            <div class="bg-orange-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-orange-900 mb-4">Operational Reports</h2>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-gray-700">Movement Log</span>
                            <p class="text-gray-600 text-sm">Asset transfers and movements tracking</p>
                        </div>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm">Coming Soon</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-gray-700">Lost/Damaged Report</span>
                            <p class="text-gray-600 text-sm">Lost or damaged assets analysis</p>
                        </div>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm">Coming Soon</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-semibold text-gray-700">Audit Log</span>
                            <p class="text-gray-600 text-sm">System activity and change tracking</p>
                        </div>
                        <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded text-sm">Coming Soon</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="mt-8 p-6 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Statistics</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ \App\Models\Asset::count() }}</div>
                    <div class="text-sm text-gray-600">Total Assets</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ \App\Models\LandRegister::count() }}</div>
                    <div class="text-sm text-gray-600">Land Properties</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-purple-600">{{ \App\Models\BuildingRegister::count() }}</div>
                    <div class="text-sm text-gray-600">Buildings</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-orange-600">{{ \App\Models\User::count() }}</div>
                    <div class="text-sm text-gray-600">Users</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection