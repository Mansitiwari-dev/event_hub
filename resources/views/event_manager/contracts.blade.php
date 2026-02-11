@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl">📋</span>
                </div>
                <div>
                    <h1 class="text-5xl font-black text-white">Vendor Contracts</h1>
                    <p class="text-purple-300 mt-2 text-lg">Manage and track all your vendor contracts</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl p-8 mb-12 border border-slate-600">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-bold text-purple-300 mb-2 uppercase tracking-wide">Filter by Status</label>
                    <select name="status" onchange="this.form.submit()" class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">
                        <option value="" class="bg-slate-800">All Status</option>
                        <option value="pending" @selected(request('status') === 'pending') class="bg-slate-800">Pending</option>
                        <option value="accepted" @selected(request('status') === 'accepted') class="bg-slate-800">Accepted</option>
                        <option value="rejected" @selected(request('status') === 'rejected') class="bg-slate-800">Rejected</option>
                        <option value="completed" @selected(request('status') === 'completed') class="bg-slate-800">Completed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-300 mb-2 uppercase tracking-wide">Filter by Event</label>
                    <select name="event" onchange="this.form.submit()" class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">
                        <option value="" class="bg-slate-800">All Events</option>
                        @foreach(auth()->user()->customerEvents as $event)
                            <option value="{{ $event->id }}" @selected(request('event') == $event->id) class="bg-slate-800">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-300 mb-2 uppercase tracking-wide">Filter by Service</label>
                    <select name="service" onchange="this.form.submit()" class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">
                        <option value="" class="bg-slate-800">All Services</option>
                        @php
                            $services = \App\Models\VendorSpecialization::all();
                        @endphp
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" @selected(request('service') == $service->id) class="bg-slate-800">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <a href="{{ route('event_manager.contracts') }}" class="w-full bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-500 hover:to-slate-600 text-white font-bold py-3 px-4 rounded-lg text-center transition-all duration-200 transform hover:scale-105">
                        ↻ Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Contracts Table -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
            <table class="w-full">
                <thead class="bg-slate-700 border-b border-slate-600">
                    <tr>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Event</th>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Vendor</th>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Service</th>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Rate</th>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Status</th>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Date</th>
                        <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->managedContracts as $contract)
                        <tr class="border-t border-slate-600 hover:bg-slate-700/50 transition-colors duration-200">
                            <td class="px-8 py-5">
                                <div class="font-bold text-white">{{ $contract->event->name ?? 'N/A' }}</div>
                                <div class="text-xs text-purple-400 mt-1">{{ $contract->event->date?->format('M d, Y') ?? 'N/A' }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="font-semibold text-purple-200">{{ $contract->vendor->user->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-8 py-5 text-purple-200">
                                {{ $contract->specialization->name ?? 'N/A' }}
                            </td>
                            <td class="px-8 py-5 font-bold text-purple-300">
                                ${{ number_format($contract->agreed_rate ?? 0, 2) }}
                            </td>
                            <td class="px-8 py-5">
                                <span class="inline-block px-4 py-2 rounded-full text-xs font-bold
                                    @if($contract->status === 'pending') bg-amber-500/20 text-amber-300 border border-amber-400/30
                                    @elseif($contract->status === 'accepted') bg-emerald-500/20 text-emerald-300 border border-emerald-400/30
                                    @elseif($contract->status === 'rejected') bg-red-500/20 text-red-300 border border-red-400/30
                                    @elseif($contract->status === 'completed') bg-blue-500/20 text-blue-300 border border-blue-400/30
                                    @endif">
                                    {{ ucfirst($contract->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-purple-300 text-sm">
                                {{ $contract->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-5">
                                @if($contract->status === 'pending')
                                    <div class="flex gap-3">
                                        <button onclick="acceptContract({{ $contract->id }})" class="text-emerald-400 hover:text-emerald-300 font-bold transition-colors duration-200">
                                            ✓ Accept
                                        </button>
                                        <button onclick="rejectContract({{ $contract->id }})" class="text-red-400 hover:text-red-300 font-bold transition-colors duration-200">
                                            ✕ Reject
                                        </button>
                                    </div>
                                @else
                                    <a href="#" class="text-purple-400 hover:text-purple-300 font-bold transition-colors duration-200">View →</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-12 text-center">
                                <div class="text-5xl mb-4">📭</div>
                                <p class="text-xl font-semibold text-slate-400">No contracts found</p>
                                <p class="text-slate-500 mt-2"><a href="{{ route('event_manager.vendors') }}" class="text-purple-400 hover:text-purple-300 font-bold">Hire a vendor</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function acceptContract(contractId) {
    if (confirm('Are you sure you want to accept this contract?')) {
        // TODO: Implement contract acceptance via AJAX
        console.log('Accept contract:', contractId);
    }
}

function rejectContract(contractId) {
    if (confirm('Are you sure you want to reject this contract?')) {
        // TODO: Implement contract rejection via AJAX
        console.log('Reject contract:', contractId);
    }
}
</script>
@endsection
