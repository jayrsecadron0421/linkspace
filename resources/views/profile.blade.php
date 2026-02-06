<!DOCTYPE html>
<html>
<head>
    <title>{{ $user->name }}</title>
    @vite('resources/css/profile.css')
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

    <!-- COVER + PROFILE WRAPPER -->
    <div class="profile-top">

        <!-- COVER -->
        <div class="profile-cover">
            <form method="POST" action="#" enctype="multipart/form-data">
                @csrf
                <label class="cover-edit">
                    Edit cover photo
                    <input type="file" name="cover" hidden>
                </label>
            </form>
        </div>

        <!-- PROFILE HEADER -->
        <div class="profile-header">

            <!-- AVATAR -->
            <form method="POST" action="#" enctype="multipart/form-data" class="avatar-wrapper">
                @csrf
                <label class="profile-avatar">
                    Profile Picture
                    <input type="file" name="avatar" hidden>
                </label>
            </form>

            <div class="profile-name">
                <h2>{{ $user->name }}</h2>
                <small>Friends: 0</small>
            </div>

        </div>

    </div>

    <!-- GRID -->
    <div class="profile-grid">

        <!-- LEFT -->
        <div class="post-card">
            <h4>Personal details</h4>
            <p>Email: {{ $user->email }}</p>
            <a href="/settings">Edit</a>
        </div>

        <!-- RIGHT -->
        <div>
            <!-- Create post -->
            <form method="POST" action="/posts" enctype="multipart/form-data" class="create-post">
                @csrf
                <textarea name="content" placeholder="What's on your mind?"></textarea>
                <button class="post-btn">Post</button>
            </form>

            <!-- Posts -->
            @foreach($posts as $post)
                <div class="post-card">
                    {{ $post->content }}
                </div>
            @endforeach
        </div>

    </div>

</div>
</div>

</body>
</html>
