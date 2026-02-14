<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings | Linkspace Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite('resources/css/admin/settings.css')
</head>
<body class="admin-body">

    @include('admin.partials.navbar')

    <main class="dashboard-wrapper">
        <header class="dashboard-header">
            <div>
                <h1>Settings</h1>
                <p>Manage your account preferences and security settings.</p>
            </div>
        </header>

        <div class="settings-grid">
            <aside class="settings-nav">
                <a href="settings" class="nav-item active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Profile Information
                </a>
                <a href="security" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    Security & Password
                </a>
            </aside>

            <div class="settings-content">
                
                <section id="profile" class="settings-card">
                    <div class="card-header">
                        <h3>Update Profile</h3>
                        <p>Change your public-facing name and identity.</p>
                    </div>
                    <form method="POST" action="{{ route('admin.settings.profile') }}" class="settings-form">
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input name="name" 
                                   class="settings-input" 
                                   value="{{ auth()->user()->name }}" 
                                   placeholder="Your Name"
                                   maxlength="15"
                                   pattern="[^\s]+"
                                   title="Name cannot contain spaces"
                                   onkeypress="return event.charCode !== 32"
                                   oninput="this.value = this.value.replace(/\s/g, '')"
                                   required>
                        </div>
                        <button class="primary-btn">Save Changes</button>
                    </form>
                </section>

            </div>
        </div>
    </main>

</body>
</html>