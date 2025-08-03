<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Department Details') }}: {{ $department->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('departments.edit', $department) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Department
                </a>
                <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Departments
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Department Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="text-sm text-gray-900">{{ $department->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Code</dt>
                                    <dd class="text-sm text-gray-900">{{ $department->code }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $department->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $department->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                    <dd class="text-sm text-gray-900">
                                        @if($department->budget)
                                            ${{ number_format($department->budget, 2) }}
                                        @else
                                            —
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Head of Department</dt>
                                    <dd class="text-sm text-gray-900">
                                        @if($department->headUser)
                                            {{ $department->headUser->name }} ({{ $department->headUser->email }})
                                        @else
                                            —
                                        @endif
                                    </dd>
                                </div>
                                @if($department->description)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="text-sm text-gray-900">{{ $department->description }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <!-- You can add more sections for assigned users, assets, logs, etc. here -->
        </div>
    </div>
</x-app-layout>