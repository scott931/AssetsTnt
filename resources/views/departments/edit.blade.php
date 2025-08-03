<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Department') }}: {{ $department->name }}
            </h2>
            <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Departments
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('departments.update', $department) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Department Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $department->name)" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Code -->
                            <div>
                                <x-input-label for="code" :value="__('Department Code')" />
                                <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code', $department->code)" />
                                <p class="mt-1 text-sm text-gray-500">Optional unique code for easy reference</p>
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>

                            <!-- Budget -->
                            <div>
                                <x-input-label for="budget" :value="__('Budget (optional)')" />
                                <x-text-input id="budget" name="budget" type="number" step="0.01" class="mt-1 block w-full" :value="old('budget', $department->budget)" />
                                <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                            </div>

                            <!-- Head of Department -->
                            <div>
                                <x-input-label for="head_user_id" :value="__('Head of Department')" />
                                <select id="head_user_id" name="head_user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Head</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('head_user_id', $department->head_user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('head_user_id')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="is_active" :value="__('Status')" />
                                <select id="is_active" name="is_active" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="1" {{ old('is_active', $department->is_active) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $department->is_active) ? '' : 'selected' }}>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $department->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button>
                                {{ __('Update Department') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>