@extends('layouts.app')

@section('header', 'Transfers')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-900">Asset Transfers</h1>
            <a href="{{ route('transfers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">+ New Transfer</a>
        </div>
        <table class="min-w-full text-sm border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 py-2 border">ID</th>
                    <th class="px-2 py-2 border">Assets</th>
                    <th class="px-2 py-2 border">From</th>
                    <th class="px-2 py-2 border">To</th>
                    <th class="px-2 py-2 border">Type</th>
                    <th class="px-2 py-2 border">Status</th>
                    <th class="px-2 py-2 border">Date</th>
                    <th class="px-2 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transfers as $transfer)
                <tr class="hover:bg-blue-50">
                    <td class="px-2 py-2 border">{{ $transfer->id }}</td>
                    <td class="px-2 py-2 border">
                        @foreach($transfer->assets as $asset)
                            <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1 mb-1">{{ $asset->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-2 py-2 border">
                        @if($transfer->fromUser)
                            User: {{ $transfer->fromUser->name }}<br>
                        @endif
                        @if($transfer->fromDepartment)
                            Dept: {{ $transfer->fromDepartment->name }}<br>
                        @endif
                        @if($transfer->fromLocation)
                            Loc: {{ $transfer->fromLocation->name }}
                        @endif
                    </td>
                    <td class="px-2 py-2 border">
                        @if($transfer->toUser)
                            User: {{ $transfer->toUser->name }}<br>
                        @endif
                        @if($transfer->toDepartment)
                            Dept: {{ $transfer->toDepartment->name }}<br>
                        @endif
                        @if($transfer->toLocation)
                            Loc: {{ $transfer->toLocation->name }}
                        @endif
                    </td>
                    <td class="px-2 py-2 border">{{ ucfirst($transfer->transfer_type ?? '-') }}</td>
                    <td class="px-2 py-2 border">
                        <span class="inline-block px-2 py-1 rounded {{
                            $transfer->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            ($transfer->status === 'approved' ? 'bg-green-100 text-green-800' :
                            ($transfer->status === 'rejected' ? 'bg-red-100 text-red-800' :
                            ($transfer->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')))
                        }}">
                            {{ ucfirst($transfer->status) }}
                        </span>
                    </td>
                    <td class="px-2 py-2 border">{{ $transfer->created_at->format('Y-m-d') }}</td>
                    <td class="px-2 py-2 border">
                        <a href="{{ route('transfers.show', $transfer) }}" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-6 text-gray-500">No transfers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $transfers->links() }}</div>
    </div>
</div>
@endsection