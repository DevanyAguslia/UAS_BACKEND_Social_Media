<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $feed_id)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->feed_id = $feed_id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
