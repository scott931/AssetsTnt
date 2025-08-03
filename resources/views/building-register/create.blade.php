<x-app-layout>
    @section('header', 'Add New Building Entry')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('building-register.store') }}" enctype="multipart/form-data">
                        @csrf

                                                 <!-- Basic Information Section -->
                         <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                             <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                 <div>
                                     <x-input-label for="region_id" value="Region" />
                                     <select id="region_id" name="region_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                         <option value="">Select Region</option>
                                         @foreach(\App\Models\Region::active()->orderBy('name')->get() as $region)
                                             <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                                 {{ $region->name }} ({{ $region->code }})
                                             </option>
                                         @endforeach
                                     </select>
                                     <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
                                 </div>

                                 <div>
                                     <x-input-label for="description_name_of_building" value="Description/Name of Building" />
                                     <textarea id="description_name_of_building" name="description_name_of_building"
                                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                               rows="3" required>{{ old('description_name_of_building') }}</textarea>
                                     <x-input-error :messages="$errors->get('description_name_of_building')" class="mt-2" />
                                 </div>
                                <div>
                                    <x-input-label for="building_ownership" value="Building Ownership" />
                                    <textarea id="building_ownership" name="building_ownership"
                                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                              rows="3" required>{{ old('building_ownership') }}</textarea>
                                    <x-input-error :messages="$errors->get('building_ownership')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="category" value="Category" />
                                    <select id="category" name="category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                        <option value="">Select Category</option>
                                        <option value="building" {{ old('category') == 'building' ? 'selected' : '' }}>Building</option>
                                        <option value="investment_property" {{ old('category') == 'investment_property' ? 'selected' : '' }}>Investment Property</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="building_number" value="Building Number" />
                                    <x-text-input id="building_number" name="building_number" type="text"
                                                 class="mt-1 block w-full" value="{{ old('building_number') }}" />
                                    <x-input-error :messages="$errors->get('building_number')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="institution_number" value="Institution Number" />
                                    <x-text-input id="institution_number" name="institution_number" type="text"
                                                 class="mt-1 block w-full" value="{{ old('institution_number') }}" />
                                    <x-input-error :messages="$errors->get('institution_number')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Location Information Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Location Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="nearest_town_shopping_centre" value="Nearest Town/Shopping Centre" />
                                    <x-text-input id="nearest_town_shopping_centre" name="nearest_town_shopping_centre" type="text"
                                                 class="mt-1 block w-full" value="{{ old('nearest_town_shopping_centre') }}" required />
                                    <x-input-error :messages="$errors->get('nearest_town_shopping_centre')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="street" value="Street" />
                                    <x-text-input id="street" name="street" type="text"
                                                 class="mt-1 block w-full" value="{{ old('street') }}" required />
                                    <x-input-error :messages="$errors->get('street')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="county" value="County" />
                                    <x-text-input id="county" name="county" type="text"
                                                 class="mt-1 block w-full" value="{{ old('county') }}" required />
                                    <x-input-error :messages="$errors->get('county')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="lr_number" value="L.R Number" />
                                    <x-text-input id="lr_number" name="lr_number" type="text"
                                                 class="mt-1 block w-full" value="{{ old('lr_number') }}" />
                                    <x-input-error :messages="$errors->get('lr_number')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="size_of_land_hectares" value="Size of Land (hectares)" />
                                    <x-text-input id="size_of_land_hectares" name="size_of_land_hectares" type="number" step="0.0001"
                                                 class="mt-1 block w-full" value="{{ old('size_of_land_hectares') }}" required />
                                    <x-input-error :messages="$errors->get('size_of_land_hectares')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Ownership and Legal Status Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Ownership and Legal Status</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="ownership_status" value="Ownership Status" />
                                    <select id="ownership_status" name="ownership_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                        <option value="">Select Ownership Status</option>
                                        <option value="freehold" {{ old('ownership_status') == 'freehold' ? 'selected' : '' }}>Freehold</option>
                                        <option value="leasehold" {{ old('ownership_status') == 'leasehold' ? 'selected' : '' }}>Leasehold</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('ownership_status')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="source_of_funds" value="Source of Funds" />
                                    <x-text-input id="source_of_funds" name="source_of_funds" type="text"
                                                 class="mt-1 block w-full" value="{{ old('source_of_funds') }}" required />
                                    <x-input-error :messages="$errors->get('source_of_funds')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="mode_of_acquisition" value="Mode of Acquisition" />
                                    <select id="mode_of_acquisition" name="mode_of_acquisition" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                        <option value="">Select Mode of Acquisition</option>
                                        <option value="purchase" {{ old('mode_of_acquisition') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                                        <option value="construction" {{ old('mode_of_acquisition') == 'construction' ? 'selected' : '' }}>Construction</option>
                                        <option value="donation" {{ old('mode_of_acquisition') == 'donation' ? 'selected' : '' }}>Donation</option>
                                        <option value="inheritance" {{ old('mode_of_acquisition') == 'inheritance' ? 'selected' : '' }}>Inheritance</option>
                                        <option value="gift" {{ old('mode_of_acquisition') == 'gift' ? 'selected' : '' }}>Gift</option>
                                        <option value="other" {{ old('mode_of_acquisition') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('mode_of_acquisition')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="date_of_purchase_commissioning" value="Date of Purchase/Commissioning" />
                                    <x-text-input id="date_of_purchase_commissioning" name="date_of_purchase_commissioning" type="date"
                                                 class="mt-1 block w-full" value="{{ old('date_of_purchase_commissioning') }}" required />
                                    <x-input-error :messages="$errors->get('date_of_purchase_commissioning')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Building Characteristics Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Building Characteristics</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="type_of_building" value="Type of Building" />
                                    <select id="type_of_building" name="type_of_building" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                        <option value="">Select Type of Building</option>
                                        <option value="permanent" {{ old('type_of_building') == 'permanent' ? 'selected' : '' }}>Permanent</option>
                                        <option value="temporary" {{ old('type_of_building') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('type_of_building')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="designated_use" value="Designated Use" />
                                    <textarea id="designated_use" name="designated_use"
                                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                              rows="3" required>{{ old('designated_use') }}</textarea>
                                    <x-input-error :messages="$errors->get('designated_use')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="estimated_useful_life_years" value="Estimated Useful Life (years)" />
                                    <x-text-input id="estimated_useful_life_years" name="estimated_useful_life_years" type="number"
                                                 class="mt-1 block w-full" value="{{ old('estimated_useful_life_years') }}" required />
                                    <x-input-error :messages="$errors->get('estimated_useful_life_years')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="number_of_floors" value="Number of Floors" />
                                    <x-text-input id="number_of_floors" name="number_of_floors" type="number"
                                                 class="mt-1 block w-full" value="{{ old('number_of_floors') }}" required />
                                    <x-input-error :messages="$errors->get('number_of_floors')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="plinth_area_sqm" value="Plinth Area (sqm)" />
                                    <x-text-input id="plinth_area_sqm" name="plinth_area_sqm" type="number" step="0.01"
                                                 class="mt-1 block w-full" value="{{ old('plinth_area_sqm') }}" required />
                                    <x-input-error :messages="$errors->get('plinth_area_sqm')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Financial Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="cost_of_construction_valuation" value="Cost of Construction/Valuation" />
                                    <x-text-input id="cost_of_construction_valuation" name="cost_of_construction_valuation" type="number" step="0.01"
                                                 class="mt-1 block w-full" value="{{ old('cost_of_construction_valuation') }}" required />
                                    <x-input-error :messages="$errors->get('cost_of_construction_valuation')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="annual_depreciation" value="Annual Depreciation" />
                                    <x-text-input id="annual_depreciation" name="annual_depreciation" type="number" step="0.01"
                                                 class="mt-1 block w-full" value="{{ old('annual_depreciation') }}" required />
                                    <x-input-error :messages="$errors->get('annual_depreciation')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="accumulated_depreciation_to_date" value="Accumulated Depreciation to Date" />
                                    <x-text-input id="accumulated_depreciation_to_date" name="accumulated_depreciation_to_date" type="number" step="0.01"
                                                 class="mt-1 block w-full" value="{{ old('accumulated_depreciation_to_date') }}" required />
                                    <x-input-error :messages="$errors->get('accumulated_depreciation_to_date')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="net_book_value" value="Net Book Value" />
                                    <x-text-input id="net_book_value" name="net_book_value" type="number" step="0.01"
                                                 class="mt-1 block w-full" value="{{ old('net_book_value') }}" required />
                                    <x-input-error :messages="$errors->get('net_book_value')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="annual_rental_income" value="Annual Rental Income (for investment property)" />
                                    <x-text-input id="annual_rental_income" name="annual_rental_income" type="number" step="0.01"
                                                 class="mt-1 block w-full" value="{{ old('annual_rental_income') }}" />
                                    <x-input-error :messages="$errors->get('annual_rental_income')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Document Upload Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Document Upload</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="building_plans" value="Building Plans" />
                                    <input type="file" id="building_plans" name="building_plans"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                                    <p class="text-sm text-gray-500 mt-1">Upload building plans and drawings (Max 10MB)</p>
                                    <x-input-error :messages="$errors->get('building_plans')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="certificate_of_occupancy" value="Certificate of Occupancy" />
                                    <input type="file" id="certificate_of_occupancy" name="certificate_of_occupancy"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                                    <p class="text-sm text-gray-500 mt-1">Upload certificate of occupancy (Max 10MB)</p>
                                    <x-input-error :messages="$errors->get('certificate_of_occupancy')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="valuation_report" value="Valuation Report" />
                                    <input type="file" id="valuation_report" name="valuation_report"
                                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                                    <p class="text-sm text-gray-500 mt-1">Upload valuation report (Max 10MB)</p>
                                    <x-input-error :messages="$errors->get('valuation_report')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                            <div>
                                <x-input-label for="remarks" value="Remarks" />
                                <textarea id="remarks" name="remarks"
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                          rows="4">{{ old('remarks') }}</textarea>
                                <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('building-register.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Building Entry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>