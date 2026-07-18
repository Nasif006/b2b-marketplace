<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} — B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --navy:#0f172a;--blue:#3b82f6;--border:rgba(255,255,255,0.08); }
        body { background:#f8fafc;font-family:'DM Sans',sans-serif;margin:0; }
        .site-nav { background:var(--navy);padding:0 28px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;border-bottom:1px solid var(--border); }
        .nav-brand { font-size:17px;font-weight:700;color:white;text-decoration:none;display:flex;align-items:center;gap:8px; }
        .nav-brand-icon { width:26px;height:26px;background:linear-gradient(135deg,var(--blue),#7c3aed);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:12px; }
        .nav-btn { padding:6px 14px;border-radius:8px;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s;font-family:'DM Sans',sans-serif;cursor:pointer;border:none; }
        .nav-ghost { background:rgba(255,255,255,0.08);color:#cbd5e1;border:1px solid var(--border); }
        .nav-ghost:hover { background:rgba(255,255,255,0.14);color:white; }
        .nav-primary { background:var(--blue);color:white; }
        .nav-primary:hover { background:#2563eb;color:white; }
        .nav-warning { background:#d97706;color:white; }

        .product-img-main { width:100%;height:360px;object-fit:cover;border-radius:14px;border:1px solid #e2e8f0; }
        .product-img-placeholder { width:100%;height:360px;background:linear-gradient(135deg,#f1f5f9,#e2e8f0);border-radius:14px;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:56px;border:1px solid #e2e8f0; }

        .product-title { font-size:26px;font-weight:700;color:#0f172a;letter-spacing:-0.5px;margin-bottom:6px; }
        .product-supplier { font-size:13px;color:#64748b;margin-bottom:16px; }
        .product-price { font-size:32px;font-weight:700;color:#1d4ed8;margin-bottom:20px; }

        .info-grid { display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:24px; }
        .info-box { background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:14px; }
        .info-label { font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#94a3b8;margin-bottom:4px; }
        .info-value { font-size:18px;font-weight:700;color:#0f172a; }

        .action-card { background:white;border:1px solid #e2e8f0;border-radius:14px;padding:24px;position:sticky;top:80px; }
        .action-title { font-size:16px;font-weight:600;color:#0f172a;margin-bottom:6px; }
        .action-sub { font-size:13px;color:#64748b;margin-bottom:20px; }

        .btn-cart-main { display:block;width:100%;padding:12px;background:var(--blue);color:white;border:none;border-radius:10px;font-size:15px;font-weight:600;text-align:center;text-decoration:none;transition:all 0.2s;cursor:pointer;font-family:'DM Sans',sans-serif;margin-bottom:10px; }
        .btn-cart-main:hover { background:#2563eb;color:white;transform:translateY(-1px); }
        .btn-back { display:block;width:100%;padding:10px;background:transparent;color:#475569;border:1px solid #e2e8f0;border-radius:10px;font-size:14px;font-weight:500;text-align:center;text-decoration:none;transition:all 0.15s; }
        .btn-back:hover { border-color:var(--blue);color:var(--blue); }

        .desc-section { background:white;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-top:20px; }
    </style>
</head>
<body>

<nav class="site-nav">
    <a class="nav-brand" href="/">
        <div class="nav-brand-icon">⚡</div>
        B2B Platform
    </a>
    <div style="display:flex;gap:8px;align-items:center;">
        <a href="/products" class="nav-btn nav-ghost"><i class="bi bi-arrow-left me-1"></i>Marketplace</a>
        @auth
            <a href="/cart" class="nav-btn nav-ghost">
                <i class="bi bi-cart me-1"></i>Cart ({{ count(session('cart', [])) }})
            </a>
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

<div class="container py-4">

    {{-- BREADCRUMB --}}
    <nav style="font-size:13px;color:#94a3b8;margin-bottom:24px;">
        <a href="/" style="color:#94a3b8;text-decoration:none;">Home</a>
        <span class="mx-2">/</span>
        <a href="/products" style="color:#94a3b8;text-decoration:none;">Marketplace</a>
        <span class="mx-2">/</span>
        <span style="color:#0f172a;">{{ $product->name }}</span>
    </nav>

    <div class="row g-4">

        {{-- LEFT: IMAGE --}}
        <div class="col-md-7">
            @if($product->image)
                <img src="{{ $product->image }}" class="product-img-main"
                    onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="product-img-placeholder" style="display:none;">
                    <i class="bi bi-box-seam"></i>
                </div>
            @else
                <div class="product-img-placeholder">
                    <i class="bi bi-box-seam"></i>
                </div>
            @endif

            @if($product->description)
            <div class="desc-section">
                <div style="font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#94a3b8;margin-bottom:10px;">Description</div>
                <div style="font-size:14px;color:#475569;line-height:1.7;">{{ $product->description }}</div>
            </div>
            @endif
        </div>

        {{-- RIGHT: DETAILS + ACTION --}}
        <div class="col-md-5">

            <div class="action-card">
                @if($product->stock <= 50)
                <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:600;margin-bottom:14px;">
                    <i class="bi bi-exclamation-triangle me-1"></i> Low Stock — Order Soon
                </div>
                @endif

                <div class="product-title">{{ $product->name }}</div>
                <div class="product-supplier">
                    <i class="bi bi-person-check me-1"></i>
                    Supplied by <strong>{{ $product->supplier->name ?? 'Unknown' }}</strong>
                </div>
                <div class="product-price">৳ {{ number_format($product->price, 2) }}</div>

                <div class="info-grid">
                    <div class="info-box">
                        <div class="info-label">Stock</div>
                        <div class="info-value" style="{{ $product->stock <= 50 ? 'color:#dc2626;' : '' }}">
                            {{ $product->stock }}
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-label">Min. Order (MOQ)</div>
                        <div class="info-value">{{ $product->moq }} units</div>
                    </div>
                </div>

                <div class="action-title">Ready to order?</div>
                <div class="action-sub">Adding to cart applies MOQ automatically.</div>

                @auth
                    <a href="/cart/add/{{ $product->id }}" class="btn-cart-main">
                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-cart-main">
                        <i class="bi bi-cart-plus me-2"></i>Login to Order
                    </a>
                @endauth

                <a href="/products" class="btn-back">
                    <i class="bi bi-arrow-left me-1"></i>Back to Marketplace
                </a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
