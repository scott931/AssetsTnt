<x-app-layout>
    @section('header', 'Edit Region')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('regions.update', $region) }}" method="POST">
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
                                <x-input-label for="name" value="Region Name" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                             value="{{ old('name', $region->name) }}" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="code" value="Region Code" />
                                <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                                             value="{{ old('code', $region->code) }}" placeholder="e.g., NAIROBI, MOMBASA" required />
                                <p class="text-sm text-gray-500 mt-1">Unique code for the region (e.g., NAIROBI, MOMBASA)</p>
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $region->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Headquarters -->
                        <div class="mb-6">
                            <x-input-label for="headquarters" value="Headquarters" />
                            <x-text-input id="headquarters" name="headquarters" type="text" class="mt-1 block w-full"
                                         value="{{ old('headquarters', $region->headquarters) }}" placeholder="e.g., Nairobi City" />
                            <x-input-error :messages="$errors->get('headquarters')" class="mt-2" />
                        </div>

                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <x-input-label for="contact_person" value="Contact Person" />
                                <x-text-input id="contact_person" name="contact_person" type="text" class="mt-1 block w-full"
                                             value="{{ old('contact_person', $region->contact_person) }}" />
                                <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="contact_email" value="Contact Email" />
                                <x-text-input id="contact_email" name="contact_email" type="email" class="mt-1 block w-full"
                                             value="{{ old('contact_email', $region->contact_email) }}" />
                                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="contact_phone" value="Contact Phone" />
                                <x-text-input id="contact_phone" name="contact_phone" type="text" class="mt-1 block w-full"
                                             value="{{ old('contact_phone', $region->contact_phone) }}" />
                                <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $region->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $region->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('regions.show', $region) }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Region') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>