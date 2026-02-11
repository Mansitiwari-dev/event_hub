@extends('layouts.app')

@section('title', 'My Events - EventHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Success Notification -->
        @if(session('success'))
            <div id="success-alert" class="mb-8 animate-fade-in-up">
                <div class="bg-gradient-to-r from-green-400 to-emerald-500 rounded-xl shadow-xl p-6 border-l-4 border-green-600">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-white animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white mb-1">🎉 Success!</h3>
                            <p class="text-white text-sm">{{ session('success') }}</p>
                        </div>
                        <button onclick="document.getElementById('success-alert').remove();" class="flex-shrink-0 text-white hover:text-gray-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <script>
                // Auto-hide notification after 5 seconds
                setTimeout(function() {
                    const alert = document.getElementById('success-alert');
                    if(alert) {
                        alert.style.transition = 'opacity 0.5s ease-out';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    }
                }, 5000);
            </script>
        @endif

        <!-- Error Notification -->
        @if(session('error'))
            <div id="error-alert" class="mb-8 animate-fade-in-up">
                <div class="bg-gradient-to-r from-red-400 to-red-500 rounded-xl shadow-xl p-6 border-l-4 border-red-600">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white mb-1">⚠️ Error!</h3>
                            <p class="text-white text-sm">{{ session('error') }}</p>
                        </div>
                        <button onclick="document.getElementById('error-alert').remove();" class="flex-shrink-0 text-white hover:text-gray-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                // Auto-hide notification after 5 seconds
                setTimeout(function() {
                    const alert = document.getElementById('error-alert');
                    if(alert) {
                        alert.style.transition = 'opacity 0.5s ease-out';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    }
                }, 5000);
            </script>
        @endif

        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-2">📅 My Events</h1>
                    <p class="text-lg text-blue-200">Manage all your upcoming events</p>
                </div>
                <a href="{{ route('events.create') }}" class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-2 justify-center md:justify-start">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Event
                </a>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full"></div>
        </div>

        <!-- Events Table/Grid -->
        @if($events->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-8 border-b border-slate-600">
                    <h2 class="text-3xl font-black text-white">Your Events</h2>
                    <p class="text-blue-200 mt-1">Track and manage all your upcoming events</p>
                </div>
                <table class="w-full">
                    <thead class="bg-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">Event Title</th>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-4 text-left font-bold text-blue-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-600">
                        @foreach($events as $event)
                            <tr class="border-t border-slate-600 hover:bg-slate-700/50 transition-colors duration-200">
                                <td class="px-6 py-5 font-semibold text-white">{{ $loop->iteration }}</td>
                                <td class="px-6 py-5">
                                    <p class="font-semibold text-white">{{ $event->title }}</p>
                                    @if($event->description)
                                        <p class="text-sm text-blue-200 truncate">{{ Str::limit($event->description, 50) }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-blue-200">{{ $event->location }}</td>
                                <td class="px-6 py-5">
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30">
                                        {{ ucfirst($event->event_type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $statusClass = match($event->status) {
                                            'draft' => 'bg-gray-500/20 text-gray-300 border border-gray-400/30',
                                            'published' => 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30',
                                            'pending' => 'bg-amber-500/20 text-amber-300 border border-amber-400/30',
                                            'ongoing' => 'bg-blue-500/20 text-blue-300 border border-blue-400/30',
                                            'completed' => 'bg-purple-500/20 text-purple-300 border border-purple-400/30',
                                            'cancelled' => 'bg-red-500/20 text-red-300 border border-red-400/30',
                                            default => 'bg-gray-500/20 text-gray-300 border border-gray-400/30'
                                        };
                                    @endphp
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-blue-200">{{ $event->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <span class="text-slate-400 text-sm">Go to Dashboard to manage</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-slate-700 p-6 border-t border-slate-600 rounded-b-2xl">
                <a href="{{ route('events.index') }}" class="text-blue-400 hover:text-blue-300 font-bold transition-colors duration-200 flex items-center gap-2">View all events <span class="text-xl">→</span></a>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden space-y-4">
                @foreach($events as $event)
                    <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-xl shadow-lg p-6 border border-slate-600 hover:border-blue-500 transition-all">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-bold text-white">{{ $event->title }}</h3>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-300 border border-blue-400/30">
                                {{ ucfirst($event->event_type) }}
                            </span>
                        </div>
                        
                        @if($event->description)
                            <p class="text-sm text-blue-200 mb-3">{{ Str::limit($event->description, 80) }}</p>
                        @endif
                        
                        <div class="space-y-2 mb-4 text-sm text-blue-200">
                            <p><strong>📍 Location:</strong> {{ $event->location }}</p>
                            <p><strong>📅 Created:</strong> {{ $event->created_at->format('M d, Y') }}</p>
                        </div>

                        <div class="flex gap-2">
                            <span class="flex-1 text-center px-3 py-2 bg-slate-600 text-white font-semibold rounded-lg text-sm">
                                Manage in Dashboard
                            </span>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $events->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl p-12 text-center border border-slate-600">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-2xl font-bold text-white mb-2">No Events Yet</h3>
                <p class="text-blue-200 mb-6">You haven't created any events yet. Let's get started!</p>
                <a href="{{ route('events.create') }}" class="inline-block bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Create Your First Event
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
