<!DOCTYPE html>
<html>
<head>
    <title>Buyer Dashboard - B2B Marketplace</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .hero {
            background: linear-gradient(135deg, #198754, #145c3a);
            color: white;
            padding: 40px 20px;
            border-radius: 0 0 18px 18px;
        }

        .card-hover {
            transition: 0.2s ease-in-out;
        }

        .card-hover:hover {
            transform: translateY(-3px);
        }

        .stat-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

<!-- NAVBAR (same system as product page) -->
@include('partials.navbar')

<!-- HERO -->
<div class="hero text-center">
    <h2>Welcome Back, {{ auth()->user()->name }}</h2>
    <p class="mb-0">Manage your orders, browse products, and track activity</p>
</div>

<div class="container mt-4">

    <!-- QUICK STATS -->
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="stat-box text-center">
                <h5>Total Orders</h5>
                <h3 class="text-success">--</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-box text-center">
                <h5>Pending Orders</h5>
                <h3 class="text-warning">--</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-box text-center">
                <h5>Completed</h5>
                <h3 class="text-primary">--</h3>
            </div>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <h4 class="mb-3">Quick Actions</h4>

    <div class="row">

        <div class="col-md-4 mb-3">
            <a href="/products" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <h5>Browse Products</h5>
                    <p class="text-muted mb-0">Explore marketplace listings</p>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/cart" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <h5>My Cart</h5>
                    <p class="text-muted mb-0">Review selected items</p>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/orders" class="text-decoration-none">
                <div class="card shadow-sm card-hover p-4 text-center">
                    <h5>My Orders</h5>
                    <p class="text-muted mb-0">Track order status</p>
                </div>
            </a>
        </div>

    </div>

    <!-- FEATURE SECTION -->
    <h4 class="mt-4">Recommended Products</h4>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Rice (25kg)</h5>
                    <p class="text-success fw-bold">৳ 1,800</p>
                    <a href="/products" class="btn btn-primary w-100">
                        View Product
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Cooking Oil (5L)</h5>
                    <p class="text-success fw-bold">৳ 950</p>
                    <a href="/products" class="btn btn-primary w-100">
                        View Product
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Sugar (50kg)</h5>
                    <p class="text-success fw-bold">৳ 3,200</p>
                    <a href="/products" class="btn btn-primary w-100">
                        View Product
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Dashboard - B2B Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .hero {
            background: #198754;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .product-card {
            transition: 0.2s;
        }

        .product-card:hover {
            transform: scale(1.02);
        }

        .price {
            font-weight: bold;
            color: #198754;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">Buyer Panel</a>

        <div class="ms-auto d-flex align-items-center gap-2">
            <span class="text-white">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <h2>Welcome Back, {{ auth()->user()->name }}</h2>
    <p>Browse products and place bulk orders from suppliers</p>
</div>

<!-- PRODUCTS -->
<div class="container mt-5">
    <h4 class="mb-4">Available Products</h4>

    <div class="row">

        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">
                <div class="card-body">
                    <h5>Rice (25kg bag)</h5>
                    <p class="price">৳ 1,800</p>
                    <p class="text-muted">MOQ: 5 bags</p>

                    <a href="/login" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">
                <div class="card-body">
                    <h5>Cooking Oil (5L)</h5>
                    <p class="price">৳ 950</p>
                    <p class="text-muted">MOQ: 10 units</p>

                    <a href="/login" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">
                <div class="card-body">
                    <h5>Sugar (50kg sack)</h5>
                    <p class="price">৳ 3,200</p>
                    <p class="text-muted">MOQ: 2 sacks</p>

                    <a href="/login" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html> --}}
