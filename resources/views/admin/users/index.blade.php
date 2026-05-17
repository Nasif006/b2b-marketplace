@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'Admin — User Management')

@section('content')

<div class="page-header">
    <div class="page-title">User Management</div>
    <div class="page-subtitle">Manage all platform users and their roles</div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-people me-2"></i>All Users</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $users->total() }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>Joined</th>
                <th>Change Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td style="color:var(--text);font-weight:500;">
                    {{ $user->name }}
                    @if($user->id === auth()->id())
                        <span style="font-size:10px;color:var(--accent);margin-left:4px;">(you)</span>
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge-status {{ $user->role?->name === 'admin' ? 'confirmed' : ($user->role?->name === 'supplier' ? 'pending' : 'inactive') }}"
                        style="{{ $user->role?->name === 'buyer' ? 'background:rgba(79,142,247,0.1);color:#93c5fd;border-color:rgba(79,142,247,0.2);' : '' }}">
                        {{ ucfirst($user->role?->name ?? 'none') }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--text-muted);">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="/admin/users/{{ $user->id }}/role" style="display:flex;gap:8px;align-items:center;">
                        @csrf @method('PUT')
                        <select name="role_id" style="background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:6px;padding:4px 8px;font-size:12px;">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-admin btn-admin-primary" style="padding:4px 10px;font-size:12px;">
                            Update
                        </button>
                    </form>
                    @else
                        <span style="font-size:12px;color:var(--text-muted);">—</span>
                    @endif
                </td>
                <td>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="/admin/users/{{ $user->id }}"
                        onsubmit="return confirm('Delete {{ $user->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin"
                            style="padding:4px 10px;font-size:12px;background:rgba(239,68,68,0.1);color:#f87171;border:1px solid rgba(239,68,68,0.2);">
                            Delete
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">No users found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($users->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">{{ $users->links() }}</div>
    @endif
</div>

@endsection
