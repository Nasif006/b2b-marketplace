@extends('layouts.admin')

@section('title', 'Customers')
@section('page-title', 'CRM — Customers')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Customers</div>
        <div class="page-subtitle">All registered buyers and their profiles</div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-person-lines-fill me-2"></i>Customer List</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $customers->total() }} total</span>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Segment</th>
                <th>Interactions</th>
                <th>Joined</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $customer)
            <tr>
                <td style="color:var(--text);font-weight:500;">{{ $customer->user->name ?? '—' }}</td>
                <td>{{ $customer->user->email ?? '—' }}</td>
                <td>{{ $customer->company ?? '—' }}</td>
                <td>
                    @php
                        $seg = $customer->segment;
                        $segStyle = match($seg) {
                            'vip'     => 'background:rgba(124,58,237,0.12);color:#a78bfa;border-color:rgba(124,58,237,0.2);',
                            'regular' => 'background:rgba(16,185,129,0.12);color:#34d399;border-color:rgba(16,185,129,0.2);',
                            default   => 'background:rgba(79,142,247,0.12);color:#93c5fd;border-color:rgba(79,142,247,0.2);',
                        };
                    @endphp
                    <span class="badge-status" style="{{ $segStyle }}">{{ ucfirst($seg) }}</span>
                </td>
                <td>{{ $customer->interactions_count }}</td>
                <td>{{ $customer->created_at->format('d M Y') }}</td>
                <td>
                    <a href="/admin/crm/customers/{{ $customer->id }}"
                        class="btn-admin btn-admin-ghost" style="padding:4px 12px;font-size:12px;">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:32px;">
                    No customers yet. They appear here when buyers register.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($customers->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">
        {{ $customers->links() }}
    </div>
    @endif
</div>

@endsection
