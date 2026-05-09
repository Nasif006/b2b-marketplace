@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="page-header">
    <div class="page-title">Platform Overview</div>
    <div class="page-subtitle">Welcome back, {{ auth()->user()->name }}. Here's what's happening today.</div>
</div>

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="stat-card accent">
            <i class="bi bi-people stat-icon"></i>
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ \App\Models\User::count() }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card success">
            <i class="bi bi-box-seam stat-icon"></i>
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ \App\Models\Product::count() }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card warning">
            <i class="bi bi-bag stat-icon"></i>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ \App\Models\Order::count() }}</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card purple">
            <i class="bi bi-currency-dollar stat-icon"></i>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">৳ {{ number_format(\App\Models\Order::where('payment_status','paid')->sum('total'), 0) }}</div>
        </div>
    </div>

</div>

{{-- SECOND ROW --}}
<div class="row g-3 mb-4">

    {{-- RECENT ORDERS --}}
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-bag me-2"></i>Recent Orders</span>
                <a href="/admin/orders" class="btn-admin btn-admin-ghost" style="padding:4px 12px;font-size:12px;">
                    View All
                </a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Buyer</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Order::with('user')->latest()->take(6)->get() as $order)
                    <tr>
                        <td style="color:var(--accent);font-family:'DM Mono',monospace;">#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? '—' }}</td>
                        <td>৳ {{ number_format($order->total, 0) }}</td>
                        <td>
                            <span class="badge-status {{ $order->payment_status === 'paid' ? 'confirmed' : 'pending' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-status {{ $order->status === 'confirmed' ? 'confirmed' : ($order->status === 'rejected' ? 'rejected' : 'pending') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;color:var(--text-muted);padding:28px;">
                            No orders yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="col-md-4">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <span class="admin-card-title"><i class="bi bi-lightning me-2"></i>Quick Actions</span>
            </div>
            <div class="admin-card-body d-flex flex-column gap-2">
                <a href="/admin/users" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-people"></i> Manage Users
                </a>
                <a href="/admin/crm/customers" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-person-lines-fill"></i> View Customers
                </a>
                <a href="/admin/crm/leads" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-funnel"></i> Manage Leads
                </a>
                <a href="/admin/automation/rules" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-lightning-charge"></i> Automation Rules
                </a>
                <a href="/admin/campaigns" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-megaphone"></i> Campaigns
                </a>
                <a href="/admin/social" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-share"></i> Social Media
                </a>
                <a href="/admin/tickets" class="btn-admin btn-admin-ghost w-100">
                    <i class="bi bi-headset"></i> Support Tickets
                </a>
            </div>
        </div>
    </div>

</div>

{{-- RECENT USERS --}}
<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-people me-2"></i>Recent Users</span>
        <a href="/admin/users" class="btn-admin btn-admin-ghost" style="padding:4px 12px;font-size:12px;">
            View All
        </a>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse(\App\Models\User::with('role')->latest()->take(5)->get() as $user)
            <tr>
                <td style="color:var(--text);">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge-status {{ $user->role?->name === 'admin' ? 'confirmed' : ($user->role?->name === 'supplier' ? 'pending' : 'inactive') }}"
                        style="{{ $user->role?->name === 'buyer' ? 'background:rgba(79,142,247,0.1);color:#93c5fd;border-color:rgba(79,142,247,0.2);' : '' }}">
                        {{ ucfirst($user->role?->name ?? 'none') }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;color:var(--text-muted);padding:28px;">No users found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
