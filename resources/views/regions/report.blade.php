<x-app-layout>
    @section('header', 'Regional Report')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">{{ $region->name }} - Regional Report</h2>
                <a href="{{ route('regions.show', $region) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back to Region
                </a>
            </div>

            <!-- Summary Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Land Assets</div>
                        <div class="text-2xl font-bold text-blue-600">{{ $landRegisters->count() }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Building Assets</div>
                        <div class="text-2xl font-bold text-purple-600">{{ $buildingRegisters->count() }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Land Area</div>
                        <div class="text-2xl font-bold text-green-600">{{ number_format($landRegisters->sum('size_hectares'), 2) }} ha</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Building Area</div>
                        <div class="text-2xl font-bold text-orange-600">{{ number_format($buildingRegisters->sum('plinth_area_sqm'), 2) }} sqm</div>
                    </div>
                </div>
            </div>

            <!-- Land Register Assets -->
            @if($landRegisters->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Land Register Assets</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">County</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Size (ha)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fair Value</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($landRegisters as $land)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <a href="{{ route('land-register.show', $land) }}" class="text-blue-600 hover:text-blue-900">
                                                    {{ Str::limit($land->description_of_land, 50) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $land->county }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $land->size_hectares }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($land->fair_value, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $land->disputed_status === 'undisputed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($land->disputed_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Building Register Assets -->
            @if($buildingRegisters->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Building Register Assets</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Building Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">County</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Area (sqm)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Net Book Value</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($buildingRegisters as $building)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <a href="{{ route('building-register.show', $building) }}" class="text-blue-600 hover:text-blue-900">
                                                    {{ Str::limit($building->description_name_of_building, 50) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $building->county }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $building->plinth_area_sqm }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($building->net_book_value, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $building->type_of_building === 'permanent' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($building->type_of_building) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if($landRegisters->count() == 0 && $buildingRegisters->count() == 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Assets Found</h3>
                        <p class="text-gray-500">This region doesn't have any land or building assets assigned yet.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>