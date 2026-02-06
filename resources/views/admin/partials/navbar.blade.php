<!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">Linkspace</div>

        <div class="nav-links">
            <a href="/admin">Home</a>
            <a href="/admin/users">Users</a>
            <a href="#">Posts</a>
            <a href="/admin/settings">Settings</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>