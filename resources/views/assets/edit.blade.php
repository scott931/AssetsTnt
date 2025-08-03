@extends('layouts.app')

@section('header', 'Edit Asset')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Asset</h1>
                <p class="text-gray-600">Update asset record</p>
            </div>
            <a href="{{ route('assets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Assets
            </a>
        </div>
        <form action="{{ route('assets.update', $asset) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    <div>
                        <label for="asset_tag" class="block text-sm font-medium text-gray-700">Asset Tag *</label>
                        <input type="text" name="asset_tag" id="asset_tag" value="{{ old('asset_tag', $asset->asset_tag) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('asset_tag')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Asset Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $asset->name) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $asset->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category *</label>
                        <select name="category_id" id="category_id" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                        <select name="department_id" id="department_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id', $asset->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assigned To</label>
                        <select name="assigned_to" id="assigned_to"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_to', $asset->assigned_to) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Technical Details -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Technical Details</h3>
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" id="model" value="{{ old('model', $asset->model) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('model')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="serial_number" class="block text-sm font-medium text-gray-700">Serial Number</label>
                        <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $asset->serial_number) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('serial_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="manufacturer" class="block text-sm font-medium text-gray-700">Manufacturer</label>
                        <input type="text" name="manufacturer" id="manufacturer" value="{{ old('manufacturer', $asset->manufacturer) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('manufacturer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $asset->location) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700">Condition *</label>
                        <select name="condition" id="condition" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Condition</option>
                            <option value="excellent" {{ old('condition', $asset->condition) == 'excellent' ? 'selected' : '' }}>Excellent</option>
                            <option value="good" {{ old('condition', $asset->condition) == 'good' ? 'selected' : '' }}>Good</option>
                            <option value="fair" {{ old('condition', $asset->condition) == 'fair' ? 'selected' : '' }}>Fair</option>
                            <option value="poor" {{ old('condition', $asset->condition) == 'poor' ? 'selected' : '' }}>Poor</option>
                            <option value="damaged" {{ old('condition', $asset->condition) == 'damaged' ? 'selected' : '' }}>Damaged</option>
                        </select>
                        @error('condition')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Financial Information -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Financial Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="purchase_date" class="block text-sm font-medium text-gray-700">Purchase Date</label>
                        <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date', $asset->purchase_date ? \Illuminate\Support\Carbon::parse($asset->purchase_date)->format('Y-m-d') : null) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('purchase_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="purchase_cost" class="block text-sm font-medium text-gray-700">Purchase Cost</label>
                        <input type="number" name="purchase_cost" id="purchase_cost" value="{{ old('purchase_cost', $asset->purchase_cost) }}" step="0.01" min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('purchase_cost')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="purchase_order_number" class="block text-sm font-medium text-gray-700">Purchase Order #</label>
                        <input type="text" name="purchase_order_number" id="purchase_order_number" value="{{ old('purchase_order_number', $asset->purchase_order_number) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('purchase_order_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="warranty_expiry" class="block text-sm font-medium text-gray-700">Warranty Expiry</label>
                        <input type="date" name="warranty_expiry" id="warranty_expiry" value="{{ old('warranty_expiry', $asset->warranty_expiry ? \Illuminate\Support\Carbon::parse($asset->warranty_expiry)->format('Y-m-d') : null) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('warranty_expiry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="depreciation_rate" class="block text-sm font-medium text-gray-700">Depreciation Rate (%) *</label>
                        <input type="number" name="depreciation_rate" id="depreciation_rate" value="{{ old('depreciation_rate', $asset->depreciation_rate) }}" step="0.01" min="0" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('depreciation_rate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                        <select name="supplier_id" id="supplier_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $asset->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="depreciation_method" class="block text-sm font-medium text-gray-700">Depreciation Method *</label>
                        <select name="depreciation_method" id="depreciation_method" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="straight_line" {{ old('depreciation_method', $asset->depreciation_method) == 'straight_line' ? 'selected' : '' }}>Straight Line</option>
                            <option value="declining_balance" {{ old('depreciation_method', $asset->depreciation_method) == 'declining_balance' ? 'selected' : '' }}>Declining Balance</option>
                        </select>
                        @error('depreciation_method')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="depreciation_start_date" class="block text-sm font-medium text-gray-700">Depreciation Start Date</label>
                        <input type="date" name="depreciation_start_date" id="depreciation_start_date" value="{{ old('depreciation_start_date', $asset->depreciation_start_date ? \Illuminate\Support\Carbon::parse($asset->depreciation_start_date)->format('Y-m-d') : null) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('depreciation_start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select name="status" id="status" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="active" {{ old('status', $asset->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $asset->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="maintenance" {{ old('status', $asset->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="retired" {{ old('status', $asset->status) == 'retired' ? 'selected' : '' }}>Retired</option>
                            <option value="lost" {{ old('status', $asset->status) == 'lost' ? 'selected' : '' }}>Lost</option>
                            <option value="damaged" {{ old('status', $asset->status) == 'damaged' ? 'selected' : '' }}>Damaged</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- File Uploads -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Files</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @if($asset->photo_path)
                            <div class="mt-2">
                                <img src="{{ Storage::url($asset->photo_path) }}" alt="Asset Photo" class="h-16 w-16 object-cover rounded">
                            </div>
                        @endif
                        @error('photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="manual" class="block text-sm font-medium text-gray-700">Manual</label>
                        <input type="file" name="manual" id="manual" accept=".pdf,.doc,.docx"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @if($asset->manual_path)
                            <div class="mt-2">
                                <a href="{{ Storage::url($asset->manual_path) }}" target="_blank" class="text-blue-600 hover:underline">View Manual</a>
                            </div>
                        @endif
                        @error('manual')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="receipt" class="block text-sm font-medium text-gray-700">Receipt</label>
                        <input type="file" name="receipt" id="receipt" accept=".pdf,.jpg,.jpeg,.png"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @if($asset->receipt_path)
                            <div class="mt-2">
                                <a href="{{ Storage::url($asset->receipt_path) }}" target="_blank" class="text-blue-600 hover:underline">View Receipt</a>
                            </div>
                        @endif
                        @error('receipt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('assets.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700">Cancel</a>
                <button type="submit" class="px-6 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 font-semibold">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection