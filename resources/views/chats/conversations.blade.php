@extends('layouts.app')

@section('title', 'Messages')

@section('app-content')
<div class="container mx-auto px-4 py-8">
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 min-h-[70vh]">
    <div class="lg:col-span-1 bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="p-4 border-b font-bold text-gray-800">Conversations</div>
      <div class="divide-y max-h-[60vh] overflow-auto">
        @forelse($conversations as $u)
          <a href="{{ route('chats.conversations', ['u' => $u->id]) }}" class="flex items-center gap-3 p-3 hover:bg-gray-50 {{ request('u') == $u->id ? 'bg-gray-100' : '' }}">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white font-bold">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
            <div class="flex-1 min-w-0">
              <div class="font-semibold text-gray-800 truncate">{{ $u->name }}</div>
              <div class="text-xs text-gray-500 truncate">Online</div>
            </div>
          </a>
        @empty
          <div class="p-4 text-gray-500 text-sm">No conversations</div>
        @endforelse
      </div>
    </div>

    <div class="lg:col-span-3 bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
      @php $selectedId = request('u'); $selected = $conversations->firstWhere('id', $selectedId); @endphp

      @if($selected)
        <div class="p-4 border-b flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white font-bold">{{ strtoupper(substr($selected->name, 0, 1)) }}</div>
          <div>
            <div class="font-bold text-gray-800">{{ $selected->name }}</div>
            <div class="text-xs text-gray-500">Active now</div>
          </div>
        </div>

        <div class="flex-1 overflow-auto p-4 space-y-3" style="background-color:#f9fafb">
          @forelse($messages as $m)
            <div class="flex {{ $m->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
              <div class="max-w-xs px-4 py-2 rounded-lg {{ $m->sender_id == auth()->id() ? 'bg-gradient-to-r from-primary to-secondary text-white' : 'bg-white text-gray-800 border' }}">
                <div class="text-sm">{{ $m->message }}</div>
                <div class="text-xs {{ $m->sender_id == auth()->id() ? 'text-white/70' : 'text-gray-500' }} mt-1">{{ $m->created_at->format('H:i') }}</div>
              </div>
            </div>
          @empty
            <div class="text-center text-gray-500 mt-8">Start a conversation 👋</div>
          @endforelse
        </div>

        <form method="POST" action="{{ route('chats.send') }}" class="p-4 border-t flex gap-3">
          @csrf
          <input type="hidden" name="u" value="{{ $selectedId }}" />
          <input type="text" name="message" placeholder="Type message..." class="flex-1 rounded-lg border border-gray-200 px-4 py-2 focus:ring-2 focus:ring-primary focus:outline-none" />
          <button type="submit" class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-lg font-semibold hover:opacity-95">Send</button>
        </form>
      @else
        <div class="flex-1 flex items-center justify-center text-gray-500">
          <div class="text-center">
            <div class="text-2xl mb-3">💬</div>
            <div class="font-semibold">Select a conversation</div>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
