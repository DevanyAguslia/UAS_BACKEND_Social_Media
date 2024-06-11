<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Friendship;

class FriendshipController extends Controller
{
    /**
     * Mengirim permintaan pertemanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendFriendRequest(Request $request)
    {
        $user = Auth::user();
        $receiverId = $request->input('receiver_id');

        $receiver = User::find($receiverId);
        if (!$receiver) {
            return response()->json(['error' => 'Penerima tidak ditemukan'], 404);
        }

        $existingRequest = Friendship::where('sender_id', $user->id)
            ->where('receiver_id', $receiverId)
            ->first();

        if ($existingRequest) {
            return response()->json(['error' => 'Permintaan pertemanan sudah dikirim'], 400);
        }

        Friendship::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Permintaan pertemanan terkirim']);
    }

    /**
     * Menerima permintaan pertemanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    // Mendapatkan daftar teman setelah permintaan pertemanan diterima
    $friends = Friendship::where('status', 'accepted')
        ->where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
        ->with(['sender', 'receiver'])
        ->get();

    // Menyusun informasi teman
    $friendsList = [];
    foreach ($friends as $friendship) {
        $friendsList[] = $friendship->sender_id == $user->id ? $friendship->receiver : $friendship->sender;
    }

    // Mengembalikan tampilan dengan daftar teman yang diperbarui
    return redirect()->route('friend-list')->with('friends', $friendsList);
}

    

    /**
     * Menolak permintaan pertemanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rejectFriendRequest(Request $request)
    {
        $user = Auth::user();
        $requestId = $request->input('request_id');

        $friendshipRequest = Friendship::find($requestId);

        if (!$friendshipRequest || $friendshipRequest->receiver_id !== $user->id) {
            return response()->json(['error' => 'Permintaan pertemanan tidak ditemukan'], 404);
        }

        $friendshipRequest->status = 'rejected';
        $friendshipRequest->save();

        return response()->json(['message' => 'Permintaan pertemanan ditolak']);
    }

    /**
     * Mendapatkan daftar teman.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Menampilkan permintaan pertemanan yang masih tertunda.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFriendRequests()
    {
        $friendRequests = Friendship::where('receiver_id', auth()->id())->where('status', 'pending')->get();
        return view('friend-requests', compact('friendRequests'));
    }

    /**
     * Menampilkan daftar teman.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('friend-list', compact('friends'));
    }

        /**
     * Mencari pengguna berdasarkan nama.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchUsers(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('username', 'like', "%$search%")->get();
        // return response()->json($users);
        return view('addFriend',['dicari'=> $users]);
    }

}
