<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Feed;

class LikeController extends Controller
{
    public function store(Request $request, Feed $feed)
    {
        $like = Like::where('feed_id', $feed->id)->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'feed_id' => $feed->id,
            ]);
        }

        return redirect()->back();
    }
}
