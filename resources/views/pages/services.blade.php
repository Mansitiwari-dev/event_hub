@extends('layouts.master')

@section('title', 'Services - EventHub')

@section('content')
<div class="container mx-auto px-4 py-10">
  <h1 class="text-2xl font-bold">Our Services</h1>
  <p class="mt-4 text-gray-600">We list event services such as catering, decoration, DJs, security and more.</p>
  <div class="mt-6 grid md:grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded shadow">Catering</div>
    <div class="bg-white p-4 rounded shadow">Decoration</div>
    <div class="bg-white p-4 rounded shadow">DJ & Audio</div>
  </div>
</div>
@endsection
