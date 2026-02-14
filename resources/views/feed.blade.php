<!DOCTYPE html>
<html>
<head>
    <title>Linkspace</title>
    @vite('resources/css/feed.css')
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">Linkspace</div>

    <div class="nav-links">
        <a href="/">Home</a>
        <a href="/profile">Profile</a>
        <a href="/messages">Messages</a>
        <a href="/settings">Settings</a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">Logout</button>
    </form>
</div>

<div class="feed-container">
    <div class="feed">

        <!-- CREATE POST -->
        <form method="POST" action="/posts" enctype="multipart/form-data" class="create-post">
            @csrf
            <textarea name="content" 
                      placeholder="What's on your mind?" 
                      maxlength="255"
                      required></textarea>

            <label>
                <input type="file" name="media" hidden>
                <button type="button" class="photo-btn">📷</button>
            </label>

            <button class="post-btn">Post</button>
        </form>

        <!-- POSTS -->
        @foreach($posts as $post)
        <div class="post-card">

            <div class="post-user">{{ $post->user->name }}</div>
            <div>{{ $post->content }}</div>

            @if($post->media_type == 'image')
                <img src="{{ asset('storage/'.$post->media_path) }}" class="post-media">
            @endif

            @if($post->media_type == 'video')
                <video src="{{ asset('storage/'.$post->media_path) }}" controls class="post-media"></video>
            @endif

            <form method="POST" action="/like/{{ $post->id }}">
                @csrf
                <button>👍 Like ({{ $post->likes->count() }})</button>
            </form>

            @foreach($post->comments as $comment)
                <div>{{ $comment->content }}</div>
            @endforeach

            <form method="POST" action="/comment/{{ $post->id }}" class="comment-box">
                @csrf
                <input class="comment-input" 
                       name="content" 
                       placeholder="Write a comment..." 
                       maxlength="255"
                       required>
            </form>

        </div>
        @endforeach

    </div>
</div>

</body>
</html>