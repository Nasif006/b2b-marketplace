@extends('layouts.admin')

@section('title', 'Automation Rules')
@section('page-title', 'Automation — Rules')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Workflow Rules</div>
        <div class="page-subtitle">IF trigger → THEN action automation engine</div>
    </div>
    <a href="/admin/automation/rules/create" class="btn-admin btn-admin-primary">
        <i class="bi bi-plus"></i> New Rule
    </a>
</div>

@if(count($rules) === 0)
<div style="background:rgba(79,142,247,0.08);border:1px solid rgba(79,142,247,0.2);border-radius:12px;padding:24px;margin-bottom:24px;color:var(--text-dim);font-size:13.5px;">
    <i class="bi bi-info-circle me-2" style="color:var(--accent);"></i>
    No rules yet. Create your first rule — e.g. <strong style="color:var(--text);">IF order_placed → THEN send_email</strong>
</div>
@endif

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-lightning-charge me-2"></i>Active Rules</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ count($rules) }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Rule Name</th>
                <th>Trigger (IF)</th>
                <th>Action (THEN)</th>
                <th>Times Fired</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rules as $rule)
            <tr>
                <td style="color:var(--text);font-weight:500;">{{ $rule->name }}</td>
                <td>
                    <span style="font-family:'DM Mono',monospace;font-size:12px;background:rgba(79,142,247,0.1);color:#93c5fd;padding:3px 8px;border-radius:6px;">
                        {{ $rule->trigger }}
                    </span>
                </td>
                <td>
                    <span style="font-family:'DM Mono',monospace;font-size:12px;background:rgba(124,58,237,0.1);color:#a78bfa;padding:3px 8px;border-radius:6px;">
                        {{ $rule->action }}
                    </span>
                </td>
                <td style="color:var(--text-dim);">{{ $rule->logs_count }}</td>
                <td>
                    <span class="badge-status {{ $rule->is_active ? 'confirmed' : 'inactive' }}">
                        {{ $rule->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td style="display:flex;gap:6px;">
                    <form method="POST" action="/admin/automation/rules/{{ $rule->id }}/toggle">
                        @csrf
                        <button type="submit" class="btn-admin btn-admin-ghost" style="padding:4px 10px;font-size:12px;">
                            {{ $rule->is_active ? 'Disable' : 'Enable' }}
                        </button>
                    </form>
                    <form method="POST" action="/admin/automation/rules/{{ $rule->id }}"
                        onsubmit="return confirm('Delete this rule?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin"
                            style="padding:4px 10px;font-size:12px;background:rgba(239,68,68,0.1);color:#f87171;border:1px solid rgba(239,68,68,0.2);">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">
                    No rules created yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-end">
    <a href="/admin/automation/logs" class="btn-admin btn-admin-ghost">
        <i class="bi bi-journal-text me-1"></i> View Execution Logs
    </a>
</div>

@endsection
