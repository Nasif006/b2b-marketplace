@extends('layouts.admin')
@section('title', 'Support Tickets')
@section('page-title', 'Support — Tickets')

@section('content')

<div class="page-header">
    <div class="page-title">Support Tickets</div>
    <div class="page-subtitle">Manage customer support requests</div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-headset me-2"></i>All Tickets</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $tickets->total() }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Buyer</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Submitted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td style="color:var(--accent);font-family:'DM Mono',monospace;">#{{ $ticket->id }}</td>
                <td style="color:var(--text);">{{ $ticket->user->name ?? '—' }}</td>
                <td style="color:var(--text-dim);">{{ Str::limit($ticket->subject, 50) }}</td>
                <td>
                    <span class="badge-status {{ $ticket->status === 'closed' ? 'confirmed' : ($ticket->status === 'in_progress' ? 'pending' : 'inactive') }}"
                        style="{{ $ticket->status === 'open' ? 'background:rgba(239,68,68,0.1);color:#f87171;border-color:rgba(239,68,68,0.2);' : '' }}">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--text-muted);">{{ $ticket->created_at->format('d M Y') }}</td>
                <td>
                    <a href="/admin/tickets/{{ $ticket->id }}"
                        class="btn-admin btn-admin-ghost" style="padding:4px 12px;font-size:12px;">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">No tickets yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($tickets->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">{{ $tickets->links() }}</div>
    @endif
</div>

@endsection
