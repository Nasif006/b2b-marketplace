<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace — B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:#0f172a;
            --blue:#3b82f6;
            --blue-soft:rgba(59,130,246,0.1);
            --border:rgba(255,255,255,0.08);
        }
        body { background:#f8fafc;font-family:'DM Sans',sans-serif;margin:0; }

        /* NAVBAR */
        .site-nav { background:var(--navy);padding:0 28px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;border-bottom:1px solid var(--border); }
        .nav-brand { font-size:17px;font-weight:700;color:white;text-decoration:none;display:flex;align-items:center;gap:8px; }
        .nav-brand-icon { width:26px;height:26px;background:linear-gradient(135deg,var(--blue),#7c3aed);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:12px; }
        .nav-links { display:flex;align-items:center;gap:8px; }
        .nav-btn { padding:6px 14px;border-radius:8px;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s;font-family:'DM Sans',sans-serif;cursor:pointer;border:none; }
        .nav-ghost { background:rgba(255,255,255,0.08);color:#cbd5e1;border:1px solid var(--border); }
        .nav-ghost:hover { background:rgba(255,255,255,0.14);color:white; }
        .nav-primary { background:var(--blue);color:white; }
        .nav-primary:hover { background:#2563eb;color:white; }
        .nav-warning { background:#d97706;color:white; }
        .nav-warning:hover { background:#b45309;color:white; }

        /* PAGE HEADER */
        .page-header { background:linear-gradient(135deg,var(--navy),#1e3a5f);padding:40px 20px;color:white;text-align:center; }
        .page-header h1 { font-size:28px;font-weight:700;letter-spacing:-0.5px;margin-bottom:6px; }
        .page-header p { color:#94a3b8;font-size:14px;margin:0; }

        /* FILTERS */
        .filters-bar { background:white;border-bottom:1px solid #e2e8f0;padding:14px 0; }

        /* PRODUCT CARD */
        .product-card { background:white;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;transition:all 0.2s;height:100%; }
        .product-card:hover { box-shadow:0 8px 32px rgba(0,0,0,0.08);transform:translateY(-3px);border-color:#bfdbfe; }
        .product-img { width:100%;height:180px;object-fit:cover;background:#f1f5f9; }
        .product-img-placeholder { width:100%;height:180px;background:linear-gradient(135deg,#f1f5f9,#e2e8f0);display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:32px; }
        .product-body { padding:16px; }
        .product-name { font-size:15px;font-weight:600;color:#0f172a;margin-bottom:4px; }
        .product-supplier { font-size:12px;color:#94a3b8;margin-bottom:10px; }
        .product-price { font-size:20px;font-weight:700;color:#1d4ed8;margin-bottom:10px; }
        .product-meta { display:flex;gap:12px;margin-bottom:14px; }
        .meta-chip { font-size:11px;background:#f8fafc;border:1px solid #e2e8f0;color:#64748b;padding:3px 8px;border-radius:6px; }
        .low-stock { background:#fef2f2;border-color:#fecaca;color:#dc2626; }
        .btn-cart { display:block;width:100%;padding:9px;background:var(--blue);color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;text-align:center;text-decoration:none;transition:all 0.15s;cursor:pointer;font-family:'DM Sans',sans-serif;margin-bottom:6px; }
        .btn-cart:hover { background:#2563eb;color:white; }
        .btn-details { display:block;width:100%;padding:8px;background:transparent;color:#475569;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;font-weight:500;text-align:center;text-decoration:none;transition:all 0.15s; }
        .btn-details:hover { border-color:var(--blue);color:var(--blue); }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="site-nav">
    <a class="nav-brand" href="/">
        <div class="nav-brand-icon">⚡</div>
        B2B Platform
    </a>
    <div class="nav-links">
        <a href="/" class="nav-btn nav-ghost">Home</a>
        @auth
            @php $role = auth()->user()->role?->name; @endphp
            @if($role === 'buyer')
                <a href="/cart" class="nav-btn nav-ghost">
                    <i class="bi bi-cart"></i> Cart ({{ count(session('cart', [])) }})
                </a>
                <a href="/dashboard" class="nav-btn nav-ghost">Dashboard</a>
                <a href="/orders" class="nav-btn nav-ghost">Orders</a>
            @elseif($role === 'supplier')
                <a href="/supplier/dashboard" class="nav-btn nav-ghost">Supplier Panel</a>
            @elseif($role === 'admin')
                <a href="/admin/dashboard" class="nav-btn nav-ghost">Admin Panel</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="nav-btn nav-warning">Logout</button>
            </form>
        @else
            <a href="/login" class="nav-btn nav-ghost">Login</a>
            <a href="/register" class="nav-btn nav-primary">Register</a>
        @endauth
    </div>
</nav>

{{-- PAGE HEADER --}}
<div class="page-header">
    <h1><i class="bi bi-shop me-2"></i>Marketplace</h1>
    <p>Browse wholesale products from verified suppliers</p>
</div>

{{-- PRODUCTS --}}
<div class="container py-4">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div style="font-size:14px;color:#64748b;">
            Showing <strong style="color:#0f172a;">{{ $products->total() }}</strong> products
        </div>
    </div>

    <div class="row g-3">
        @forelse($products as $product)
        <div class="col-md-4 col-sm-6">
            <div class="product-card">
                @if($product->image)
                    <img src="{{ $product->image }}" class="product-img"
                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="product-img-placeholder" style="display:none;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                @else
                    <div class="product-img-placeholder">
                        <i class="bi bi-box-seam"></i>
                    </div>
                @endif

                <div class="product-body">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-supplier">
                        <i class="bi bi-person me-1"></i>{{ $product->supplier->name ?? 'Unknown Supplier' }}
                    </div>
                    <div class="product-price">৳ {{ number_format($product->price, 0) }}</div>
                    <div class="product-meta">
                        <span class="meta-chip"><i class="bi bi-layers me-1"></i>MOQ: {{ $product->moq }}</span>
                        <span class="meta-chip {{ $product->stock <= 50 ? 'low-stock' : '' }}">
                            Stock: {{ $product->stock }}
                            @if($product->stock <= 50) ⚠ @endif
                        </span>
                    </div>

                    @auth
                        <a href="/cart/add/{{ $product->id }}" class="btn-cart">
                            <i class="bi bi-cart-plus me-1"></i>Add to Cart
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-cart">
                            <i class="bi bi-cart-plus me-1"></i>Add to Cart
                        </a>
                    @endauth
                    <a href="/products/{{ $product->id }}" class="btn-details">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5" style="color:#94a3b8;">
            <i class="bi bi-inbox" style="font-size:40px;display:block;margin-bottom:12px;"></i>
            No products available yet.
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($products->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
