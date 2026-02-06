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

<h3>Chat with {{ $user->name }}</h3>

@foreach($messages as $msg)
    <p><b>{{ $msg->sender->name }}</b>: {{ $msg->body }}</p>
@endforeach

<form method="POST" action="/messages/{{ $conversation->id }}">
@csrf
<input name="body">
<button>Send</button>
</form>


</div>
</div>
</body>
</html>