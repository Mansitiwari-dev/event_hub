@extends('layouts.master')
@section('title','Customer Dashboard')
@section('content')
<div class="container">
  <h1>Welcome, {{ auth()->user()->name }}</h1>
  <div class="grid cols-3">
    <div class="card"><h3>Events</h3><p>{{ $events_count ?? 0 }}</p></div>
    <div class="card"><h3>Bookings</h3><p>{{ $bookings_count ?? 0 }}</p></div>
    <div class="card"><h3>Vendors</h3><p>{{ $vendors_count ?? 0 }}</p></div>
  </div>
</div>
@endsection
