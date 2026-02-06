<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with('user','likes','comments')->latest()->get();
        return view('feed', compact('posts'));
    }

    public function store(Request $request) {
        $request->validate([
            'content' => 'nullable',
            'media' => 'nullable|mimes:jpg,jpeg,png,mp4,mov|max:20000'
        ]);

        $path = null;
        $type = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $path = $file->store('posts','public');
            $type = str_contains($file->getMimeType(),'video') ? 'video' : 'image';
        }

        auth()->user()->posts()->create([
            'content' => $request->content,
            'media_path' => $path,
            'media_type' => $type
        ]);

        return back();
    }
}

