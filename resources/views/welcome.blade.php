<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B2B Platform — Wholesale Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0f172a;
            --navy-2: #1e293b;
            --navy-3: #334155;
            --blue: #3b82f6;
            --blue-soft: rgba(59,130,246,0.12);
            --blue-2: #60a5fa;
            --text: #f1f5f9;
            --text-muted: #94a3b8;
            --border: rgba(255,255,255,0.08);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
        }

        /* ── NAVBAR ── */
        .site-nav {
            background: var(--navy);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
        }

        .nav-brand {
            font-size: 18px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-brand-icon {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--blue), #7c3aed);
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
        }

        .nav-links { display: flex; align-items: center; gap: 8px; }

        .nav-btn {
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            border: none;
        }

        .nav-btn-ghost {
            background: rgba(255,255,255,0.08);
            color: #cbd5e1;
            border: 1px solid var(--border);
        }

        .nav-btn-ghost:hover { background: rgba(255,255,255,0.14); color: white; }

        .nav-btn-primary {
            background: var(--blue);
            color: white;
        }

        .nav-btn-primary:hover { background: #2563eb; color: white; }

        .nav-btn-outline {
            background: transparent;
            color: #cbd5e1;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .nav-btn-outline:hover { background: rgba(255,255,255,0.06); color: white; }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 60%, #1e293b 100%);
            color: white;
            padding: 90px 20px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -100px; left: 50%;
            transform: translateX(-50%);
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--blue-soft);
            border: 1px solid rgba(59,130,246,0.3);
            color: var(--blue-2);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-size: clamp(32px, 5vw, 56px);
            font-weight: 700;
            letter-spacing: -1.5px;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero h1 span { color: var(--blue-2); }

        .hero p {
            font-size: 17px;
            color: #94a3b8;
            max-width: 520px;
            margin: 0 auto 36px;
            line-height: 1.6;
        }

        .hero-actions { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }

        .btn-hero-primary {
            padding: 12px 28px;
            background: var(--blue);
            color: white;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-hero-primary:hover { background: #2563eb; color: white; transform: translateY(-1px); }

        .btn-hero-ghost {
            padding: 12px 28px;
            background: rgba(255,255,255,0.08);
            color: white;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.15);
            transition: all 0.2s;
        }

        .btn-hero-ghost:hover { background: rgba(255,255,255,0.14); color: white; }

        /* ── STATS BAR ── */
        .stats-bar {
            background: var(--navy-2);
            border-bottom: 1px solid var(--border);
            padding: 20px 0;
        }

        .stat-item {
            text-align: center;
            padding: 0 20px;
        }

        .stat-item .num {
            font-size: 26px;
            font-weight: 700;
            color: white;
            font-family: 'DM Sans', sans-serif;
        }

        .stat-item .lbl {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
        }

        /* ── FEATURES ── */
        .features-section {
            padding: 80px 0;
            background: white;
        }

        .section-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(24px, 3vw, 36px);
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }

        .section-sub {
            font-size: 15px;
            color: #64748b;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .feature-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 28px 24px;
            height: 100%;
            transition: all 0.2s;
        }

        .feature-card:hover {
            border-color: #bfdbfe;
            box-shadow: 0 8px 24px rgba(59,130,246,0.08);
            transform: translateY(-2px);
        }

        .feature-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .feature-title {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .feature-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
        }

        /* ── PRODUCTS ── */
        .products-section {
            padding: 80px 0;
            background: #f8fafc;
        }

        .product-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.2s;
            height: 100%;
        }

        .product-card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            transform: translateY(-3px);
            border-color: #bfdbfe;
        }

        .product-card-body { padding: 20px; }

        .product-name {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: #1d4ed8;
            margin-bottom: 12px;
        }

        .product-meta {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .btn-product {
            display: block;
            width: 100%;
            padding: 9px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            transition: all 0.15s;
            margin-top: 8px;
        }

        .btn-product-primary {
            background: var(--blue);
            color: white;
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-product-primary:hover { background: #2563eb; color: white; }

        .btn-product-outline {
            border: 1px solid #e2e8f0;
            color: #475569;
            background: transparent;
        }

        .btn-product-outline:hover { border-color: var(--blue); color: var(--blue); }

        /* ── HOW IT WORKS ── */
        .how-section {
            padding: 80px 0;
            background: white;
        }

        .step-card {
            text-align: center;
            padding: 20px;
        }

        .step-num {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, var(--blue), #7c3aed);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin: 0 auto 16px;
        }

        .step-title {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .step-desc {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
        }

        /* ── CTA ── */
        .cta-section {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 100%);
            padding: 80px 20px;
            text-align: center;
            color: white;
        }

        .cta-section h2 {
            font-size: clamp(24px, 3vw, 38px);
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 16px;
        }

        .cta-section p {
            color: #94a3b8;
            font-size: 15px;
            margin-bottom: 32px;
        }

        /* ── FOOTER ── */
        .site-footer {
            background: var(--navy);
            color: #475569;
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            border-top: 1px solid var(--border);
        }

        .footer-brand { color: #64748b; font-weight: 500; }
        .footer-links { display: flex; gap: 20px; }
        .footer-links a { color: #475569; text-decoration: none; transition: color 0.15s; }
        .footer-links a:hover { color: #94a3b8; }

        /* badge */
        .low-stock-badge {
            display: inline-block;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

{{-- ── NAVBAR ── --}}
<nav class="site-nav">
    <a class="nav-brand" href="/">
        <div class="nav-brand-icon">⚡</div>
        B2B Platform
    </a>
    <div class="nav-links">
        <a href="/products" class="nav-btn nav-btn-ghost">Browse Products</a>
        <a href="/features" class="nav-btn nav-btn-outline">Features</a>
        @auth
            @php $role = auth()->user()->role?->name; @endphp
            @if($role === 'admin')
                <a href="/admin/dashboard" class="nav-btn nav-btn-ghost">Admin Panel</a>
            @elseif($role === 'supplier')
                <a href="/supplier/dashboard" class="nav-btn nav-btn-ghost">Supplier Panel</a>
            @else
                <a href="/dashboard" class="nav-btn nav-btn-ghost">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button class="nav-btn nav-btn-outline">Logout</button>
            </form>
        @else
            <a href="/login" class="nav-btn nav-btn-ghost">Login</a>
            <a href="/register" class="nav-btn nav-btn-primary">Get Started</a>
        @endauth
    </div>
</nav>

{{-- ── HERO ── --}}
<div class="hero">
    <div class="hero-badge">
        <i class="bi bi-lightning-fill"></i> B2B Automation Platform
    </div>
    <h1>The Smarter Way to<br><span>Buy & Sell Wholesale</span></h1>
    <p>A complete B2B marketplace with built-in CRM, workflow automation, marketing tools, and social media management.</p>
    <div class="hero-actions">
        <a href="/products" class="btn-hero-primary">
            <i class="bi bi-shop me-2"></i>Browse Marketplace
        </a>
        <a href="/register" class="btn-hero-ghost">
            <i class="bi bi-person-plus me-2"></i>Create Account
        </a>
    </div>
</div>

{{-- ── STATS BAR ── --}}
<div class="stats-bar">
    <div class="container">
        <div class="row g-0 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="num">{{ \App\Models\Product::count() }}+</div>
                    <div class="lbl">Products Listed</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="num">{{ \App\Models\User::whereHas('role', fn($q) => $q->where('name','supplier'))->count() }}+</div>
                    <div class="lbl">Verified Suppliers</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="num">{{ \App\Models\Order::count() }}+</div>
                    <div class="lbl">Orders Processed</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="num">3</div>
                    <div class="lbl">Automation Modules</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── FEATURES ── --}}
{{-- <div class="features-section" id="features">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label">Platform Capabilities</div>
            <div class="section-title">Everything You Need in One Platform</div>
            <div class="section-sub">From product discovery to order automation — fully integrated and ready to scale.</div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eff6ff;">
                        <i class="bi bi-shop" style="color:#3b82f6;"></i>
                    </div>
                    <div class="feature-title">Multi-Vendor Marketplace</div>
                    <div class="feature-desc">Browse and purchase products from multiple verified suppliers. Supports MOQ, bulk pricing, and stock tracking.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f0fdf4;">
                        <i class="bi bi-person-lines-fill" style="color:#16a34a;"></i>
                    </div>
                    <div class="feature-title">CRM System</div>
                    <div class="feature-desc">Customer profiling, purchase history, segmentation (New/Regular/VIP), lead pipeline, and interaction logging.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#faf5ff;">
                        <i class="bi bi-lightning-charge" style="color:#7c3aed;"></i>
                    </div>
                    <div class="feature-title">Workflow Automation</div>
                    <div class="feature-desc">IF→THEN rule engine. Auto-trigger actions on order placed, user registered, and more. Full execution log trail.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fff7ed;">
                        <i class="bi bi-megaphone" style="color:#ea580c;"></i>
                    </div>
                    <div class="feature-title">Marketing Automation</div>
                    <div class="feature-desc">Create email/SMS campaigns with trigger-based scheduling. Templates for welcome, order confirmation, and abandoned cart.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fdf2f8;">
                        <i class="bi bi-share" style="color:#db2777;"></i>
                    </div>
                    <div class="feature-title">Social Media Management</div>
                    <div class="feature-desc">Schedule Facebook and Instagram posts. Content calendar view. Track engagement metrics per post.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f0f9ff;">
                        <i class="bi bi-shield-check" style="color:#0284c7;"></i>
                    </div>
                    <div class="feature-title">Role-Based Access</div>
                    <div class="feature-desc">Separate dashboards for Admin, Supplier, and Buyer. Module-level enable/disable controls for platform management.</div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- ── FEATURED PRODUCTS ── --}}
<div class="products-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <div class="section-label">Marketplace</div>
                <div class="section-title mb-0">Featured Products</div>
            </div>
            <a href="/products" style="font-size:13px;color:var(--blue);text-decoration:none;font-weight:500;">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-3">
            @forelse($products as $product)
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-card-body">
                        @if($product->stock <= 50)
                            <div class="low-stock-badge"><i class="bi bi-exclamation-triangle me-1"></i>Low Stock</div>
                        @endif
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">৳ {{ number_format($product->price, 0) }}</div>
                        <div class="product-meta"><i class="bi bi-person me-1"></i>{{ $product->supplier->name ?? 'Unknown' }}</div>
                        <div class="product-meta"><i class="bi bi-box me-1"></i>Stock: {{ $product->stock }}</div>
                        <div class="product-meta"><i class="bi bi-layers me-1"></i>MOQ: {{ $product->moq }} units</div>

                        @auth
                            <a href="/cart/add/{{ $product->id }}" class="btn-product btn-product-primary mt-3">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-product btn-product-primary mt-3">
                                <i class="bi bi-cart-plus me-1"></i> Add to Cart
                            </a>
                        @endauth
                        <a href="/products/{{ $product->id }}" class="btn-product btn-product-outline">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" style="color:#64748b;">
                No products available yet.
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- ── HOW IT WORKS ── --}}
<div class="how-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label">Process</div>
            <div class="section-title">How It Works</div>
        </div>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-num">1</div>
                    <div class="step-title">Register</div>
                    <div class="step-desc">Create an account as a Buyer or Supplier in under a minute.</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-num">2</div>
                    <div class="step-title">Browse & List</div>
                    <div class="step-desc">Buyers browse products. Suppliers list inventory with pricing and MOQ.</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-num">3</div>
                    <div class="step-title">Order</div>
                    <div class="step-desc">Add to cart, checkout, and receive a professional invoice instantly.</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-num">4</div>
                    <div class="step-title">Automate</div>
                    <div class="step-desc">Let the platform handle confirmations, campaigns, and follow-ups automatically.</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── CTA ── --}}
<div class="cta-section">
    <div class="hero-badge" style="margin-bottom:20px;">
        <i class="bi bi-rocket-takeoff"></i> Get Started Today
    </div>
    <h2>Ready to Grow Your Business?</h2>
    <p>Join as a buyer to source wholesale products, or as a supplier to reach more customers.</p>
    <div class="hero-actions">
        <a href="/register" class="btn-hero-primary">Create Free Account</a>
        <a href="/products" class="btn-hero-ghost">Browse Products</a>
    </div>
</div>

{{-- ── FOOTER ── --}}
<div class="site-footer">
    <div class="footer-brand">⚡ B2B Platform — Business Automation Suite</div>
    <div class="footer-links">
        <a href="/products">Marketplace</a>
        <a href="#features">Features</a>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
