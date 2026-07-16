@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Commerce — All Orders')

@section('content')

<div class="page-header">
    <div class="page-title">All Orders</div>
    <div class="page-subtitle">Platform-wide order management</div>
</div>

@php
    $orders = \App\Models\Order::with('user')->latest()->paginate(20);
@endphp

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card accent">
            <i class="bi bi-bag stat-icon"></i>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ \App\Models\Order::count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card warning">
            <i class="bi bi-clock stat-icon"></i>
            <div class="stat-label">Pending</div>
            <div class="stat-value">{{ \App\Models\Order::where('status','pending')->count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card success">
            <i class="bi bi-check-circle stat-icon"></i>
            <div class="stat-label">Confirmed</div>
            <div class="stat-value">{{ \App\Models\Order::where('status','confirmed')->count() }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card purple">
            <i class="bi bi-currency-dollar stat-icon"></i>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value" style="font-size:20px;">৳{{ number_format(\App\Models\Order::where('payment_status','paid')->sum('total'),0) }}</div>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-bag me-2"></i>Order List</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $orders->total() }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Buyer</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="color:var(--accent);font-family:'DM Mono',monospace;">#{{ str_pad($order->id,4,'0',STR_PAD_LEFT) }}</td>
                <td style="color:var(--text);">{{ $order->user->name ?? '—' }}</td>
                <td style="color:var(--text);font-weight:500;">৳ {{ number_format($order->total, 0) }}</td>
                <td style="font-size:12px;color:var(--text-muted);">{{ strtoupper($order->payment_method) }}</td>
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
                <td style="font-size:12px;color:var(--text-muted);">{{ $order->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:32px;">No orders yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($orders->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">{{ $orders->links() }}</div>
    @endif
</div>

@endsection
