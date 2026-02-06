<!DOCTYPE html>
<html>
<head>
    <title>Admin Settings</title>
    @vite('resources/css/admin/dashboard.css')
</head>
<body>

@include('admin.partials.navbar')

<div class="admin-container">

    <div class="chart-card">
        <h3>Update Profile</h3>

        <form method="POST" action="{{ route('admin.settings.profile') }}" class="settings-form">
            @csrf
            <input name="name" value="{{ auth()->user()->name }}" placeholder="Name">
            <button class="primary-btn">Save</button>
        </form>
    </div>

    <div class="chart-card">
        <h3>Change Password</h3>

        <form method="POST" action="{{ route('admin.settings.password') }}" class="settings-form">
            @csrf
            <input type="password" name="current_password" placeholder="Current password">
            <input type="password" name="password" placeholder="New password">
            <input type="password" name="password_confirmation" placeholder="Confirm password">
            <button class="primary-btn">Change Password</button>
        </form>
    </div>

</div>

</body>
</html>
