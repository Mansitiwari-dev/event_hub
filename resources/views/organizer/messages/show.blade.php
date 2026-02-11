@extends('layouts.dashboard')

@section('title', 'Chat with ' . $recipient->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('organizer.messages.index') }}" class="btn btn-sm btn-outline-secondary me-2 d-md-none">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <span class="avatar-initial rounded-circle bg-primary text-white">
                                    {{ strtoupper(substr($recipient->name, 0, 1)) }}
                                </span>
                            </div>
                            <h5 class="mb-0">{{ $recipient->name }}</h5>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-dark p-0" type="button" id="conversationActions" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="conversationActions">
                            <li><a class="dropdown-item" href="#">View Profile</a></li>
                            <li><a class="dropdown-item" href="#">Clear Chat</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Block User</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Sidebar with conversations - Hidden on mobile -->
                        <div class="col-md-4 border-end d-none d-md-block" style="max-height: 65vh; overflow-y: auto;">
                            <div class="p-3 border-bottom">
                                <input type="text" class="form-control" placeholder="Search conversations..." id="searchSidebar">
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($conversations as $userId => $messages)
                                    @php
                                        $user = $messages->first()->sender_id == auth()->id() 
                                            ? $messages->first()->receiver 
                                            : $messages->first()->sender;
                                        $unreadCount = $messages->where('receiver_id', auth()->id())
                                                            ->whereNull('read_at')
                                                            ->count();
                                    @endphp
                                    <a href="{{ route('organizer.messages.show', $user) }}" 
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $user->id == $recipient->id ? 'active' : '' }}">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded-circle bg-primary text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <small class="text-muted">
                                                    {{ Str::limit($messages->first()->message, 20) }}
                                                </small>
                                            </div>
                                        </div>
                                        @if($unreadCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Main chat area -->
                        <div class="col-md-8 d-flex flex-column" style="height: 65vh;">
                            <!-- Messages -->
                            <div class="flex-grow-1 p-4 overflow-auto" id="chat-messages">
                                @foreach($messages->reverse() as $message)
                                    <div class="mb-4 {{ $message->sender_id == auth()->id() ? 'text-end' : '' }}">
                                        <div class="d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                                            @if($message->sender_id != auth()->id())
                                                <div class="avatar me-2">
                                                    <span class="avatar-initial rounded-circle bg-primary text-white">
                                                        {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="p-3 rounded-3 {{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}" 
                                                     style="max-width: 70%; display: inline-block;">
                                                    {{ $message->message }}
                                                </div>
                                                <div class="small text-muted mt-1">
                                                    {{ $message->created_at->format('h:i A') }}
                                                    @if($message->sender_id == auth()->id())
                                                        @if($message->read_at)
                                                            <i class="bi bi-check2-all text-primary ms-1"></i>
                                                        @else
                                                            <i class="bi bi-check2 text-muted ms-1"></i>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Message input -->
                            <form action="{{ route('organizer.messages.store', $recipient) }}" method="POST" class="border-top p-3">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="message" class="form-control" placeholder="Type a message..." required>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-scroll to bottom of chat
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Search functionality for sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchSidebar');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll('.list-group-item').forEach(item => {
                    const userName = item.querySelector('h6').textContent.toLowerCase();
                    const lastMessage = item.querySelector('small').textContent.toLowerCase();
                    if (userName.includes(searchTerm) || lastMessage.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    });

    // Auto-refresh messages every 10 seconds
    setInterval(function() {
        fetch(`{{ route('organizer.messages.show', $recipient) }}?ajax=1`)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newMessages = doc.getElementById('chat-messages');
                if (newMessages) {
                    document.getElementById('chat-messages').innerHTML = newMessages.innerHTML;
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            });
    }, 10000);
</script>
@endpush
@endsection
