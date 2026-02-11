@extends('layouts.app-dashboard')

@section('title', 'Dashboard - EventHub')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Here's what's happening with your events.</p>
        <div class="mt-4">
            <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                <i class="fas fa-plus mr-2"></i> Create Event
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Events</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalEvents ?? 0 }}</h3>
                    <div class="flex items-center mt-2 text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+12% from last month</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
            </div>
            <a href="{{ route('organizer.events.index') }}" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-800">View all events →</a>
        </div>

        <!-- Upcoming Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Upcoming Events</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $upcomingEvents->count() ?? 0 }}</h3>
                    <div class="flex items-center mt-2">
                        <span class="px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">New</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-green-50 text-green-600">
                    <i class="fas fa-calendar-plus text-xl"></i>
                </div>
            </div>
            <a href="{{ route('organizer.events.index') }}?filter=upcoming" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-800">View upcoming →</a>
        </div>

        <!-- Total Attendees Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Attendees</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalAttendees ?? 0 }}</h3>
                    <div class="flex items-center mt-2 text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+5% this month</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
            <a href="#" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-800">View attendees →</a>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">${{ number_format($totalRevenue ?? 0, 2) }}</h3>
                    <div class="flex items-center mt-2 text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+9% from last month</span>
                    </div>
                </div>
                <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                    <i class="fas fa-dollar-sign text-xl"></i>
                </div>
            </div>
            <a href="#" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-800">View reports →</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Events -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Upcoming Events</h3>
                </div>
                <div class="p-6">
                    @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingEvents as $event)
                                <div class="flex items-start p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $event->title }}</h4>
                                        <div class="mt-1 flex items-center text-sm text-gray-500">
                                            <i class="far fa-calendar-alt mr-1.5"></i>
                                            <span>{{ $event->start_date->format('M j, Y') }}</span>
                                            <span class="mx-2">•</span>
                                            <i class="far fa-clock mr-1.5"></i>
                                            <span>{{ $event->start_date->format('g:i A') }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $event->status === 'upcoming' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('organizer.events.index') }}?filter=upcoming" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">View all upcoming events →</a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                            <h4 class="text-lg font-medium text-gray-700">No upcoming events</h4>
                            <p class="text-gray-500 mt-1 mb-4">Get started by creating a new event.</p>
                            <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                                <i class="fas fa-plus mr-2"></i> New Event
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                </div>
                <div class="p-4 space-y-2">
                    <a href="{{ route('organizer.events.create') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-900">Create New Event</h4>
                            <p class="text-xs text-gray-500">Set up a new event in minutes</p>
                        </div>
                    </a>
                    <a href="{{ route('organizer.events.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-900">Manage Events</h4>
                            <p class="text-xs text-gray-500">View and edit your events</p>
                        </div>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-sm font-medium text-gray-900">View Profile</h4>
                            <p class="text-xs text-gray-500">Update your account details</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-6 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                </div>
                <div class="p-6">
                    @if(isset($recentActivities) && $recentActivities->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentActivities as $activity)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-history text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-800">
                                            {{ $activity->description }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $activity->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-history text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">No recent activity to display</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="mt-12 text-center text-gray-500 text-sm">
    © 2026 EventHub — {{ date('Y') }}
</footer>
@endsection