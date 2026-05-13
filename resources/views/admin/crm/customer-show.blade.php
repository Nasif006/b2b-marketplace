@extends('layouts.admin')

@section('title', 'Customer Profile')
@section('page-title', 'CRM — Customer Profile')

@section('content')

<div class="mb-4">
    <a href="/admin/crm/customers" class="btn-admin btn-admin-ghost" style="padding:5px 14px;font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="row g-3 mb-4">

    {{-- PROFILE CARD --}}
    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-person me-2"></i>Profile</span>
            </div>
            <div class="admin-card-body">
                <div style="text-align:center;margin-bottom:20px;">
                    <div style="width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,#4f8ef7,#7c3aed);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:600;margin:0 auto 12px;">
                        {{ strtoupper(substr($customer->user->name, 0, 1)) }}
                    </div>
                    <div style="font-size:16px;font-weight:600;color:var(--text);">{{ $customer->user->name }}</div>
                    <div style="font-size:12px;color:var(--text-muted);">{{ $customer->user->email }}</div>
                </div>

                @php
                    $seg = $customer->segment;
                    $segStyle = match($seg) {
                        'vip'     => 'background:rgba(124,58,237,0.12);color:#a78bfa;border-color:rgba(124,58,237,0.2);',
                        'regular' => 'background:rgba(16,185,129,0.12);color:#34d399;border-color:rgba(16,185,129,0.2);',
                        default   => 'background:rgba(79,142,247,0.12);color:#93c5fd;border-color:rgba(79,142,247,0.2);',
                    };
                @endphp

                <div style="display:flex;flex-direction:column;gap:10px;font-size:13px;">
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Segment</span>
                        <span class="badge-status" style="{{ $segStyle }}">{{ ucfirst($seg) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Phone</span>
                        <span style="color:var(--text);">{{ $customer->phone ?? '—' }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Company</span>
                        <span style="color:var(--text);">{{ $customer->company ?? '—' }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Total Spent</span>
                        <span style="color:#34d399;font-weight:600;">৳ {{ number_format($totalSpent, 0) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="color:var(--text-muted);">Member Since</span>
                        <span style="color:var(--text);">{{ $customer->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ORDER HISTORY --}}
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-bag me-2"></i>Purchase History</span>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->user->orders as $order)
                    <tr>
                        <td style="color:var(--accent);font-family:'DM Mono',monospace;">#{{ $order->id }}</td>
                        <td>৳ {{ number_format($order->total, 0) }}</td>
                        <td>
                            <span class="badge-status {{ $order->payment_status === 'paid' ? 'confirmed' : 'pending' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-status {{ $order->status === 'confirmed' ? 'confirmed' : 'pending' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:var(--text-muted);padding:24px;">No orders yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- INTERACTION LOG --}}
<div class="row g-3">

    <div class="col-md-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-journal-text me-2"></i>Interaction History</span>
            </div>
            <div style="padding:16px 20px;max-height:360px;overflow-y:auto;">
                @forelse($customer->interactions as $interaction)
                <div style="border-left:2px solid var(--accent);padding:10px 14px;margin-bottom:12px;background:var(--surface-2);border-radius:0 8px 8px 0;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                        <span style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:var(--accent);">
                            {{ $interaction->type }}
                        </span>
                        <span style="font-size:11px;color:var(--text-muted);">
                            {{ $interaction->created_at->format('d M Y, H:i') }} · {{ $interaction->loggedBy->name ?? '—' }}
                        </span>
                    </div>
                    <div style="font-size:13.5px;color:var(--text-dim);">{{ $interaction->body }}</div>
                </div>
                @empty
                <div style="text-align:center;color:var(--text-muted);padding:24px;">No interactions logged yet</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- LOG INTERACTION FORM --}}
    <div class="col-md-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-plus-circle me-2"></i>Log Interaction</span>
            </div>
            <div class="admin-card-body">
                <form method="POST" action="/admin/crm/customers/{{ $customer->id }}/interactions">
                    @csrf

                    <div class="mb-3">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Type</label>
                        <select name="type" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            <option value="note">Note</option>
                            <option value="call">Call</option>
                            <option value="message">Message</option>
                            <option value="rfq">RFQ</option>
                            <option value="order">Order Related</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Details</label>
                        <textarea name="body" rows="4"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;resize:vertical;"
                            placeholder="What happened? e.g. Called buyer, discussed bulk order for 500 units..."></textarea>
                        @error('body')<div style="color:#f87171;font-size:12px;margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn-admin btn-admin-primary w-100">
                        <i class="bi bi-check2"></i> Save Interaction
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
