<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Friendship;

class FriendshipController extends Controller
{
    public function sendFriendRequest(Request $request)
    {
        $user = Auth::user();
        $receiverId = $request->input('receiver_id');

        $receiver = User::find($receiverId);
        if (!$receiver) {
            return redirect()->back()->with('error', 'Penerima tidak ditemukan');
        }

        $existingRequest = Friendship::where('sender_id', $user->id)
            ->where('receiver_id', $receiverId)
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Permintaan pertemanan sudah dikirim');
        }

        Friendship::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Permintaan pertemanan terkirim');
    }


    public function acceptFriendRequest(Request $request)
    {
        $user = Auth::user();
        $requestId = $request->input('request_id');

        $friendshipRequest = Friendship::find($requestId);

        if (!$friendshipRequest || $friendshipRequest->receiver_id !== $user->id) {
            return response()->json(['error' => 'Permintaan pertemanan tidak ditemukan'], 404);
        }

        $friendshipRequest->status = 'accepted';
        $friendshipRequest->save();

        $friends = Friendship::where('status', 'accepted')
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver'])
            ->get();

        $friendsList = [];
        foreach ($friends as $friendship) {
            $friendsList[] = $friendship->sender_id == $user->id ? $friendship->receiver : $friendship->sender;
        }

        return redirect()->route('friend-list')->with('friends', $friendsList);
    }

    public function rejectFriendRequest(Request $request)
    {
        $user = Auth::user();
        $requestId = $request->input('request_id');
    
        $friendshipRequest = Friendship::find($requestId);
    
        if (!$friendshipRequest || $friendshipRequest->receiver_id !== $user->id) {
            return redirect()->back()->with('error', 'Permintaan pertemanan tidak ditemukan');
        }
    
        $friendshipRequest->status = 'rejected';
        $friendshipRequest->save();
    
        return redirect()->back()->with('success', 'Permintaan pertemanan ditolak');
    }
    

    public function getFriendList(Request $request)
    {
        $user = Auth::user();

        $friendships = Friendship::where('status', 'accepted')
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->with('sender', 'receiver')
            ->get();

        $friends = [];
        foreach ($friendships as $friendship) {
            $friends[] = $friendship->sender_id == $user->id ? $friendship->receiver : $friendship->sender;
        }

        return response()->json($friends);
    }

    public function showFriendRequests()
    {
        $friendRequests = Friendship::where('receiver_id', auth()->id())->where('status', 'pending')->get();
        return view('friendship.friend-requests', compact('friendRequests'));
    }

    public function showFriendList()
    {
        $user = auth()->user();
        $friendships = Friendship::where('status', 'accepted')
            ->where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->get();

        $friendIds = $friendships->pluck('sender_id')->merge($friendships->pluck('receiver_id'));
        $friends = User::whereIn('id', $friendIds)->get();

        return view('friendship.friend-list', compact('friends'));
    }

    public function searchUsers(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('username', 'like', "%$search%")->get();
        return view('friendship.addFriend', ['dicari' => $users]);
    }
}
