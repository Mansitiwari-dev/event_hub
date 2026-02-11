@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h2 class="text-2xl font-semibold">Admin Dashboard</h2>
  <p class="text-gray-600 mt-2">Welcome, {{ auth()->user()->name }}.</p>
  <div class="mt-6 grid md:grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">Customers: {{ $customers_count ?? 0 }}</div>
    <div class="bg-white p-4 rounded shadow">Organizers: {{ $organizers_count ?? 0 }}</div>
    <div class="bg-white p-4 rounded shadow">Vendors: {{ $vendors_count ?? 0 }}</div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('app-content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
      <p class="text-gray-500 mt-1">System overview and quick actions</p>
    </div>
    <div>
      <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg shadow hover:opacity-95">Manage Users</a>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-5">
      <div class="flex items-center justify-between">
        <div>
          <div class="text-sm text-gray-500">Customers</div>
          <div class="text-2xl font-bold text-gray-800">{{ $customers_count ?? 0 }}</div>
        </div>
        <div class="text-3xl text-primary">👥</div>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5">
      <div class="flex items-center justify-between">
        <div>
          <div class="text-sm text-gray-500">Organizers</div>
          <div class="text-2xl font-bold text-gray-800">{{ $organizers_count ?? 0 }}</div>
        </div>
        <div class="text-3xl text-primary">🧑‍💼</div>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5">
      <div class="flex items-center justify-between">
        <div>
          <div class="text-sm text-gray-500">Vendors</div>
          <div class="text-2xl font-bold text-gray-800">{{ $vendors_count ?? 0 }}</div>
        </div>
        <div class="text-3xl text-primary">🏷️</div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-5">
      <h3 class="font-semibold text-gray-800 mb-3">Recent Activity</h3>
      <div class="space-y-3">
        @if(!empty($activities))
          @foreach($activities as $act)
            <div class="text-sm text-gray-700">{{ $act->description ?? '—' }} <span class="text-xs text-gray-400">· {{ $act->created_at->diffForHumans() ?? '' }}</span></div>
          @endforeach
        @else
          <div class="text-gray-500">No recent activity.</div>
        @endif
      </div>
    </div>

    <div class="bg-white rounded-lg shadow p-5">
      <h3 class="font-semibold text-gray-800 mb-3">System Overview</h3>
      <div class="text-gray-600 text-sm">Uptime, queued jobs and logs will appear here.</div>
    </div>
  </div>
</div>
@endsection