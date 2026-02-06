<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $posts = Post::where('user_id', $user->id)
                     ->latest()
                     ->get();

        return view('profile', compact('user', 'posts'));
    }
}
