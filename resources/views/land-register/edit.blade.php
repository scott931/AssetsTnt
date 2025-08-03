<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Land Register Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('land-register.update', $landRegister) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="description_of_land" value="Description of Land" />
                                <x-text-input id="description_of_land" name="description_of_land" type="text" class="mt-1 block w-full"
                                             value="{{ old('description_of_land', $landRegister->description_of_land) }}" required />
                                <x-input-error :messages="$errors->get('description_of_land')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="mode_of_acquisition" value="Mode of Acquisition" />
                                <select id="mode_of_acquisition" name="mode_of_acquisition" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Select Mode</option>
                                    <option value="purchase" {{ old('mode_of_acquisition', $landRegister->mode_of_acquisition) == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                    <option value="transfer" {{ old('mode_of_acquisition', $landRegister->mode_of_acquisition) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                    <option value="donation" {{ old('mode_of_acquisition', $landRegister->mode_of_acquisition) == 'donation' ? 'selected' : '' }}>Donation</option>
                                    <option value="inheritance" {{ old('mode_of_acquisition', $landRegister->mode_of_acquisition) == 'inheritance' ? 'selected' : '' }}>Inheritance</option>
                                    <option value="gift" {{ old('mode_of_acquisition', $landRegister->mode_of_acquisition) == 'gift' ? 'selected' : '' }}>Gift</option>
                                    <option value="other" {{ old('mode_of_acquisition', $landRegister->mode_of_acquisition) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <x-input-error :messages="$errors->get('mode_of_acquisition')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="category" value="Category" />
                                <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Select Category</option>
                                    <option value="land" {{ old('category', $landRegister->category) == 'land' ? 'selected' : '' }}>Land</option>
                                    <option value="investment_property" {{ old('category', $landRegister->category) == 'investment_property' ? 'selected' : '' }}>Investment Property</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="county" value="County" />
                                <x-text-input id="county" name="county" type="text" class="mt-1 block w-full"
                                             value="{{ old('county', $landRegister->county) }}" required />
                                <x-input-error :messages="$errors->get('county')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nearest_town_location" value="Nearest Town/Location" />
                                <x-text-input id="nearest_town_location" name="nearest_town_location" type="text" class="mt-1 block w-full"
                                             value="{{ old('nearest_town_location', $landRegister->nearest_town_location) }}" required />
                                <x-input-error :messages="$errors->get('nearest_town_location')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="gps_coordinates" value="GPS Coordinates" />
                                <x-text-input id="gps_coordinates" name="gps_coordinates" type="text" class="mt-1 block w-full"
                                             value="{{ old('gps_coordinates', $landRegister->gps_coordinates) }}" placeholder="e.g., -1.2921, 36.8219" />
                                <x-input-error :messages="$errors->get('gps_coordinates')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Document Upload Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Document Upload</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="document_of_ownership" value="Document of Ownership" />
                                    @if($landRegister->document_of_ownership_path)
                                        <div class="mb-2">
                                            <p class="text-sm text-gray-600">Current file:
                                                <a href="{{ $landRegister->document_of_ownership_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                    View Document
                                                </a>
                                            </p>
                                        </div>
                                    @endif
                                    <input type="file" id="document_of_ownership" name="document_of_ownership"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                                    <p class="text-sm text-gray-500 mt-1">Upload title deed, certificate, allotment letter, etc. (Max 10MB)</p>
                                    <x-input-error :messages="$errors->get('document_of_ownership')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="zonal_maps" value="Zonal Maps/Land Index" />
                                    @if($landRegister->zonal_maps_path)
                                        <div class="mb-2">
                                            <p class="text-sm text-gray-600">Current file:
                                                <a href="{{ $landRegister->zonal_maps_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                    View Document
                                                </a>
                                            </p>
                                        </div>
                                    @endif
                                    <input type="file" id="zonal_maps" name="zonal_maps"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                                    <p class="text-sm text-gray-500 mt-1">Upload zonal maps or land index (Max 10MB)</p>
                                    <x-input-error :messages="$errors->get('zonal_maps')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Land Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <x-input-label for="size_hectares" value="Size (hectares)" />
                                <x-text-input id="size_hectares" name="size_hectares" type="number" step="0.0001" class="mt-1 block w-full"
                                             value="{{ old('size_hectares', $landRegister->size_hectares) }}" required />
                                <x-input-error :messages="$errors->get('size_hectares')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="ownership_status" value="Ownership Status" />
                                <select id="ownership_status" name="ownership_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Select Status</option>
                                    <option value="freehold" {{ old('ownership_status', $landRegister->ownership_status) == 'freehold' ? 'selected' : '' }}>Freehold</option>
                                    <option value="leasehold" {{ old('ownership_status', $landRegister->ownership_status) == 'leasehold' ? 'selected' : '' }}>Leasehold</option>
                                </select>
                                <x-input-error :messages="$errors->get('ownership_status')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="acquisition_date" value="Acquisition Date" />
                                <x-text-input id="acquisition_date" name="acquisition_date" type="date" class="mt-1 block w-full"
                                             value="{{ old('acquisition_date', $landRegister->acquisition_date?->format('Y-m-d')) }}" required />
                                <x-input-error :messages="$errors->get('acquisition_date')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Additional Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="lr_certificate_number" value="L.R/Certificate No." />
                                <x-text-input id="lr_certificate_number" name="lr_certificate_number" type="text" class="mt-1 block w-full"
                                             value="{{ old('lr_certificate_number', $landRegister->lr_certificate_number) }}" />
                                <x-input-error :messages="$errors->get('lr_certificate_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="disputed_status" value="Disputed/Undisputed" />
                                <select id="disputed_status" name="disputed_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Select Status</option>
                                    <option value="disputed" {{ old('disputed_status', $landRegister->disputed_status) == 'disputed' ? 'selected' : '' }}>Disputed</option>
                                    <option value="undisputed" {{ old('disputed_status', $landRegister->disputed_status) == 'undisputed' ? 'selected' : '' }}>Undisputed</option>
                                </select>
                                <x-input-error :messages="$errors->get('disputed_status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Text Areas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="proprietorship_details" value="Proprietorship Details" />
                                <textarea id="proprietorship_details" name="proprietorship_details" rows="3"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('proprietorship_details', $landRegister->proprietorship_details) }}</textarea>
                                <x-input-error :messages="$errors->get('proprietorship_details')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="purpose_use_of_land" value="Purpose/Use of Land" />
                                <textarea id="purpose_use_of_land" name="purpose_use_of_land" rows="3"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('purpose_use_of_land', $landRegister->purpose_use_of_land) }}</textarea>
                                <x-input-error :messages="$errors->get('purpose_use_of_land')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Financial Information -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <x-input-label for="acquisition_amount" value="Acquisition Amount" />
                                <x-text-input id="acquisition_amount" name="acquisition_amount" type="number" step="0.01" class="mt-1 block w-full"
                                             value="{{ old('acquisition_amount', $landRegister->acquisition_amount) }}" />
                                <x-input-error :messages="$errors->get('acquisition_amount')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="fair_value" value="Fair Value" />
                                <x-text-input id="fair_value" name="fair_value" type="number" step="0.01" class="mt-1 block w-full"
                                             value="{{ old('fair_value', $landRegister->fair_value) }}" />
                                <x-input-error :messages="$errors->get('fair_value')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="annual_rental_income" value="Annual Rental Income" />
                                <x-text-input id="annual_rental_income" name="annual_rental_income" type="number" step="0.01" class="mt-1 block w-full"
                                             value="{{ old('annual_rental_income', $landRegister->annual_rental_income) }}" />
                                <x-input-error :messages="$errors->get('annual_rental_income')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('land-register.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Land Register Entry') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>