<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    @vite('resources/css/settings.css')
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
<div class="settings">

    <h2>Settings</h2>

    <!-- PROFILE INFO -->
    <div class="settings-card">
        <h3>Profile Information</h3>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <label>Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ $user->name }}"
                   maxlength="15"
                   pattern="[^\s]+"
                   title="Name cannot contain spaces"
                   onkeypress="return event.charCode !== 32"
                   oninput="this.value = this.value.replace(/\s/g, '')"
                   required>

            <label>Email</label>
            <input type="email" 
                   name="email" 
                   value="{{ $user->email }}"
                   maxlength="50"
                   pattern="[^\s]+"
                   title="Email address cannot contain spaces"
                   onkeypress="return event.charCode !== 32"
                   oninput="this.value = this.value.replace(/\s/g, '')"
                   required>

            <button class="save-btn">Save</button>
        </form>
    </div>

    <!-- PASSWORD -->
    <div class="settings-card">
        <h3>Update Password</h3>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <label>Current Password</label>
            <input type="password" 
                   name="current_password"
                   maxlength="10"
                   pattern="[^\s]+"
                   title="Password cannot contain spaces"
                   onkeypress="return event.charCode !== 32"
                   oninput="this.value = this.value.replace(/\s/g, '')"
                   required>

            <label>New Password</label>
            <input type="password" 
                   name="password"
                   maxlength="10"
                   pattern="[^\s]+"
                   title="Password cannot contain spaces"
                   onkeypress="return event.charCode !== 32"
                   oninput="this.value = this.value.replace(/\s/g, '')"
                   required>

            <label>Confirm Password</label>
            <input type="password" 
                   name="password_confirmation"
                   maxlength="10"
                   pattern="[^\s]+"
                   title="Password cannot contain spaces"
                   onkeypress="return event.charCode !== 32"
                   oninput="this.value = this.value.replace(/\s/g, '')"
                   required>

            <button class="save-btn">Change Password</button>
        </form>
    </div>

    <!-- DELETE -->
    <div class="settings-card danger">
        <h3>Delete Account</h3>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <input type="password" 
                   name="password" 
                   placeholder="Confirm password"
                   maxlength="10"
                   pattern="[^\s]+"
                   title="Password cannot contain spaces"
                   onkeypress="return event.charCode !== 32"
                   oninput="this.value = this.value.replace(/\s/g, '')"
                   required>

            <button class="delete-btn">Delete Account</button>
        </form>
    </div>

</div>
</div>

</body>
</html>