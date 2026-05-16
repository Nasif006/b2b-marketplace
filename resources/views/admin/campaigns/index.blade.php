@extends('layouts.admin')

@section('title', 'Campaigns')
@section('page-title', 'Marketing — Campaigns')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Campaigns</div>
        <div class="page-subtitle">Email and SMS marketing campaigns</div>
    </div>
    <a href="/admin/campaigns/create" class="btn-admin btn-admin-primary">
        <i class="bi bi-plus"></i> New Campaign
    </a>
</div>

{{-- TEMPLATE QUICK-START CARDS --}}
<div class="row g-3 mb-4">
    @foreach([
        ['Welcome Email', 'Sent automatically when a new buyer registers', 'user_registered', 'bi-person-check', '#4f8ef7'],
        ['Order Confirmation', 'Triggered when a buyer places an order', 'order_placed', 'bi-bag-check', '#10b981'],
        ['Abandoned Cart', 'Remind buyers who left items in cart', 'abandoned_cart', 'bi-cart-x', '#f59e0b'],
    ] as $tpl)
    <div class="col-md-4">
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:18px 20px;display:flex;gap:14px;align-items:flex-start;">
            <div style="width:36px;height:36px;border-radius:8px;background:{{ $tpl[4] }}20;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi {{ $tpl[2] }}" style="color:{{ $tpl[4] }};font-size:16px;"></i>
            </div>
            <div>
                <div style="font-weight:600;font-size:13.5px;color:var(--text);margin-bottom:3px;">{{ $tpl[0] }}</div>
                <div style="font-size:12px;color:var(--text-muted);">{{ $tpl[1] }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-megaphone me-2"></i>All Campaigns</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $campaigns->total() }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Trigger</th>
                <th>Audience</th>
                <th>Recipients</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($campaigns as $campaign)
            <tr>
                <td style="color:var(--text);font-weight:500;">{{ $campaign->name }}</td>
                <td>
                    <span style="font-size:12px;font-family:'DM Mono',monospace;background:rgba(79,142,247,0.1);color:#93c5fd;padding:2px 8px;border-radius:5px;">
                        {{ strtoupper($campaign->type) }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--text-muted);">{{ ucfirst(str_replace('_',' ',$campaign->trigger)) }}</td>
                <td style="font-size:12px;color:var(--text-muted);">{{ ucfirst(str_replace('_',' ',$campaign->audience)) }}</td>
                <td>{{ $campaign->logs_count }}</td>
                <td>
                    @php
                        $st = $campaign->status;
                        $stStyle = match($st) {
                            'sent'      => 'background:rgba(16,185,129,0.12);color:#34d399;border-color:rgba(16,185,129,0.2);',
                            'scheduled' => 'background:rgba(245,158,11,0.12);color:#fbbf24;border-color:rgba(245,158,11,0.2);',
                            'cancelled' => 'background:rgba(239,68,68,0.1);color:#f87171;border-color:rgba(239,68,68,0.2);',
                            default     => 'background:rgba(255,255,255,0.06);color:var(--text-muted);border-color:var(--border);',
                        };
                    @endphp
                    <span class="badge-status" style="{{ $stStyle }}">{{ ucfirst($st) }}</span>
                </td>
                <td style="display:flex;gap:6px;">
                    <a href="/admin/campaigns/{{ $campaign->id }}"
                        class="btn-admin btn-admin-ghost" style="padding:4px 10px;font-size:12px;">
                        View
                    </a>
                    @if($campaign->status !== 'sent')
                    <form method="POST" action="/admin/campaigns/{{ $campaign->id }}/send">
                        @csrf
                        <button type="submit" class="btn-admin btn-admin-primary" style="padding:4px 10px;font-size:12px;">
                            Send
                        </button>
                    </form>
                    @endif
                    <form method="POST" action="/admin/campaigns/{{ $campaign->id }}"
                        onsubmit="return confirm('Delete campaign?')">
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
                    No campaigns yet. <a href="/admin/campaigns/create" style="color:var(--accent);">Create your first</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($campaigns->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">{{ $campaigns->links() }}</div>
    @endif
</div>

@endsection
