@extends('layouts.dashboard')

@section('title', 'Messages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Messages</h5>
                    <div class="input-group" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Search conversations..." id="searchConversations">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Sidebar with conversations -->
                        <div class="col-md-4 border-end" style="max-height: 70vh; overflow-y: auto;">
                            <div class="list-group list-group-flush">
                                @forelse($conversations as $userId => $messages)
                                    @php
                                        $user = $messages->first()->sender_id == auth()->id() 
                                            ? $messages->first()->receiver 
                                            : $messages->first()->sender;
                                        $unreadCount = $messages->where('receiver_id', auth()->id())
                                                            ->whereNull('read_at')
                                                            ->count();
                                    @endphp
                                    <a href="{{ route('organizer.messages.show', $user) }}" 
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->is('organizer/messages/' . $user->id) ? 'active' : '' }}">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded-circle bg-primary text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <small class="text-muted">
                                                    {{ Str::limit($messages->first()->message, 30) }}
                                                </small>
                                            </div>
                                        </div>
                                        @if($unreadCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                                        @endif
                                    </a>
                                @empty
                                    <div class="p-4 text-center text-muted">
                                        No conversations yet. Start a new one!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Main chat area -->
                        <div class="col-md-8 d-flex flex-column" style="height: 70vh;">
                            <div class="text-center p-5 text-muted">
                                <i class="bi bi-chat-square-text fs-1"></i>
                                <p class="mt-3">Select a conversation or start a new one</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchConversations').addEventListener('input', function(e) {
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
</script>
@endpush
@endsection
