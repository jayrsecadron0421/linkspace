<thead>
    <tr>
        <th>User Details</th>
        <th>Status</th>
        <th class="text-right">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($users as $user)
    <tr>
        <td>
            <div class="user-identity">
                <div class="avatar-stack">
                    <span class="id-badge">#{{ $user->id }}</span>
                    <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                </div>
                <div class="user-info">
                    <span class="user-name">{{ $user->name }}</span>
                    <span class="user-email">{{ $user->email }}</span>
                </div>
            </div>
        </td>
        <td>
            <span class="status {{ $user->is_active ? 'active' : 'banned' }}">
                <span class="dot"></span>
                {{ $user->is_active ? 'Active' : 'Banned' }}
            </span>
        </td>
        <td class="text-right">
            <div class="action-cell">
                <button class="action-btn edit" onclick="openEdit({{ $user->id }},'{{ $user->name }}','{{ $user->email }}')" title="Edit User">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
                
                <button class="action-btn ban" onclick="openBan({{ $user->id }})" title="Ban User">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                </button>

                <form method="POST" action="/admin/users/{{ $user->id }}" style="display:inline" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button class="action-btn delete" title="Delete User">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>