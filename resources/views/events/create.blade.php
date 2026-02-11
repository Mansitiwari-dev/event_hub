@extends('layouts.app')

@section('title', 'Create Event - EventHub')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-4">📅 Create New Event</h1>
            <p class="text-lg text-blue-200">Fill in the details below to create your event</p>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-pink-600 mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-700 rounded-2xl shadow-2xl p-8 md:p-10 border border-slate-600">
            <form method="POST" action="{{ route('events.store') }}" class="space-y-6">
                @csrf

                <!-- Event Title -->
                <div>
                    <label for="title" class="block text-sm font-bold text-white mb-2">Event Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 placeholder-slate-400 @error('title') border-red-500 @enderror" 
                           placeholder="Enter event title" required>
                    @error('title') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-bold text-white mb-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 placeholder-slate-400 @error('description') border-red-500 @enderror"
                              placeholder="Enter event description">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Event Type -->
                <div>
                    <label for="event_type" class="block text-sm font-bold text-white mb-2">Event Type</label>
                    <select id="event_type" name="event_type" 
                            class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 @error('event_type') border-red-500 @enderror"
                            required>
                        <option value="" class="bg-slate-700">-- Select Event Type --</option>
                        <option value="wedding" {{ old('event_type') == 'wedding' ? 'selected' : '' }} class="bg-slate-700">🎊 Wedding</option>
                        <option value="birthday" {{ old('event_type') == 'birthday' ? 'selected' : '' }} class="bg-slate-700">🎂 Birthday</option>
                        <option value="corporate" {{ old('event_type') == 'corporate' ? 'selected' : '' }} class="bg-slate-700">🏢 Corporate</option>
                        <option value="conference" {{ old('event_type') == 'conference' ? 'selected' : '' }} class="bg-slate-700">🎤 Conference</option>
                        <option value="anniversary" {{ old('event_type') == 'anniversary' ? 'selected' : '' }} class="bg-slate-700">💍 Anniversary</option>
                        <option value="other" {{ old('event_type') == 'other' ? 'selected' : '' }} class="bg-slate-700">⭐ Other</option>
                    </select>
                    @error('event_type') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Start & End Date/Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-bold text-white mb-2">Start Date & Time</label>
                        <input type="datetime-local" id="start_date" name="start_date" 
                               value="{{ old('start_date') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 @error('start_date') border-red-500 @enderror"
                               required>
                        @error('start_date') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-bold text-white mb-2">End Date & Time</label>
                        <input type="datetime-local" id="end_date" name="end_date" 
                               value="{{ old('end_date') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 @error('end_date') border-red-500 @enderror"
                               required>
                        @error('end_date') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-bold text-white mb-2">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}"
                           class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 placeholder-slate-400 @error('location') border-red-500 @enderror"
                           placeholder="Enter event location" required>
                    @error('location') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Guest Count & Budget -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="guest_count" class="block text-sm font-bold text-white mb-2">Expected Guests</label>
                        <input type="number" id="guest_count" name="guest_count" 
                               value="{{ old('guest_count', 0) }}" min="0"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 placeholder-slate-400 @error('guest_count') border-red-500 @enderror"
                               placeholder="0">
                        @error('guest_count') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="budget" class="block text-sm font-bold text-white mb-2">Budget ($)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-bold">$</span>
                            <input type="number" id="budget" name="budget" 
                                   value="{{ old('budget', 0) }}" min="0" step="0.01"
                                   class="w-full pl-8 px-4 py-3 bg-slate-700 border border-slate-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 placeholder-slate-400 @error('budget') border-red-500 @enderror"
                                   placeholder="0.00">
                        </div>
                        @error('budget') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-8 border-t border-slate-600">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg transform hover:scale-105 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Event
                    </button>
                    <a href="{{ route('events.index') }}" class="flex-1 bg-slate-600 hover:bg-slate-500 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection