@extends('layouts.app')

@section('header', 'Assets')

@section('content')
<div class="space-y-6">
    <!-- Add Asset Button -->
    <!-- <button id="showAssetFormBtn" class="btn btn-primary mb-4">+ Add Asset</button> -->
    <!-- Inline Add Asset Form (hidden by default) -->
    <div id="assetFormSection" class="hidden mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Add New Asset</h2>
            <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                        <div>
                            <label for="asset_tag" class="block text-sm font-medium text-gray-700">Asset Tag *</label>
                            <input type="text" name="asset_tag" id="asset_tag" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Asset Name *</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                            <select name="category_id" id="category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                            <select name="department_id" id="department_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assigned To</label>
                            <select name="assigned_to" id="assigned_to" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Technical Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Technical Details</h3>
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                            <input type="text" name="model" id="model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="serial_number" class="block text-sm font-medium text-gray-700">Serial Number</label>
                            <input type="text" name="serial_number" id="serial_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="manufacturer" class="block text-sm font-medium text-gray-700">Manufacturer</label>
                            <input type="text" name="manufacturer" id="manufacturer" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="condition" class="block text-sm font-medium text-gray-700">Condition *</label>
                            <select name="condition" id="condition" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Condition</option>
                                <option value="excellent">Excellent</option>
                                <option value="good">Good</option>
                                <option value="fair">Fair</option>
                                <option value="poor">Poor</option>
                                <option value="damaged">Damaged</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Financial Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Financial Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="purchase_date" class="block text-sm font-medium text-gray-700">Purchase Date</label>
                            <input type="date" name="purchase_date" id="purchase_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="purchase_cost" class="block text-sm font-medium text-gray-700">Purchase Cost</label>
                            <input type="number" name="purchase_cost" id="purchase_cost" step="0.01" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="purchase_order_number" class="block text-sm font-medium text-gray-700">Purchase Order #</label>
                            <input type="text" name="purchase_order_number" id="purchase_order_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="warranty_expiry" class="block text-sm font-medium text-gray-700">Warranty Expiry</label>
                            <input type="date" name="warranty_expiry" id="warranty_expiry" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Add Asset
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
    document.getElementById('showAssetFormBtn').addEventListener('click', function() {
        document.getElementById('assetFormSection').classList.toggle('hidden');
    });
    </script>

    <!-- Header with Actions -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Assets</h1>
            <p class="text-gray-600">Manage your organization's assets</p>
        </div>
        <div class="flex space-x-3">
            @can('export assets')
            <a href="{{ route('assets.export') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export
            </a>
            @endcan
            @can('create assets')
            <a href="{{ route('assets.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Asset
            </a>
            @endcan
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="GET" action="{{ route('assets.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Asset tag, name, serial...">
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Department Filter -->
                <div>
                    <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                    <select name="department_id" id="department_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="retired" {{ request('status') == 'retired' ? 'selected' : '' }}>Retired</option>
                        <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                        <option value="damaged" {{ request('status') == 'damaged' ? 'selected' : '' }}>Damaged</option>
                    </select>
                </div>

                <!-- Assigned To Filter -->
                <div>
                    <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assigned To</label>
                    <select name="assigned_to" id="assigned_to" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('assets.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Clear Filters</a>
            </div>
        </form>
    </div>

    <!-- Assets Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($assets as $asset)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($asset->photo_path)
                                    <img class="h-10 w-10 rounded-lg object-cover mr-3" src="{{ Storage::url($asset->photo_path) }}" alt="{{ $asset->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $asset->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $asset->asset_tag }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $asset->category->name ?? 'No Category' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $asset->department->name ?? 'No Department' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $asset->assignedUser->name ?? 'Unassigned' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($asset->status === 'active') bg-green-100 text-green-800
                                @elseif($asset->status === 'maintenance') bg-yellow-100 text-yellow-800
                                @elseif($asset->status === 'retired') bg-gray-100 text-gray-800
                                @elseif($asset->status === 'lost') bg-red-100 text-red-800
                                @elseif($asset->status === 'damaged') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($asset->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($asset->current_value, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @can('view assets')
                                <a href="{{ route('assets.show', $asset) }}" class="text-blue-600 hover:text-blue-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                @endcan
                                <a href="{{ route('assets.edit', $asset) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Edit</a>
                                @can('delete assets')
                                <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this asset?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No assets found.
                            @can('create assets')
                            <a href="{{ route('assets.create') }}" class="text-blue-600 hover:text-blue-900">Create your first asset</a>
                            @endcan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($assets->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $assets->links() }}
        </div>
        @endif
    </div>
</div>
@endsection