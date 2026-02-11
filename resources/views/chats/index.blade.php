@extends('layouts.dashboard')

@section('title', 'Messages - Event Hub')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

    
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Messages</h5>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Conversations List -->
                        <div class="col-md-4 border-end" style="max-height: 70vh; overflow-y: auto;">
                            <div class="p-3 border-bottom">
                                <div class="input-group">
                                    <input type="text" id="searchConversations" placeholder="Search conversations..." 
                                        class="form-control">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="list-group list-group-flush">
                                @forelse($conversations as $userId => $chats)
                                    @php
                                        $user = $chats->first()->sender_id == auth()->id() 
                                            ? $chats->first()->receiver 
                                            : $chats->first()->sender;
                                        $unreadCount = $chats->where('receiver_id', auth()->id())
                                                            ->where('is_read', false)
                                                            ->count();
                                    @endphp
                                    <a href="{{ route('organizer.chat.show', $user) }}" 
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->is('organizer/chat/' . $user->id) ? 'active' : '' }}">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded-circle bg-primary text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                <small class="text-muted">
                                                    {{ $user->role ? $user->role->display_name : 'User' }}
                                                </small>
                                            </div>
                                        </div>
                                        @if($unreadCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                                        @endif
                                    </a>
                                @empty
                                    <div class="p-4 text-center text-muted">
                                        <i class="bi bi-chat-square-text fs-1 d-block mb-2"></i>
                                        No conversations yet. Start a new one!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Chat Thread -->
                        <div class="col-md-8 d-flex flex-column" style="height: 70vh;">
                            <div class="text-center p-5 text-muted">
                                <i class="bi bi-chat-square-text fs-1"></i>
                                <h3 class="h5 mt-3">Select a Conversation</h3>
                                <p class="mb-0">Choose a contact to start chatting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-initial {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-weight: 600;
    }
    .list-group-item.active {
        z-index: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchConversations');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                document.querySelectorAll('.list-group-item').forEach(item => {
                    const userName = item.querySelector('h6').textContent.toLowerCase();
                    const userRole = item.querySelector('small').textContent.toLowerCase();
                    if (userName.includes(searchTerm) || userRole.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Update unread count in the sidebar
        function updateUnreadCount() {
            fetch('{{ route("organizer.chat.unread.count") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const unreadCount = document.getElementById('unreadCount');
                if (unreadCount) {
                    if (data.count > 0) {
                        unreadCount.textContent = data.count;
                        unreadCount.style.display = 'inline-block';
                    } else {
                        unreadCount.style.display = 'none';
                    }
                }
            });
        }

        // Update count every 30 seconds
        setInterval(updateUnreadCount, 30000);
        updateUnreadCount(); // Initial update
    });
</script>
@endpush
@endsection