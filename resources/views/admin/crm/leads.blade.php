@extends('layouts.admin')

@section('title', 'Leads')
@section('page-title', 'CRM — Leads')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Leads</div>
        <div class="page-subtitle">Track and manage potential customers</div>
    </div>
    <a href="/admin/crm/leads/create" class="btn-admin btn-admin-primary">
        <i class="bi bi-plus"></i> Add Lead
    </a>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-funnel me-2"></i>Lead Pipeline</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $leads->total() }} total</span>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Source</th>
                <th>Status</th>
                <th>Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leads as $lead)
            <tr>
                <td style="color:var(--text);font-weight:500;">{{ $lead->name }}</td>
                <td>{{ $lead->company ?? '—' }}</td>
                <td>{{ $lead->phone ?? '—' }}</td>
                <td>
                    <span style="font-size:12px;color:var(--text-muted);">{{ ucfirst($lead->source) }}</span>
                </td>
                <td>
                    @php
                        $statusStyle = match($lead->status) {
                            'converted'  => 'background:rgba(16,185,129,0.12);color:#34d399;border-color:rgba(16,185,129,0.2);',
                            'qualified'  => 'background:rgba(124,58,237,0.12);color:#a78bfa;border-color:rgba(124,58,237,0.2);',
                            'contacted'  => 'background:rgba(245,158,11,0.12);color:#fbbf24;border-color:rgba(245,158,11,0.2);',
                            default      => 'background:rgba(79,142,247,0.12);color:#93c5fd;border-color:rgba(79,142,247,0.2);',
                        };
                    @endphp
                    <span class="badge-status" style="{{ $statusStyle }}">{{ ucfirst($lead->status) }}</span>
                </td>
                <td>{{ $lead->created_at->format('d M Y') }}</td>
                <td style="display:flex;gap:6px;">
                    <a href="/admin/crm/leads/{{ $lead->id }}/edit"
                        class="btn-admin btn-admin-ghost" style="padding:4px 10px;font-size:12px;">
                        Edit
                    </a>
                    <form method="POST" action="/admin/crm/leads/{{ $lead->id }}"
                        onsubmit="return confirm('Delete this lead?')">
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
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:32px;">
                    No leads yet. <a href="/admin/crm/leads/create" style="color:var(--accent);">Add your first lead</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($leads->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">
        {{ $leads->links() }}
    </div>
    @endif
</div>

@endsection
