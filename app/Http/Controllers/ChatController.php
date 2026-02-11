<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('organizer.chat.index');
    }

    public function show($user)
    {
        return view('organizer.chat.show', compact('user'));
    }

    public function store(Request $request, $user)
    {
        // Add your message sending logic here
        return back()->with('success', 'Message sent!');
    }

    public function unreadCount()
    {
        return response()->json(['count' => 0]); // Update with actual unread count logic
    }
}