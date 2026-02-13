<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    @vite('resources/css/admin/dashboard.css')
</head>
<body>

    @include('admin.partials.navbar')

    <div class="admin-toolbar">
        <button class="primary-btn" onclick="openCreate()">+ New User</button>
        <input id="search" class="search-input" placeholder="Search users by name or email…">
    </div>


    <div id="createModal" class="modal-overlay">
        <div class="modal">
            <h3>Create User</h3>
            <form method="POST" action="/admin/users">
                @csrf
                <input name="name" placeholder="Name" required>
                <input name="email" placeholder="Email" required>
                <input name="password" placeholder="Password" type="password" required>
                <select name="role_id" required>
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <button>Create</button>
            </form>
        </div>
    </div>


    <div class="table-wrapper">
        <table id="userTable">
            @include('admin.partials.users-table')
        </table>
    </div>

    <div id="banModal" class="modal-overlay">
        <div class="modal">
            <h3>Ban User</h3>
            <form method="POST" id="banForm">
                @csrf
                <input name="days" placeholder="Days to ban">
                <button>Confirm Ban</button>
            </form>
        </div>
    </div>

    <div id="editModal" class="modal-overlay">
        <div class="modal">
            <h3>Edit User</h3>
            <form method="POST" id="editForm">
                @csrf @method('PUT')
                <input name="name" id="editName" placeholder="Name">
                <input name="email" id="editEmail" placeholder="Email">
                <button>Save</button>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('search').addEventListener('keyup', function(){
        fetch('/admin/users/search?q=' + this.value)
        .then(res => res.text())
        .then(html => {
            document.querySelector('table').innerHTML = html;
        });
    });

    function openBan(id){
        document.getElementById('banForm').action='/admin/users/'+id+'/ban';
        document.getElementById('banModal').style.display='flex';
    }

    function openCreate(){
        document.getElementById('createModal').style.display = 'flex';
    }

    function openEdit(id,name,email){
        document.getElementById('editForm').action='/admin/users/'+id;
        document.getElementById('editName').value=name;
        document.getElementById('editEmail').value=email;
        document.getElementById('editModal').style.display='flex';
    }

    // close modal on background click
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', e => {
            if(e.target.classList.contains('modal-overlay')){
                modal.style.display='none';
            }
        });
    });
    </script>

</body>
</html>