<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get all users except the current user
        $users = User::where('id', '!=', Auth::id())->get();
        
        // Get the selected user (if any)
        $selectedUser = null;
        $messages = [];
        
        if (request()->has('user')) {
            $selectedUser = User::findOrFail(request()->user);
            
            // Mark messages as read
            Message::where('sender_id', $selectedUser->id)
                ->where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->update(['is_read' => true]);
            
            // Get messages between the current user and selected user
            $messages = Message::where(function($query) use ($selectedUser) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $selectedUser->id);
            })->orWhere(function($query) use ($selectedUser) {
                $query->where('sender_id', $selectedUser->id)
                    ->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')->get();
        }
        
        return view('chat', compact('users', 'selectedUser', 'messages'));
    }

    public function getMessages($userId)
    {
        // Mark messages as read
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        // Get messages between the current user and selected user
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();
        
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json($message);
    }

    public function getUnreadCount()
    {
        $unreadCount = Message::where('receiver_id', Auth::id())
                            ->where('is_read', false)
                            ->count();
        
        return response()->json(['unread_count' => $unreadCount]);
    }
}