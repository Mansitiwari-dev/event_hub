@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl">🏢</span>
                </div>
                <div>
                    <h1 class="text-5xl font-black text-white">Venue Manager Dashboard</h1>
                    <p class="text-emerald-300 mt-2 text-lg">Manage your venues, track bookings, and handle reservations</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <!-- Total Venues Card -->
            <div class="group relative bg-gradient-to-br from-cyan-500 to-cyan-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-cyan-100 uppercase tracking-wider">Total Venues</span>
                        <div class="text-3xl">🏛️</div>
                    </div>
                    <div class="text-4xl font-black text-white">{{ auth()->user()->managedVenues->count() }}</div>
                    <p class="text-cyan-100 text-sm mt-2">venues managed</p>
                </div>
            </div>

            <!-- Total Bookings Card -->
            <div class="group relative bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-indigo-100 uppercase tracking-wider">Total Bookings</span>
                        <div class="text-3xl">📅</div>
                    </div>
                    <div class="text-4xl font-black text-white">{{ auth()->user()->managedVenues->sum(fn($v) => $v->bookings->count()) }}</div>
                    <p class="text-indigo-100 text-sm mt-2">all reservations</p>
                </div>
            </div>

            <!-- Confirmed Bookings Card -->
            <div class="group relative bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-emerald-100 uppercase tracking-wider">Confirmed</span>
                        <div class="text-3xl">✅</div>
                    </div>
                    <div class="text-4xl font-black text-white">
                        @php
                            $confirmed = 0;
                            foreach(auth()->user()->managedVenues as $venue) {
                                $confirmed += $venue->bookings->where('status', 'confirmed')->count();
                            }
                        @endphp
                        {{ $confirmed }}
                    </div>
                    <p class="text-emerald-100 text-sm mt-2">confirmed bookings</p>
                </div>
            </div>

            <!-- Pending Approval Card -->
            <div class="group relative bg-gradient-to-br from-amber-500 to-amber-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-amber-100 uppercase tracking-wider">Pending</span>
                        <div class="text-3xl">⏳</div>
                    </div>
                    <div class="text-4xl font-black text-white">
                        @php
                            $pending = 0;
                            foreach(auth()->user()->managedVenues as $venue) {
                                $pending += $venue->bookings->where('status', 'pending')->count();
                            }
                        @endphp
                        {{ $pending }}
                    </div>
                    <p class="text-amber-100 text-sm mt-2">awaiting approval</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-12">
            <div class="flex gap-4 flex-wrap">
                <button onclick="document.getElementById('addVenueModal').classList.remove('hidden')" class="group relative overflow-hidden bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">➕</span>
                    Add New Venue
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                <a href="{{ route('venue_manager.bookings') }}" class="group relative overflow-hidden bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">📅</span>
                    View All Bookings
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="{{ route('venue_manager.venues') }}" class="group relative overflow-hidden bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">🏛️</span>
                    Manage Venues
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>

        <!-- Venues List -->
        <div class="mb-12">
            <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
                <div class="bg-gradient-to-r from-cyan-600 to-cyan-800 p-8 border-b border-slate-600">
                    <h2 class="text-3xl font-black text-white">Your Venues</h2>
                    <p class="text-cyan-200 mt-1">All your managed properties and venues</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-700">
                            <tr>
                                <th class="px-8 py-4 text-left text-sm font-bold text-cyan-300 uppercase tracking-wider">Venue Name</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-cyan-300 uppercase tracking-wider">Location</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-cyan-300 uppercase tracking-wider">Capacity</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-cyan-300 uppercase tracking-wider">Bookings</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-cyan-300 uppercase tracking-wider">Status</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-cyan-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(auth()->user()->managedVenues as $venue)
                                <tr class="border-t border-slate-600 hover:bg-slate-700/50 transition-colors duration-200">
                                    <td class="px-8 py-5">
                                        <div class="font-bold text-white text-lg">{{ $venue->name }}</div>
                                    </td>
                                    <td class="px-8 py-5 text-cyan-200">
                                        {{ $venue->location }}
                                    </td>
                                    <td class="px-8 py-5 text-cyan-200">
                                        {{ $venue->capacity }} guests
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-block bg-gradient-to-r from-cyan-500/20 to-cyan-600/20 text-cyan-300 px-4 py-2 rounded-full text-sm font-bold border border-cyan-400/30">
                                            {{ $venue->bookings->count() }} booking(s)
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-block px-4 py-2 rounded-full text-xs font-bold
                                            @if($venue->is_available) bg-emerald-500/20 text-emerald-300 border border-emerald-400/30
                                            @else bg-red-500/20 text-red-300 border border-red-400/30
                                            @endif">
                                            @if($venue->is_available) Active @else Inactive @endif
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <a href="{{ route('venue_manager.venues') }}" class="text-cyan-400 hover:text-cyan-300 font-bold transition-colors duration-200">Edit →</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-slate-400">
                                        <div class="text-5xl mb-4">🏛️</div>
                                        <p class="text-xl font-semibold">No venues yet</p>
                                        <p class="mt-2 text-slate-500"><button onclick="document.getElementById('addVenueModal').classList.remove('hidden')" class="text-cyan-400 hover:text-cyan-300 font-bold">Add one now</button></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-slate-700 p-6 border-t border-slate-600">
                    <a href="{{ route('venue_manager.venues') }}" class="text-cyan-400 hover:text-cyan-300 font-bold transition-colors duration-200 flex items-center gap-2">View all venues <span class="text-xl">→</span></a>
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 p-8 border-b border-slate-600">
                <h2 class="text-3xl font-black text-white">Recent Bookings</h2>
                <p class="text-indigo-200 mt-1">Track all reservation requests and approvals</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-700">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-bold text-indigo-300 uppercase tracking-wider">Venue</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-indigo-300 uppercase tracking-wider">Event</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-indigo-300 uppercase tracking-wider">Date</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-indigo-300 uppercase tracking-wider">Guests</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-indigo-300 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-indigo-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $bookings = [];
                            foreach(auth()->user()->managedVenues as $venue) {
                                foreach($venue->bookings->take(5) as $booking) {
                                    $bookings[] = $booking;
                                }
                            }
                            $bookings = array_slice($bookings, 0, 5);
                        @endphp
                        @forelse($bookings as $booking)
                            <tr class="border-t border-slate-600 hover:bg-slate-700/50 transition-colors duration-200">
                                <td class="px-8 py-5">
                                    <div class="font-bold text-white">{{ $booking->venue->name ?? 'N/A' }}</div>
                                </td>
                                <td class="px-8 py-5 text-indigo-200">
                                    {{ $booking->event->name ?? 'N/A' }}
                                </td>
                                <td class="px-8 py-5 text-indigo-200">
                                    {{ $booking->date->format('M d, Y') ?? 'N/A' }}
                                </td>
                                <td class="px-8 py-5 text-indigo-200">
                                    {{ $booking->guest_count ?? 0 }}
                                </td>
                                <td class="px-8 py-5">
                                    <span class="inline-block px-4 py-2 rounded-full text-xs font-bold
                                        @if($booking->status === 'pending') bg-amber-500/20 text-amber-300 border border-amber-400/30
                                        @elseif($booking->status === 'confirmed') bg-emerald-500/20 text-emerald-300 border border-emerald-400/30
                                        @elseif($booking->status === 'rejected') bg-red-500/20 text-red-300 border border-red-400/30
                                        @elseif($booking->status === 'completed') bg-blue-500/20 text-blue-300 border border-blue-400/30
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <a href="{{ route('venue_manager.bookings') }}" class="text-indigo-400 hover:text-indigo-300 font-bold transition-colors duration-200">Review →</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-12 text-center text-slate-400">
                                    <div class="text-5xl mb-4">📭</div>
                                    <p class="text-xl font-semibold">No bookings yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-slate-700 p-6 border-t border-slate-600">
                <a href="{{ route('venue_manager.bookings') }}" class="text-indigo-400 hover:text-indigo-300 font-bold transition-colors duration-200 flex items-center gap-2">View all bookings <span class="text-xl">→</span></a>
            </div>
        </div>
    </div>
</div>

<!-- Add Venue Modal -->
<div id="addVenueModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 border border-slate-600">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-black text-white">Add New Venue</h3>
            <button onclick="document.getElementById('addVenueModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-200 text-3xl leading-none">
                ✕
            </button>
        </div>
        <form action="{{ route('venue_manager.venues.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-cyan-300 mb-2 uppercase tracking-wide">Venue Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200" placeholder="e.g., Grand Ballroom">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-cyan-300 mb-2 uppercase tracking-wide">Location</label>
                <input type="text" name="location" required class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200" placeholder="Full address">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-cyan-300 mb-2 uppercase tracking-wide">Capacity</label>
                <input type="number" name="capacity" required class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200" placeholder="Number of guests">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold text-cyan-300 mb-2 uppercase tracking-wide">Price per Hour</label>
                <input type="number" name="price_per_hour" step="0.01" required class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200" placeholder="0.00">
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="document.getElementById('addVenueModal').classList.add('hidden')" class="flex-1 bg-slate-600 hover:bg-slate-500 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-200">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                    Add Venue
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
