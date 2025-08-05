@extends('layouts.app')

@section('header', 'Asset Register')

@section('content')
    <div class="max-w-7xl mx-auto bg-white p-4 md:p-6 rounded shadow mt-8 mb-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
            <h2 class="text-xl md:text-2xl font-bold flex-1">Asset Register</h2>
        </div>
        <div class="flex flex-row justify-end gap-2 mb-2">
            <form id="asset-register-filter" method="GET" class="flex flex-row gap-2 items-center">
                <a href="{{ route('reports.asset-register.export', request()->all()) }}"
                    class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export to Excel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-32 h-10">Filter</button>
            </form>
        </div>
        <div class="overflow-x-auto pb-2 mb-4">
            <div class="flex flex-col gap-2 min-w-fit w-full">
                <div class="flex flex-row flex-wrap gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                        class="border rounded px-2 py-1 w-56" />
                    <select name="category_id" class="border rounded px-2 py-1 w-56">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select name="department_id" class="border rounded px-2 py-1 w-56">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @if(request('department_id') == $department->id) selected
                            @endif>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <select name="location_id" class="border rounded px-2 py-1 w-56">
                        <option value="">All Locations</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" @if(request('location_id') == $location->id) selected @endif>
                                {{ $location->name }}</option>
                        @endforeach
                    </select>
                    <select name="supplier_id" class="border rounded px-2 py-1 w-56">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @if(request('supplier_id') == $supplier->id) selected @endif>
                                {{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-row flex-wrap gap-2">
                    <select name="assigned_to" class="border rounded px-2 py-1 w-56">
                        <option value="">All Assigned Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if(request('assigned_to') == $user->id) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select name="condition" class="border rounded px-2 py-1 w-56">
                        <option value="">All Conditions</option>
                        <option value="excellent" @if(request('condition') == 'excellent') selected @endif>Excellent</option>
                        <option value="good" @if(request('condition') == 'good') selected @endif>Good</option>
                        <option value="fair" @if(request('condition') == 'fair') selected @endif>Fair</option>
                        <option value="poor" @if(request('condition') == 'poor') selected @endif>Poor</option>
                        <option value="damaged" @if(request('condition') == 'damaged') selected @endif>Damaged</option>
                    </select>
                    <select name="status" class="border rounded px-2 py-1 w-56">
                        <option value="">All Statuses</option>
                        <option value="active" @if(request('status') == 'active') selected @endif>Active</option>
                        <option value="inactive" @if(request('status') == 'inactive') selected @endif>Inactive</option>
                        <option value="maintenance" @if(request('status') == 'maintenance') selected @endif>Maintenance
                        </option>
                        <option value="retired" @if(request('status') == 'retired') selected @endif>Retired</option>
                        <option value="lost" @if(request('status') == 'lost') selected @endif>Lost</option>
                        <option value="damaged" @if(request('status') == 'damaged') selected @endif>Damaged</option>
                    </select>
                    <div class="flex flex-col ">
                        <label class="text-xs text-gray-500 mb-1">Purchase Date</label>
                        <div class="flex flex-row gap-1">
                            <input type="date" name="purchase_date_from" value="{{ request('purchase_date_from') }}"
                                class="border rounded px-2 py-1 w-56" placeholder="From" />
                            <input type="date" name="purchase_date_to" value="{{ request('purchase_date_to') }}"
                                class="border rounded px-2 py-1 w-56" placeholder="To" />
                        </div>
                    </div>
                </div>

                <div class="flex flex-col ">
                    <label class="text-xs text-gray-500 mb-1">Warranty Expiry</label>
                    <div class="flex flex-row gap-1">
                        <input type="date" name="warranty_expiry_from" value="{{ request('warranty_expiry_from') }}"
                            class="border rounded px-2 py-1 w-56" placeholder="From" />
                        <input type="date" name="warranty_expiry_to" value="{{ request('warranty_expiry_to') }}"
                            class="border rounded px-2 py-1 w-56" placeholder="To" />
                    </div>
                </div>



            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs border border-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr>
                        <th class="px-2 py-1 border">Asset Tag</th>
                        <th class="px-2 py-1 border">Name</th>
                        <th class="px-2 py-1 border">Category</th>
                        <th class="px-2 py-1 border">Department</th>
                        <th class="px-2 py-1 border">Location</th>
                        <th class="px-2 py-1 border">Status</th>
                        <th class="px-2 py-1 border">Current Value</th>
                        <th class="px-2 py-1 border">Purchase Date</th>
                        <th class="px-2 py-1 border">Purchase Cost</th>
                        <th class="px-2 py-1 border">Warranty Expiry</th>
                        <th class="px-2 py-1 border">Model</th>
                        <th class="px-2 py-1 border">Serial Number</th>
                        <th class="px-2 py-1 border">Manufacturer</th>
                        <th class="px-2 py-1 border">Condition</th>
                        <th class="px-2 py-1 border">Supplier</th>
                        <th class="px-2 py-1 border">Assigned User</th>
                        <th class="px-2 py-1 border">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $asset)
                        <tr class="hover:bg-blue-50">
                            <td class="px-2 py-1 border">{{ $asset->asset_tag }}</td>
                            <td class="px-2 py-1 border">{{ $asset->name }}</td>
                            <td class="px-2 py-1 border">{{ $asset->category->name ?? '' }}</td>
                            <td class="px-2 py-1 border">{{ $asset->department->name ?? '' }}</td>
                            <td class="px-2 py-1 border">{{ $asset->location->name ?? '' }}</td>
                            <td class="px-2 py-1 border">{{ ucfirst($asset->status) }}</td>
                            <td class="px-2 py-1 border">{{ number_format($asset->current_value, 2) }}</td>
                            <td class="px-2 py-1 border">{{ $asset->purchase_date }}</td>
                            <td class="px-2 py-1 border">{{ number_format($asset->purchase_cost, 2) }}</td>
                            <td class="px-2 py-1 border">{{ $asset->warranty_expiry }}</td>
                            <td class="px-2 py-1 border">{{ $asset->model }}</td>
                            <td class="px-2 py-1 border">{{ $asset->serial_number }}</td>
                            <td class="px-2 py-1 border">{{ $asset->manufacturer }}</td>
                            <td class="px-2 py-1 border">{{ ucfirst($asset->condition) }}</td>
                            <td class="px-2 py-1 border">{{ $asset->supplier->name ?? '' }}</td>
                            <td class="px-2 py-1 border">{{ $asset->assignedUser->name ?? '' }}</td>
                            <td class="px-2 py-1 border">{{ $asset->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="17" class="text-center py-4">No assets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-2 flex justify-end">
            {{ $assets->links() }}
        </div>
    </div>
@endsection