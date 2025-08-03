<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Land Register Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('land-register.edit', $landRegister) }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('land-register.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description of Land</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->description_of_land }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mode of Acquisition</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->acquisition_mode_display }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->category_display }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">County</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->county }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nearest Town/Location</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->nearest_town_location }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">GPS Coordinates</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->gps_coordinates ?: 'Not specified' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Land Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Land Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Size (hectares)</label>
                                <p class="mt-1 text-sm text-gray-900">{{ number_format($landRegister->size_hectares, 4) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ownership Status</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->ownership_status_display }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Acquisition Date</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->acquisition_date?->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">L.R/Certificate No.</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->lr_certificate_number ?: 'Not specified' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Disputed Status</label>
                                <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $landRegister->disputed_status === 'disputed' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $landRegister->disputed_status_display }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Registration Date</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->registration_date?->format('M d, Y') ?: 'Not specified' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Document of Ownership</label>
                                @if($landRegister->document_of_ownership_path)
                                    <a href="{{ $landRegister->document_of_ownership_url }}" target="_blank"
                                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        View Document
                                    </a>
                                @else
                                    <p class="text-sm text-gray-500">No document uploaded</p>
                                @endif
                            </div>

                            <div class="p-4 border border-gray-200 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Zonal Maps/Land Index</label>
                                @if($landRegister->zonal_maps_path)
                                    <a href="{{ $landRegister->zonal_maps_url }}" target="_blank"
                                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        View Document
                                    </a>
                                @else
                                    <p class="text-sm text-gray-500">No document uploaded</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Proprietorship Details</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->proprietorship_details }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Purpose/Use of Land</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->purpose_use_of_land }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Encumbrances</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->encumbrances ?: 'None specified' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Remarks</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $landRegister->remarks ?: 'No remarks' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Financial Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Acquisition Amount</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $landRegister->acquisition_amount ? 'KES ' . number_format($landRegister->acquisition_amount, 2) : 'Not specified' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fair Value</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $landRegister->fair_value ? 'KES ' . number_format($landRegister->fair_value, 2) : 'Not specified' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Annual Rental Income</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $landRegister->annual_rental_income ? 'KES ' . number_format($landRegister->annual_rental_income, 2) : 'Not specified' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Disposal Information (if applicable) -->
                    @if($landRegister->disposal_date)
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Disposal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Disposal Date</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $landRegister->disposal_date->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Disposal Value</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $landRegister->disposal_value ? 'KES ' . number_format($landRegister->disposal_value, 2) : 'Not specified' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="border-t pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Created</label>
                                <p class="mt-1">{{ $landRegister->created_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <p class="mt-1">{{ $landRegister->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>