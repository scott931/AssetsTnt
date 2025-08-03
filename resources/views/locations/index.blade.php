<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Locations') }}
            </h2>
            <a href="{{ route('locations.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Location
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search and Filter Section -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('locations.index') }}" class="flex flex-wrap gap-4">
                            <div class="flex-1 min-w-64">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Search locations..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex gap-2">
                                <select name="status" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                                    Filter
                                </button>
                                <a href="{{ route('locations.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">
                                    Clear
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Locations Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_order' => request('sort_by') === 'name' && request('sort_order') === 'asc' ? 'desc' : 'asc']) }}" class="hover:text-gray-700">
                                            Name
                                            @if(request('sort_by') === 'name')
                                                <span class="ml-1">{{ request('sort_order') === 'asc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Assets</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse($locations as $location)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{ route('locations.show', $location) }}" class="text-blue-600 hover:text-blue-900">
                                                {{ $location->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $location->code ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div class="max-w-xs truncate">
                                                {{ $location->full_address ?: 'No address provided' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <div>
                                                @if($location->phone)
                                                    <div>{{ $location->phone }}</div>
                                                @endif
                                                @if($location->email)
                                                    <div class="text-blue-600">{{ $location->email }}</div>
                                                @endif
                                                @if(!$location->phone && !$location->email)
                                                    <span class="text-gray-400">No contact info</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $location->assets_count ?? $location->assets()->count() }} assets
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $location->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $location->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('locations.show', $location) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                <a href="{{ route('locations.edit', $location) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('locations.destroy', $location) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this location?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            No locations found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $locations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>