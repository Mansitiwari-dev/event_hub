@extends('layouts.app')

@section('title', $event->title ?? 'Event Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
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

        <!-- Event Details Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl overflow-hidden border border-slate-600">
            <!-- Header with gradient background -->
            <div class="h-40 bg-gradient-to-r from-purple-600 to-pink-600 relative">
                <div class="absolute inset-0 opacity-20 bg-pattern"></div>
            </div>

            <!-- Content -->
            <div class="p-6 md:p-8">
                <!-- Title & Actions -->
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-8 -mt-10 relative">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl font-black text-white mb-2">{{ $event->title }}</h1>
                        <p class="text-lg text-blue-200">{{ ucfirst($event->event_type) }} • {{ $event->location }}</p>
                    </div>
                    
                    @if(auth()->user() && (auth()->id() == $event->customer_id || auth()->user()->hasRole('admin')))
                        <div class="flex gap-2">
                            <a href="{{ route('events.edit', $event) }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-lg transition-all duration-300 hover:shadow-lg text-sm">
                                ✏️ Edit
                            </a>
                            <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline" onsubmit="return confirm('Delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-lg transition-all duration-300 hover:shadow-lg text-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Event Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-600">
                    <div class="p-4 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-lg border border-blue-400/30">
                        <p class="text-sm font-semibold text-blue-300 mb-1">📅 Start Date</p>
                        <p class="text-lg font-bold text-blue-100">{{ $event->start_date->format('M d, Y') }}</p>
                        <p class="text-sm text-blue-300">{{ $event->start_date->format('h:i A') }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-emerald-500/20 to-emerald-600/20 rounded-lg border border-emerald-400/30">
                        <p class="text-sm font-semibold text-emerald-300 mb-1">🏁 End Date</p>
                        <p class="text-lg font-bold text-emerald-100">{{ $event->end_date->format('M d, Y') }}</p>
                        <p class="text-sm text-emerald-300">{{ $event->end_date->format('h:i A') }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-purple-500/20 to-purple-600/20 rounded-lg border border-purple-400/30">
                        <p class="text-sm font-semibold text-purple-300 mb-1">💰 Budget</p>
                        <p class="text-lg font-bold text-purple-100">${{ number_format($event->budget, 2) }}</p>
                    </div>

                    <div class="p-4 bg-gradient-to-br from-orange-500/20 to-orange-600/20 rounded-lg border border-orange-400/30">
                        <p class="text-sm font-semibold text-orange-300 mb-1">👥 Guests</p>
                        <p class="text-lg font-bold text-orange-100">{{ $event->guest_count ?? 0 }} Expected</p>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <p class="text-sm font-semibold text-blue-200 mb-2">Status</p>
                    @php
                        $statusClass = match($event->status) {
                            'draft' => 'bg-gray-500/20 text-gray-300 border border-gray-400/30',
                            'pending' => 'bg-amber-500/20 text-amber-300 border border-amber-400/30',
                            'published' => 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/30',
                            'ongoing' => 'bg-blue-500/20 text-blue-300 border border-blue-400/30',
                            'completed' => 'bg-purple-500/20 text-purple-300 border border-purple-400/30',
                            'cancelled' => 'bg-red-500/20 text-red-300 border border-red-400/30',
                            default => 'bg-gray-500/20 text-gray-300 border border-gray-400/30'
                        };
                    @endphp
                    <span class="inline-block px-4 py-2 rounded-full text-sm font-bold {{ $statusClass }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-xl font-bold text-white mb-3">📝 Description</h2>
                    <div class="p-4 bg-slate-700/50 rounded-lg border border-slate-600">
                        <p class="text-blue-100 leading-relaxed text-sm">
                            {{ $event->description ?? 'No description provided.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('events.index') }}" class="inline-block px-6 py-2 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-lg transition-all duration-300">
            </a>
        </div>
    </div>
</div>
@endsection
