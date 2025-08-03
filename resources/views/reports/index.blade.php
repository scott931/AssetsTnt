@extends('layouts.app')

@section('header', 'Reports')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 mt-12 mb-16 px-4">
    <div class="bg-white rounded-lg shadow md:px-10 px-4 md:py-10 py-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Reports & Analytics</h1>
        <p class="text-gray-700 mb-6">Access comprehensive reports, analytics, and insights for your assets and operations. Below are the available and upcoming reports:</p>
        <ul class="divide-y divide-gray-200">
            <li class="py-4 flex items-center justify-between">
                <div>
                    <span class="font-semibold text-lg text-blue-700">Asset Register / Export</span>
                    <p class="text-gray-600 text-sm">View and export a complete list of all assets, with filters and CSV export.</p>
                </div>
                <a href="{{ route('reports.asset-register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View</a>
            </li>
            <li class="py-4 flex items-center justify-between">
                <div>
                    <span class="font-semibold text-lg text-gray-700">Depreciation Report</span>
                    <p class="text-gray-600 text-sm">Track asset depreciation over time for accounting and compliance.</p>
                </div>
                <span class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Coming Soon</span>
            </li>
            <li class="py-4 flex items-center justify-between">
                <div>
                    <span class="font-semibold text-lg text-gray-700">Maintenance History</span>
                    <p class="text-gray-600 text-sm">View all maintenance records for assets, with filters and export options.</p>
                </div>
                <span class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Coming Soon</span>
            </li>
            <li class="py-4 flex items-center justify-between">
                <div>
                    <span class="font-semibold text-lg text-gray-700">Movement Log</span>
                    <p class="text-gray-600 text-sm">Track asset transfers and movements between locations and departments.</p>
                </div>
                <span class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Coming Soon</span>
            </li>
            <li class="py-4 flex items-center justify-between">
                <div>
                    <span class="font-semibold text-lg text-gray-700">Lost/Damaged Report</span>
                    <p class="text-gray-600 text-sm">List and analyze assets marked as lost or damaged.</p>
                </div>
                <span class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Coming Soon</span>
            </li>
        </ul>
    </div>
</div>
@endsection