<!DOCTYPE html>
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
</html>
