<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Location Details') }}: {{ $location->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('locations.edit', $location) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Location
                </a>
                <a href="{{ route('locations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Locations
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Location Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="text-sm text-gray-900">{{ $location->name }}</dd>
                                </div>
                                @if($location->code)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Code</dt>
                                    <dd class="text-sm text-gray-900">{{ $location->code }}</dd>
                                </div>
                                @endif
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $location->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $location->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </dd>
                                </div>
                                @if($location->description)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="text-sm text-gray-900">{{ $location->description }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
                            <dl class="space-y-3">
                                @if($location->phone)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="text-sm text-gray-900">{{ $location->phone }}</dd>
                                </div>
                                @endif
                                @if($location->email)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="text-sm text-gray-900">
                                        <a href="mailto:{{ $location->email }}" class="text-blue-600 hover:text-blue-900">{{ $location->email }}</a>
                                    </dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Address Information -->
                    @if($location->address || $location->city || $location->state || $location->country || $location->postal_code)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Address</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <address class="text-sm text-gray-900 not-italic">
                                @if($location->address)
                                    <div>{{ $location->address }}</div>
                                @endif
                                @if($location->city || $location->state || $location->postal_code)
                                    <div>
                                        @if($location->city){{ $location->city }}, @endif
                                        @if($location->state){{ $location->state }} @endif
                                        @if($location->postal_code){{ $location->postal_code }}@endif
                                    </div>
                                @endif
                                @if($location->country)
                                    <div>{{ $location->country }}</div>
                                @endif
                            </address>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Assets Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Assets at this Location</h3>
                        <span class="text-sm text-gray-500">{{ $location->assets->count() }} assets</span>
                    </div>

                    @if($location->assets->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($location->assets->take(5) as $asset)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('assets.show', $asset) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ $asset->name }}
                                            </a>
                                            <div class="text-sm text-gray-500">{{ $asset->asset_tag }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $asset->category->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $asset->status === 'active' ? 'bg-green-100 text-green-800' :
                                                   ($asset->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($asset->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $asset->assignedUser->name ?? 'Unassigned' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($location->assets->count() > 5)
                            <div class="mt-4 text-center">
                                <a href="{{ route('assets.index', ['location_id' => $location->id]) }}" class="text-blue-600 hover:text-blue-900">
                                    View all {{ $location->assets->count() }} assets →
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-500 text-center py-4">No assets assigned to this location.</p>
                    @endif
                </div>
            </div>

            <!-- Departments Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Departments at this Location</h3>
                        <span class="text-sm text-gray-500">{{ $location->departments->count() }} departments</span>
                    </div>

                    @if($location->departments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manager</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($location->departments as $department)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('departments.show', $department) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ $department->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $department->code ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $department->manager->name ?? 'No manager' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $department->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $department->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No departments assigned to this location.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>