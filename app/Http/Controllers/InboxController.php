<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InboxController extends Controller
{
    public function index()
    {
        $latestChat = ChatMessage::latest()
            ->where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->first();

        if (!$latestChat) {
            $user_id = auth()->id();
        } else {
            $user_id = $latestChat->isSender()
                ? $latestChat->receiver_id
                : $latestChat->sender_id;
        }

        return redirect()->route('inbox.chat', $user_id);
    }


    public function userInbox(User $friend)
    {
        $user = auth()->user();
        
        $messages = ChatMessage::where('receiver_id', auth()->id())->get();

        foreach ($messages as $message) {
            $message->is_viewed=1;
            $message->save();
        }
        $query = User::where('id', '!=', auth()->id())
            ->with('client');

        if (!$user->isAdmin) {
            $query->where('isAdmin', 1);
        }

        $users = $query->get();

        $chatMateIds = DB::table('chat_messages')
            ->select('sender_id as user_id')
            ->whereNot('sender_id', auth()->id())
            ->where('receiver_id', auth()->id())
            ->union(
                DB::table('chat_messages')
                    ->select('receiver_id as user_id')
                    ->whereNot('receiver_id', auth()->id())
                    ->where('sender_id', auth()->id())
            )
            ->distinct()
            ->pluck('user_id');

        $chatMates = User::whereIn('id', $chatMateIds)
            ->with('client')
            ->get();

        $messages = ChatMessage::getMessages($friend)
            ->get();
        $currentUser = auth()->user();

        $component = auth()->user()->isAdmin
            ? 'Admin/Inbox/Index'
            : 'Client/Inbox';

        $friend = User::with('client')->find($friend->id);

        return Inertia::render($component, [
            'data' => compact([
                'messages',
                'friend',
                'currentUser',
                'chatMates',
                'users'
            ]),
        ]);
    }

    public function getMessages(User $friend)
    {
        $messages = ChatMessage::getMessages($friend)
            ->get();
        $currentUser = auth()->user();
        $friend = $friend->client;

        return Inertia::render('Inbox/Chat', [
            'data' => compact([
                'messages',
                'friend',
                'currentUser'
            ]),
        ]);
    }

    public function sendMessage(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'sender_id' => 'required|integer|exists:users,id',
            'receiver_id' => 'required|integer|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        // Create chat message
        $chat = ChatMessage::create([
            'sender_id' => $validated['sender_id'],
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message']
        ]);

        broadcast(new MessageSentEvent($chat));

        return response()->json([
            'status' => 'success',
            'chat' => $chat,
        ]);
    }

    public function inboxCount()
    {
        
        $count = ChatMessage::where('is_viewed', 0)
            ->where('receiver_id', auth()->user()->id)
            ->count();
        
        return $count;
    }
}
