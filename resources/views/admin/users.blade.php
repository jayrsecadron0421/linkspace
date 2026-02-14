<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management | Linkspace Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite('resources/css/admin/users.css')
</head>
<body class="admin-body">

    @include('admin.partials.navbar')

    <main class="dashboard-wrapper">
        <header class="dashboard-header" style="background: white; padding: 20px; border-radius: 16px; margin-bottom: 30px; border: 1px solid #eef2ef;">
            <div class="header-content">
                <h1 style="letter-spacing: -0.02em;">Users Management</h1>
                <p style="color: #6b7280; font-size: 0.95rem;">Manage, edit, and monitor your application's users.</p>
            </div>
            
            <div class="header-actions">
                <button class="primary-btn" onclick="openCreate()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add New User
                </button>
            </div>
        </header>

        <div class="admin-toolbar">
            <div class="search-container">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input id="search" class="search-input" placeholder="Search users by name or email...">
            </div>
        </div>

        <div class="table-card">
            <div class="table-wrapper">
                <table id="userTable">
                    @include('admin.partials.users-table')
                </table>
            </div>
        </div>
    </main>

    <div id="createModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h3>Create User</h3>
                <p>Fill in the details to add a new member.</p>
            </div>
            <form method="POST" action="/admin/users" class="modal-form">
                @csrf
                <div class="form-group">
                    <input name="name" 
                           class="modal-input" 
                           placeholder="Full Name" 
                           maxlength="15"
                           pattern="[^\s]+"
                           title="Name cannot contain spaces"
                           onkeypress="return event.charCode !== 32"
                           oninput="this.value = this.value.replace(/\s/g, '')"
                           required>
                </div>
                <div class="form-group">
                    <input name="email" 
                           class="modal-input" 
                           placeholder="Email Address" 
                           type="email"
                           maxlength="50"
                           pattern="[^\s]+"
                           title="Email address cannot contain spaces"
                           onkeypress="return event.charCode !== 32"
                           oninput="this.value = this.value.replace(/\s/g, '')"
                           required>
                </div>
                <div class="form-group">
                    <input name="password" 
                           class="modal-input" 
                           placeholder="Password" 
                           type="password" 
                           maxlength="10"
                           pattern="[^\s]+"
                           title="Password cannot contain spaces"
                           onkeypress="return event.charCode !== 32"
                           oninput="this.value = this.value.replace(/\s/g, '')"
                           required>
                </div>
                <div class="form-group">
                    <select name="role_id" class="modal-input" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn-submit">Create Account</button>
            </form>
        </div>
    </div>

    <script>
    // Search logic remains the same
    document.getElementById('search').addEventListener('keyup', function(){
        fetch('/admin/users/search?q=' + this.value)
        .then(res => res.text())
        .then(html => {
            document.querySelector('table').innerHTML = html;
        });
    });

    function openCreate(){ 
        // Clear all form fields
        document.querySelector('#createModal form').reset();
        
        // Show modal
        document.getElementById('createModal').style.display = 'flex'; 
        
        // Focus on first input (name field)
        setTimeout(() => {
            document.querySelector('#createModal input[name="name"]').focus();
        }, 100);
    }
    
    // Close modal on background click
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', e => {
            if(e.target.classList.contains('modal-overlay')){
                modal.style.display='none';
            }
        });
    });
    
    // Auto-clear and redirect after successful submission
    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            // Clear form fields
            document.querySelector('#createModal form').reset();
        });
    @endif
    </script>
</body>
</html>