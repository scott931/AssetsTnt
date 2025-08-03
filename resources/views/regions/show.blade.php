<x-app-layout>
    @section('header', 'Region Details')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">{{ $region->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('regions.edit', $region) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Edit Region
                    </a>
                    <a href="{{ route('regions.report', $region) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        View Report
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Region Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Region Information</h3>

                        <div class="space-y-4">
                            <div>
                                <span class="font-medium text-gray-700">Region Code:</span>
                                <span class="ml-2 text-gray-900">{{ $region->code }}</span>
                            </div>

                            @if($region->description)
                                <div>
                                    <span class="font-medium text-gray-700">Description:</span>
                                    <p class="mt-1 text-gray-900">{{ $region->description }}</p>
                                </div>
                            @endif

                            @if($region->headquarters)
                                <div>
                                    <span class="font-medium text-gray-700">Headquarters:</span>
                                    <span class="ml-2 text-gray-900">{{ $region->headquarters }}</span>
                                </div>
                            @endif

                            <div>
                                <span class="font-medium text-gray-700">Status:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $region->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($region->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Asset Statistics -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Asset Statistics</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h4 class="font-medium text-blue-900 mb-2">Land Assets</h4>
                                <div class="text-2xl font-bold text-blue-600">{{ $region->landRegisters->count() }}</div>
                                <p class="text-sm text-blue-700">Total land register entries</p>
                            </div>

                            <div class="bg-purple-50 p-4 rounded-lg">
                                <h4 class="font-medium text-purple-900 mb-2">Building Assets</h4>
                                <div class="text-2xl font-bold text-purple-600">{{ $region->buildingRegisters->count() }}</div>
                                <p class="text-sm text-purple-700">Total building register entries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>