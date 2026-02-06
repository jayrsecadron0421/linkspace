<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Status</th><th>Action</th>
</tr>

@foreach($users as $user)
<tr>
<td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>
<span class="status {{ $user->is_active ? 'active' : 'banned' }}">
{{ $user->is_active ? 'Active' : 'Banned' }}
</span>
<td class="action-cell">
    <button class="action edit" onclick="openEdit({{ $user->id }},'{{ $user->name }}','{{ $user->email }}')">Edit</button>
    <button class="action ban" onclick="openBan({{ $user->id }})">Ban</button>
    <form method="POST" action="/admin/users/{{ $user->id }}" style="display:inline">
        @csrf @method('DELETE')
        <button class="action delete">Delete</button>
    </form>
</td>
</tr>
@endforeach
