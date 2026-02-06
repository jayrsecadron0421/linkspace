<!DOCTYPE html>
<html>
<head>
    <title>Linkspace</title>
    @vite('resources/css/messages.css')
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

<h3>Messages</h3>

@foreach($conversations as $conv)
    <a href="/messages/{{ $conv->user_one == auth()->id() ? $conv->user_two : $conv->user_one }}">
        Open Chat
    </a><br>
@endforeach

</div>
</div>
</body>
</html>