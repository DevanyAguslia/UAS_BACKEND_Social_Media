<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(Request $request, $feed_id)
    {
        $feed = Feed::findOrFail($feed_id);

        $like = $feed->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
        } else {
            $like = new Like();
            $like->user_id = auth()->id();
            $feed->likes()->save($like);
        }

        return redirect()->back();
    }
}
