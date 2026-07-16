@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Commerce — All Products')

@section('content')

<div class="page-header">
    <div class="page-title">All Products</div>
    <div class="page-subtitle">Platform-wide product catalogue</div>
</div>

@php
    $products = \App\Models\Product::with('supplier')->latest()->paginate(20);
@endphp

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card accent">
            <i class="bi bi-box-seam stat-icon"></i>
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ \App\Models\Product::count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card warning">
            <i class="bi bi-exclamation-triangle stat-icon"></i>
            <div class="stat-label">Low Stock</div>
            <div class="stat-value">{{ \App\Models\Product::where('stock','<=',50)->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card success">
            <i class="bi bi-people stat-icon"></i>
            <div class="stat-label">Active Suppliers</div>
            <div class="stat-value">{{ \App\Models\User::whereHas('role', fn($q) => $q->where('name','supplier'))->count() }}</div>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-box-seam me-2"></i>Product List</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $products->total() }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Price</th>
                <th>Stock</th>
                <th>MOQ</th>
                <th>Added</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td style="color:var(--text);font-weight:500;">{{ $product->name }}</td>
                <td style="color:var(--text-dim);">{{ $product->supplier->name ?? '—' }}</td>
                <td style="color:var(--text);">৳ {{ number_format($product->price, 2) }}</td>
                <td>
                    @if($product->stock <= 50)
                        <span class="badge-status rejected">{{ $product->stock }} ⚠</span>
                    @else
                        <span style="color:var(--text-dim);">{{ $product->stock }}</span>
                    @endif
                </td>
                <td style="color:var(--text-dim);">{{ $product->moq }}</td>
                <td style="font-size:12px;color:var(--text-muted);">{{ $product->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">No products yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($products->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">{{ $products->links() }}</div>
    @endif
</div>

@endsection
