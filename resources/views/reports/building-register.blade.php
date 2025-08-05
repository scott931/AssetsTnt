<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Building Register Report') }}
            </h2>
            <a href="{{ route('reports.building-register.export', request()->query()) }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Export to Excel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Filters -->
                    <form method="GET" action="{{ route('reports.building-register') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div>
                                <x-input-label for="search" value="Search" />
                                <x-text-input id="search" name="search" type="text" class="mt-1 block w-full"
                                             value="{{ request('search') }}" placeholder="Search by description, county, location..." />
                            </div>
                            <div>
                                <x-input-label for="category" value="Category" />
                                <select id="category" name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">All Categories</option>
                                    <option value="building" {{ request('category') == 'building' ? 'selected' : '' }}>Building</option>
                                    <option value="investment_property" {{ request('category') == 'investment_property' ? 'selected' : '' }}>Investment Property</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="type_of_building" value="Type of Building" />
                                <select id="type_of_building" name="type_of_building" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">All Types</option>
                                    <option value="permanent" {{ request('type_of_building') == 'permanent' ? 'selected' : '' }}>Permanent</option>
                                    <option value="semi_permanent" {{ request('type_of_building') == 'semi_permanent' ? 'selected' : '' }}>Semi-Permanent</option>
                                    <option value="temporary" {{ request('type_of_building') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="designated_use" value="Designated Use" />
                                <select id="designated_use" name="designated_use" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">All Uses</option>
                                    <option value="Office" {{ request('designated_use') == 'Office' ? 'selected' : '' }}>Office</option>
                                    <option value="Residential" {{ request('designated_use') == 'Residential' ? 'selected' : '' }}>Residential</option>
                                    <option value="Commercial" {{ request('designated_use') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                    <option value="Industrial" {{ request('designated_use') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                                    <option value="Educational" {{ request('designated_use') == 'Educational' ? 'selected' : '' }}>Educational</option>
                                    <option value="Healthcare" {{ request('designated_use') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                    <option value="Other" {{ request('designated_use') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <x-primary-button class="mr-2">
                                    {{ __('Filter') }}
                                </x-primary-button>
                                <a href="{{ route('reports.building-register') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Clear
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Results Summary -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-lg font-medium text-blue-900 mb-2">Report Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span class="font-medium">Total Records:</span> {{ $buildingRegisters->total() }}
                            </div>
                            <div>
                                <span class="font-medium">Showing:</span> {{ $buildingRegisters->firstItem() ?? 0 }} - {{ $buildingRegisters->lastItem() ?? 0 }}
                            </div>
                            <div>
                                <span class="font-medium">Page:</span> {{ $buildingRegisters->currentPage() }} of {{ $buildingRegisters->lastPage() }}
                            </div>
                            <div>
                                <span class="font-medium">Per Page:</span> {{ $buildingRegisters->perPage() }}
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">County</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Use</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Floors</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area (sqm)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documents</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($buildingRegisters as $building)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $building->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div class="max-w-xs truncate" title="{{ $building->description_name_of_building }}">
                                                {{ $building->description_name_of_building }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $building->county }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ ucfirst(str_replace('_', ' ', $building->type_of_building)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $building->designated_use }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $building->number_of_floors }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ number_format($building->plinth_area_sqm, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $building->cost_of_construction_valuation ? 'KES ' . number_format($building->cost_of_construction_valuation, 2) : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($building->hasDocuments())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Yes
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    No
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $building->created_at->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No building register entries found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $buildingRegisters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>