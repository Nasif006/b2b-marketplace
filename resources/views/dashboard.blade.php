<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#f5f6f8; }
        .hero { background:linear-gradient(135deg,#198754,#145c3a);color:white;padding:40px 20px;border-radius:0 0 18px 18px; }
        .stat-box { background:white;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.05);text-align:center; }
        .card-hover { transition:0.2s ease-in-out; }
        .card-hover:hover { transform:translateY(-3px); }
    </style>
</head>
<body>

@include('partials.navbar')

<div class="hero text-center">
    <h2>Welcome Back, {{ auth()->user()->name }}</h2>
    <p class="mb-0">Manage your orders, browse products, and track activity</p>
</div>

<div class="container mt-4">

    {{-- REAL DB STATS --}}
    @php
        $userId = auth()->id();
        $totalOrders   = \App\Models\Order::where('user_id', $userId)->count();
        $pendingOrders = \App\Models\Order::where('user_id', $userId)->where('status','pending')->count();
        $completedOrders = \App\Models\Order::where('user_id', $userId)->where('status','confirmed')->count();
        $totalSpent    = \App\Models\Order::where('user_id', $userId)->where('payment_status','paid')->sum('total');
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-box">
                <h5>Total Orders</h5>
                <h3 class="text-success">{{ $totalOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <h5>Pending</h5>
                <h3 class="text-warning">{{ $pendingOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <h5>Completed</h5>
                <h3 class="text-primary">{{ $completedOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <h5>Total Spent</h5>
                <h3 class="text-danger">৳{{ number_format($totalSpent, 0) }}</h3>
            </div>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <h5 class="mb-3">Quick Actions</h5>
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <a href="/products" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <i class="bi bi-shop fs-3 text-success mb-2"></i>
                    <h6>Browse Products</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/cart" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <i class="bi bi-cart fs-3 text-primary mb-2"></i>
                    <h6>My Cart</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/orders" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <i class="bi bi-bag fs-3 text-warning mb-2"></i>
                    <h6>My Orders</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/tickets/create" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <i class="bi bi-headset fs-3 text-danger mb-2"></i>
                    <h6>Support</h6>
                </div>
            </a>
        </div>
    </div>

    {{-- RECENT ORDERS --}}
    <h5 class="mb-3">Recent Orders</h5>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Order::where('user_id', auth()->id())->latest()->take(5)->get() as $order)
                    <tr>
                        <td class="fw-semibold">#{{ $order->id }}</td>
                        <td>৳ {{ number_format($order->total, 0) }}</td>
                        <td>
                            <span class="badge {{ $order->status === 'confirmed' ? 'bg-success' : ($order->status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="/orders/{{ $order->id }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No orders yet. <a href="/products">Browse products</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
