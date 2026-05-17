@extends('layouts.admin')
@section('title', 'Ticket')
@section('page-title', 'Support — Ticket Detail')

@section('content')

<div class="mb-4">
    <a href="/admin/tickets" class="btn-admin btn-admin-ghost" style="padding:5px 14px;font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="row g-3">
    <div class="col-md-8">

        {{-- TICKET BODY --}}
        <div class="admin-card mb-3">
            <div class="admin-card-header">
                <span class="admin-card-title">#{{ $ticket->id }} — {{ $ticket->subject }}</span>
                <span class="badge-status {{ $ticket->status === 'closed' ? 'confirmed' : ($ticket->status === 'in_progress' ? 'pending' : 'inactive') }}"
                    style="{{ $ticket->status === 'open' ? 'background:rgba(239,68,68,0.1);color:#f87171;border-color:rgba(239,68,68,0.2);' : '' }}">
                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                </span>
            </div>
            <div class="admin-card-body">
                <div style="font-size:13px;color:var(--text-dim);line-height:1.7;">{{ $ticket->body }}</div>
                <div style="margin-top:12px;font-size:11px;color:var(--text-muted);">
                    Submitted by <strong style="color:var(--text);">{{ $ticket->user->name }}</strong>
                    on {{ $ticket->created_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>

        {{-- ADMIN RESPONSE --}}
        @if($ticket->admin_response)
        <div class="admin-card mb-3">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-reply me-2"></i>Admin Response</span>
                <span style="font-size:11px;color:var(--text-muted);">{{ $ticket->responded_at?->format('d M Y, H:i') }}</span>
            </div>
            <div class="admin-card-body">
                <div style="font-size:13px;color:var(--text-dim);line-height:1.7;">{{ $ticket->admin_response }}</div>
            </div>
        </div>
        @endif

        {{-- RESPOND FORM --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-pencil me-2"></i>Respond</span>
            </div>
            <div class="admin-card-body">
                <form method="POST" action="/admin/tickets/{{ $ticket->id }}/respond">
                    @csrf
                    <div class="mb-3">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Response</label>
                        <textarea name="admin_response" rows="4"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;resize:vertical;"
                            placeholder="Write your response...">{{ $ticket->admin_response }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Update Status</label>
                        <select name="status" style="background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\Ticket::statusOptions() as $s)
                            <option value="{{ $s }}" {{ $ticket->status === $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $s)) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="bi bi-check2"></i> Save Response
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- SIDEBAR INFO --}}
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title">Ticket Info</span>
            </div>
            <div class="admin-card-body">
                <div style="display:flex;flex-direction:column;gap:12px;font-size:13px;">
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Buyer</span>
                        <span style="color:var(--text);">{{ $ticket->user->name }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Email</span>
                        <span style="color:var(--text);">{{ $ticket->user->email }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Submitted</span>
                        <span style="color:var(--text);">{{ $ticket->created_at->format('d M Y') }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Responded</span>
                        <span style="color:var(--text);">{{ $ticket->responded_at ? $ticket->responded_at->format('d M Y') : '—' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
