<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post) {
        $post->likes()->firstOrCreate([
            'user_id' => auth()->id()
        ]);
        return back();
    }
}

