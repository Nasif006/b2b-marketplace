@extends('layouts.admin')

@section('title', 'Workflow Logs')
@section('page-title', 'Automation — Execution Logs')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Workflow Logs</div>
        <div class="page-subtitle">Real-time record of every automation rule execution</div>
    </div>
    <a href="/admin/automation/rules" class="btn-admin btn-admin-ghost">
        <i class="bi bi-lightning-charge me-1"></i> Manage Rules
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-journal-text me-2"></i>Execution History</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $logs->total() }} total executions</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Rule</th>
                <th>Trigger</th>
                <th>Action</th>
                <th>Status</th>
                <th>Details</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td style="color:var(--text);font-weight:500;">{{ $log->rule->name ?? '—' }}</td>
                <td>
                    <span style="font-family:'DM Mono',monospace;font-size:11px;background:rgba(79,142,247,0.1);color:#93c5fd;padding:2px 7px;border-radius:5px;">
                        {{ $log->trigger }}
                    </span>
                </td>
                <td>
                    <span style="font-family:'DM Mono',monospace;font-size:11px;background:rgba(124,58,237,0.1);color:#a78bfa;padding:2px 7px;border-radius:5px;">
                        {{ $log->action }}
                    </span>
                </td>
                <td>
                    <span class="badge-status {{ $log->status === 'success' ? 'confirmed' : 'rejected' }}">
                        {{ ucfirst($log->status) }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--text-muted);max-width:260px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $log->details }}
                </td>
                <td style="font-size:12px;color:var(--text-muted);">
                    {{ $log->created_at->format('d M Y, H:i:s') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">
                    No executions yet. Create a rule and trigger an event to see logs here.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($logs->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">
        {{ $logs->links() }}
    </div>
    @endif
</div>

@endsection
