@extends('layouts.main')

@section('content')

<h1 class="mb-4">Supplier Dashboard</h1>

<div class="row mb-4">

    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h5>Total Products</h5>
            <h3>{{ $totalProducts }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h5>Low Stock Items</h5>
            <h3>{{ $lowStockProducts->count() }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h5>Quick Actions</h5>

            <a href="/supplier/products" class="btn btn-primary btn-sm mb-2 w-100">
                View Products
            </a>

            <a href="/supplier/products/create" class="btn btn-success btn-sm mb-2 w-100">
                Add Product
            </a>

            <a href="/supplier/orders" class="btn btn-warning btn-sm w-100">
                Orders
            </a>
        </div>
    </div>

</div>

{{-- LOW STOCK ALERT --}}
@if($lowStockProducts->count() > 0)
    <div class="alert alert-danger">
        <strong>⚠ Low Stock Alert</strong>
        <ul class="mb-0">
            @foreach($lowStockProducts as $product)
                <li>{{ $product->name }} (Stock: {{ $product->stock }})</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- PRODUCT LIST PREVIEW --}}
<div class="card shadow-sm p-3">
    <h5>Recent Products</h5>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products->take(5) as $product)
                <tr>
                    <td>{{ $product->name }}</td>

                    <td>
                        @if($product->stock <= 50)
                            <span class="badge bg-danger">
                                {{ $product->stock }}
                            </span>
                        @else
                            {{ $product->stock }}
                        @endif
                    </td>

                    <td>৳ {{ $product->price }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No products yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
