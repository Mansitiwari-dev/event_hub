@extends('layouts.app')

@section('title', 'Chat - ' . $user->name)

@section('content')
<div class="container py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Back Link -->
        <a href="{{ route('chats.conversations') }}" class="text-primary hover:underline mb-6 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Back to Messages
        </a>

        <!-- Chat Container -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col" style="height: 600px;">
            <!-- Chat Header -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                        <p class="text-blue-100 text-sm">{{ $user->role->display_name }}</p>
                    </div>
                    @if($user->vendorProfile)
                        <a href="{{ route('vendors.show', $user->vendorProfile) }}" class="text-white hover:text-blue-100 transition">
                            <i class="fas fa-user-circle text-3xl"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50" id="messagesContainer">
                @forelse($messages as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }} fade-in">
                        <div class="max-w-xs lg:max-w-md">
                            <div class="flex items-end gap-3 {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                                @if($message->sender_id !== auth()->id())
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                                        style="background: #667eea;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif

                                <div class="{{ $message->sender_id === auth()->id() ? 'text-white' : 'bg-gray-200 text-gray-900' }} rounded-lg px-4 py-3 break-words"
                                    @if($message->sender_id === auth()->id()) style="background: #667eea;" @endif>
                                    <p>{{ $message->message }}</p>
                                    <p class="text-xs {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-600' }} mt-2">
                                        {{ $message->created_at->format('M d, H:i') }}
                                    </p>
                                </div>

                                @if($message->sender_id === auth()->id())
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                                        style="background: #4facfe;">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-message text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-600 text-lg">No messages yet</p>
                        <p class="text-gray-500 text-sm mt-2">Start a conversation</p>
                    </div>
                @endforelse
            </div>

            <!-- Message Input -->
            <form action="{{ route('organizer.chat.store', $user) }}" method="POST" class="p-6 border-t border-gray-200 bg-white">
                @csrf
                <div class="flex gap-3">
                    <input type="text" name="message" placeholder="Type your message..." 
                        class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 transition"
                        required autocomplete="off" id="message-input">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition">
                        <i class="fas fa-paper-plane mr-2"></i>Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-scroll to bottom of messages
    const messagesContainer = document.getElementById('messagesContainer');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Auto-refresh every 2 seconds for real-time updates
    setInterval(() => {
        location.reload();
    }, 3000);
</script>
@endsection
