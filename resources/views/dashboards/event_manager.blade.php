@extends('layouts.app')

@section('title', 'Event Manager Dashboard - EventHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900" style="min-height: 100vh; padding-top: 20px;">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl">📊</span>
                </div>
                <div>
                    <h1 class="text-5xl font-black text-white">Event Manager Dashboard</h1>
                    <p class="text-blue-300 mt-2 text-lg">Manage your events, hire vendors, and track contracts</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <!-- Total Events Card -->
            <div class="group relative bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-blue-100 uppercase tracking-wider">Total Events</span>
                        <div class="text-3xl">📅</div>
                    </div>
                    <div class="text-4xl font-black text-white">{{ auth()->user()->customerEvents->count() }}</div>
                    <p class="text-blue-100 text-sm mt-2">events created</p>
                </div>
            </div>

            <!-- Active Contracts Card -->
            <div class="group relative bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-emerald-100 uppercase tracking-wider">Active Contracts</span>
                        <div class="text-3xl">✅</div>
                    </div>
                    <div class="text-4xl font-black text-white">{{ auth()->user()->managedContracts->where('status', 'accepted')->count() }}</div>
                    <p class="text-emerald-100 text-sm mt-2">ongoing services</p>
                </div>
            </div>

            <!-- Pending Approvals Card -->
            <div class="group relative bg-gradient-to-br from-amber-500 to-amber-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-amber-100 uppercase tracking-wider">Pending Approvals</span>
                        <div class="text-3xl">⏳</div>
                    </div>
                    <div class="text-4xl font-black text-white">{{ auth()->user()->managedContracts->where('status', 'pending')->count() }}</div>
                    <p class="text-amber-100 text-sm mt-2">awaiting response</p>
                </div>
            </div>

            <!-- Total Vendors Hired Card -->
            <div class="group relative bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-6 relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-purple-100 uppercase tracking-wider">Vendors Hired</span>
                        <div class="text-3xl">👥</div>
                    </div>
                    <div class="text-4xl font-black text-white">{{ auth()->user()->managedContracts->count() }}</div>
                    <p class="text-purple-100 text-sm mt-2">total collaborators</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-12">
            <div class="flex gap-4 flex-wrap">
                <a href="{{ route('events.create') }}" class="group relative overflow-hidden bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">➕</span>
                    Create New Event
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="{{ route('event_manager.contracts') }}" class="group relative overflow-hidden bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">📋</span>
                    View All Contracts
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="{{ route('event_manager.vendors') }}" class="group relative overflow-hidden bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <span class="text-xl">👥</span>
                    Find Vendors
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>

        <!-- Recent Events -->
        <div class="mb-12">
            <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-8 border-b border-slate-600">
                    <h2 class="text-3xl font-black text-white">Your Events</h2>
                    <p class="text-blue-200 mt-1">Manage and track all your upcoming events</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-700">
                            <tr>
                                <th class="px-8 py-4 text-left text-sm font-bold text-blue-300 uppercase tracking-wider">Event Name</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-blue-300 uppercase tracking-wider">Date</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-blue-300 uppercase tracking-wider">Location</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-blue-300 uppercase tracking-wider">Vendors</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-blue-300 uppercase tracking-wider">Status</th>
                                <th class="px-8 py-4 text-left text-sm font-bold text-blue-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(auth()->user()->customerEvents->take(5) as $event)
                                <tr class="border-t border-slate-600 hover:bg-slate-700/50 transition-colors duration-200">
                                    <td class="px-8 py-5">
                                        <div class="font-bold text-white text-lg">{{ $event->title }}</div>
                                    </td>
                                    <td class="px-8 py-5 text-blue-200">
                                        {{ $event->start_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-8 py-5 text-blue-200">
                                        {{ $event->location }}
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-block bg-gradient-to-r from-blue-500/20 to-blue-600/20 text-blue-300 px-4 py-2 rounded-full text-sm font-bold border border-blue-400/30">
                                            {{ $event->vendorContracts->count() }} vendor(s)
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-block px-4 py-2 rounded-full text-xs font-bold
                                            @if($event->status === 'draft') bg-gray-500/20 text-gray-300 border border-gray-400/30
                                            @elseif($event->status === 'published') bg-emerald-500/20 text-emerald-300 border border-emerald-400/30
                                            @elseif($event->status === 'ongoing') bg-blue-500/20 text-blue-300 border border-blue-400/30
                                            @else bg-red-500/20 text-red-300 border border-red-400/30
                                            @endif">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex gap-3" onclick="event.stopPropagation();">
                                            <button type="button" onclick="expandEventDetails({{ $event->id }})" class="text-blue-400 hover:text-blue-300 font-bold transition-colors duration-200" title="View Details">View</button>
                                            <button type="button" onclick="editEvent({{ $event->id }})" class="text-purple-400 hover:text-purple-300 font-bold transition-colors duration-200" title="Edit Event">Edit</button>
                                            <button type="button" onclick="deleteEvent({{ $event->id }})" class="text-red-400 hover:text-red-300 font-bold transition-colors duration-200" title="Delete Event">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-slate-400">
                                        <div class="text-5xl mb-4">📭</div>
                                        <p class="text-xl font-semibold">No events yet</p>
                                        <p class="mt-2 text-slate-500"><a href="{{ route('events.create') }}" class="text-blue-400 hover:text-blue-300 font-bold">Create one now</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="bg-slate-700 p-6 border-t border-slate-600">
                    <a href="{{ route('events.index') }}" class="text-blue-400 hover:text-blue-300 font-bold transition-colors duration-200 flex items-center gap-2">View all events <span class="text-xl">→</span></a>
                </div>
            </div>
        </div>

        <!-- Recent Contracts -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 p-8 border-b border-slate-600">
                <h2 class="text-3xl font-black text-white">Recent Vendor Contracts</h2>
                <p class="text-purple-200 mt-1">Track and manage all vendor agreements</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-700">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Event</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Vendor</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Service</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-4 text-left text-sm font-bold text-purple-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(auth()->user()->managedContracts->take(5) as $contract)
                            <tr class="border-t border-slate-600 hover:bg-slate-700/50 transition-colors duration-200">
                                <td class="px-8 py-5">
                                    <div class="font-bold text-white">{{ $contract->event->title ?? 'N/A' }}</div>
                                </td>
                                <td class="px-8 py-5 text-purple-200">
                                    {{ $contract->vendor->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-8 py-5 text-purple-200">
                                    {{ $contract->specialization->name ?? 'N/A' }}
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
                                <td class="px-8 py-5">
                                    <a href="{{ route('event_manager.contracts') }}" class="text-purple-400 hover:text-purple-300 font-bold transition-colors duration-200">View →</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center text-slate-400">
                                    <div class="text-5xl mb-4">📋</div>
                                    <p class="text-xl font-semibold">No contracts yet</p>
                                    <p class="mt-2 text-slate-500"><a href="{{ route('event_manager.vendors') }}" class="text-purple-400 hover:text-purple-300 font-bold">Hire a vendor</a></p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-slate-700 p-6 border-t border-slate-600">
                <a href="{{ route('event_manager.contracts') }}" class="text-purple-400 hover:text-purple-300 font-bold transition-colors duration-200 flex items-center gap-2">View all contracts <span class="text-xl">→</span></a>
            </div>
        </div>
    </div>
</div>

<!-- Event Details Modal -->
<div id="eventDetailsModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-slate-600">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 border-b border-slate-600 sticky top-0">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-white">Event Details</h2>
                <button onclick="closeEventDetails()" class="text-blue-200 hover:text-blue-100 text-2xl font-bold">✕</button>
            </div>
        </div>
        
        <div id="eventDetailsContent" class="p-8 space-y-6">
            <!-- Will be populated by JavaScript -->
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl max-w-sm w-full border border-slate-600">
        <div class="bg-gradient-to-r from-red-600 to-red-800 p-6 border-b border-slate-600">
            <h2 class="text-2xl font-bold text-white">Delete Event</h2>
        </div>
        
        <div class="p-8 space-y-6">
            <p class="text-white text-lg">Are you sure you want to delete this event? This action cannot be undone.</p>
            <div class="flex gap-4">
                <button onclick="closeDeleteModal()" class="flex-1 bg-slate-600 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                    Cancel
                </button>
                <form id="deleteEventForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Event Modal -->
<div id="editEventModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-slate-600">
        <div class="bg-gradient-to-r from-purple-600 to-purple-800 p-6 border-b border-slate-600 sticky top-0">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-white">Edit Event</h2>
                <button onclick="closeEditModal()" class="text-purple-200 hover:text-purple-100 text-2xl font-bold">✕</button>
            </div>
        </div>
        
        <form id="editEventForm" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Event Title</label>
                <input type="text" id="editTitle" name="title" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Description</label>
                <textarea id="editDescription" name="description" rows="4" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Event Type</label>
                    <select id="editType" name="event_type" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Wedding">Wedding</option>
                        <option value="Conference">Conference</option>
                        <option value="Birthday">Birthday</option>
                        <option value="Corporate">Corporate</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Location</label>
                    <input type="text" id="editLocation" name="location" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Start Date</label>
                    <input type="datetime-local" id="editStartDate" name="start_date" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">End Date</label>
                    <input type="datetime-local" id="editEndDate" name="end_date" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Guest Count</label>
                    <input type="number" id="editGuests" name="guest_count" min="1" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-2">Budget ($)</label>
                    <input type="number" id="editBudget" name="budget" step="0.01" min="0" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Status</label>
                <select id="editStatus" name="status" required class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="pending">Pending</option>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeEditModal()" class="flex-1 bg-slate-600 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Store events data in JavaScript for quick access
const eventsData = {!! json_encode(auth()->user()->customerEvents->map(fn($e) => [
    'id' => $e->id,
    'title' => $e->title,
    'description' => $e->description,
    'type' => $e->event_type,
    'start_date' => $e->start_date->toIso8601String(), // ISO format for JS parsing
    'end_date' => $e->end_date->toIso8601String(), // ISO format for JS parsing
    'start_date_display' => $e->start_date->format('M d, Y H:i'), // Display format
    'end_date_display' => $e->end_date->format('M d, Y H:i'), // Display format
    'location' => $e->location,
    'guests' => $e->guest_count,
    'budget' => $e->budget,
    'status' => $e->status,
])) !!};

function expandEventDetails(eventId) {
    const event = eventsData.find(e => e.id === eventId);
    if (!event) return;
    
    const content = `
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Event Title</label>
                <div class="text-xl font-bold text-white">${event.title}</div>
            </div>
            
            <div>
                <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Type</label>
                <div class="text-white">${event.type}</div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Start Date</label>
                    <div class="text-white">${event.start_date_display}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">End Date</label>
                    <div class="text-white">${event.end_date_display}</div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Location</label>
                    <div class="text-white">${event.location}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Guest Count</label>
                    <div class="text-white">${event.guests}</div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Budget</label>
                    <div class="text-white">$${parseFloat(event.budget).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Status</label>
                    <div>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                            ${event.status === 'draft' ? 'bg-gray-500/20 text-gray-300 border border-gray-400/30' : ''}
                            ${event.status === 'published' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30' : ''}
                            ${event.status === 'ongoing' ? 'bg-blue-500/20 text-blue-300 border border-blue-400/30' : ''}
                            ${event.status === 'pending' ? 'bg-amber-500/20 text-amber-300 border border-amber-400/30' : ''}">
                            ${event.status.charAt(0).toUpperCase() + event.status.slice(1)}
                        </span>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-bold text-blue-300 uppercase tracking-wider mb-2">Description</label>
                <div class="text-white bg-slate-700/50 p-4 rounded-lg max-h-40 overflow-y-auto">${event.description || 'No description provided'}</div>
            </div>
        </div>
    `;
    
    document.getElementById('eventDetailsContent').innerHTML = content;
    document.getElementById('eventDetailsModal').classList.remove('hidden');
}

function closeEventDetails() {
    document.getElementById('eventDetailsModal').classList.add('hidden');
}

function deleteEvent(eventId) {
    const event = eventsData.find(e => e.id === eventId);
    if (!event) return;
    
    document.getElementById('deleteEventForm').action = `/events/${eventId}`;
    document.getElementById('deleteConfirmModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteConfirmModal').classList.add('hidden');
}

function editEvent(eventId) {
    console.log('editEvent called with ID:', eventId);
    const event = eventsData.find(e => e.id === eventId);
    if (!event) {
        console.error('Event not found:', eventId);
        return;
    }
    
    console.log('Event found:', event);
    
    // Convert dates back to datetime-local format (YYYY-MM-DDTHH:mm)
    const formatDateForInput = (dateStr) => {
        const date = new Date(dateStr);
        return date.toISOString().slice(0, 16);
    };
    
    // Populate form fields
    document.getElementById('editTitle').value = event.title;
    document.getElementById('editDescription').value = event.description;
    document.getElementById('editType').value = event.type;
    document.getElementById('editLocation').value = event.location;
    document.getElementById('editStartDate').value = formatDateForInput(event.start_date);
    document.getElementById('editEndDate').value = formatDateForInput(event.end_date);
    document.getElementById('editGuests').value = event.guests;
    document.getElementById('editBudget').value = event.budget;
    document.getElementById('editStatus').value = event.status;
    
    // Set form action
    document.getElementById('editEventForm').action = `/events/${eventId}`;
    
    // Show modal
    const modal = document.getElementById('editEventModal');
    console.log('Modal element:', modal);
    modal.classList.remove('hidden');
    console.log('Modal should be visible now');
}

function closeEditModal() {
    document.getElementById('editEventModal').classList.add('hidden');
}

// Close modals when clicking outside
document.addEventListener('click', function(event) {
    const eventModal = document.getElementById('eventDetailsModal');
    const deleteModal = document.getElementById('deleteConfirmModal');
    const editModal = document.getElementById('editEventModal');
    
    if (event.target === eventModal) {
        eventModal.classList.add('hidden');
    }
    if (event.target === deleteModal) {
        deleteModal.classList.add('hidden');
    }
    if (event.target === editModal) {
        editModal.classList.add('hidden');
    }
});
</script>
@endsection
