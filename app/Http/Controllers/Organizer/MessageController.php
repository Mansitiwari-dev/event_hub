<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // Get all conversations for the current user
        $conversations = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function($message) {
                return $message->sender_id == Auth::id() ? $message->receiver_id : $message->sender_id;
            });

        return view('organizer.messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        // Get messages between the current user and the selected user
        $messages = Message::where(function($query) use ($user) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->latest()
            ->paginate(20);

        // Mark messages as read
        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('organizer.messages.show', [
            'messages' => $messages,
            'recipient' => $user,
            'conversations' => $this->getConversations()
        ]);
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        // You can add real-time notification here using Laravel Echo, Pusher, etc.

        return redirect()->route('organizer.messages.show', $user->id)
            ->with('success', 'Message sent successfully!');
    }

    protected function getConversations()
    {
        return Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function($message) {
                return $message->sender_id == Auth::id() ? $message->receiver_id : $message->sender_id;
            });
    }
}
