<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Feed;

class CommentController extends Controller
{
    public function store(Request $request, Feed $feed)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'feed_id' => $feed->id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
