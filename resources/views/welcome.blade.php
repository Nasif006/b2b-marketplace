<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>B2B Marketplace</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6f8; }

        .hero {
            background: #0d6efd;
            color: white;
            padding: 70px 20px;
            text-align: center;
        }

        .product-card {
            transition: 0.2s ease-in-out;
            border: none;
        }

        .product-card:hover {
            transform: translateY(-3px);
        }

        .price {
            font-weight: 600;
            color: #198754;
        }

        /* NOTE: navbar removed here intentionally (handled globally later) */
    </style>
</head>

<body>

<!-- NAVBAR (TEMPORARY - KEEP UNTIL FULL MIGRATION TO BLADE LAYOUT) -->
@include('partials.navbar')

<!-- HERO -->
<div class="hero">
    <h1>Wholesale B2B Marketplace</h1>
    <p>Buy in bulk directly from verified suppliers</p>
</div>

<!-- PRODUCTS -->
<div class="container mt-5">

    <h3 class="mb-4">Featured Products</h3>

    <div class="row">

        @forelse($products as $product)
            <div class="col-md-4 mb-4">

                <div class="card product-card shadow-sm">

                    <div class="card-body">

                        <h5>{{ $product->name }}</h5>

                        <div class="price mb-2">
                            ৳ {{ $product->price }}
                        </div>

                        <p class="text-muted">
                            Supplier: {{ $product->supplier->name ?? 'Unknown' }}
                        </p>

                        <p>Stock: {{ $product->stock }}</p>
                        <div class="text-muted small">
                            MOQ: {{ $product->moq }} units
                        </div>

                        @if($product->stock <= 50)
                            <span class="badge bg-danger">Low Stock</span>
                        @endif

                        @auth
                            <a href="/cart/add/{{ $product->id }}" class="btn btn-outline-primary w-100 mt-2">
                                Add to Cart
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 mt-2">
                                Add to Cart
                            </a>
                        @endauth

                        <a href="/products/{{ $product->id }}" class="btn btn-primary w-100 mt-3">
                            View Details
                        </a>

                    </div>

                </div>

            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    No products available.
                </div>
            </div>
        @endforelse

    </div>

</div>

</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>B2B Marketplace</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .hero {
            background: #0d6efd;
            color: white;
            padding: 70px 20px;
            text-align: center;
        }

        .product-card {
            transition: 0.2s ease-in-out;
            border: none;
        }

        .product-card:hover {
            transform: translateY(-3px);
        }

        .price {
            font-weight: 600;
            color: #198754;
            font-size: 1.1rem;
        }

        .supplier {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="/">B2B Platform</a>

        <div>
            <a href="/products" class="btn btn-outline-light btn-sm">Browse</a>
            <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
            <a href="/register" class="btn btn-warning btn-sm">Register</a>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <h1>Wholesale B2B Marketplace</h1>
        <p>Buy in bulk directly from verified suppliers</p>
    </div>

    <!-- PRODUCTS -->
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Featured Products</h3>
            <a href="/products" class="btn btn-primary btn-sm">View All</a>
        </div>

        <div class="row">

            @forelse($products as $product)
                <div class="col-md-4 mb-4">

                    <div class="card product-card shadow-sm">

                        <div class="card-body">

                            <h5 class="card-title">{{ $product->name }}</h5>

                            <div class="price mb-2">
                                ৳ {{ $product->price }}
                            </div>

                            <div class="mb-2">
                                <span class="supplier">
                                    Supplier: {{ $product->supplier->name ?? 'Unknown' }}
                                </span>
                            </div>

                            <p class="text-muted mb-1">
                                Stock: {{ $product->stock }}
                            </p>

                            <p class="text-muted mb-2">
                                MOQ: {{ $product->moq }}
                            </p>

                            @if($product->stock <= 50)
                                <span class="badge bg-danger mb-2">Low Stock</span>
                            @endif

                            <a href="/products/{{ $product->id }}" class="btn btn-primary w-100 mt-3">
                                View Details
                            </a>

                        </div>

                    </div>

                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">
                        No products available yet.
                    </div>
                </div>
            @endforelse

        </div>

    </div>

</body>
</html> --}}
