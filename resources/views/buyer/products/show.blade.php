<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .card {
            border: none;
        }

        .price {
            font-size: 1.5rem;
            font-weight: 600;
            color: #198754;
        }

        .supplier {
            color: #6c757d;
        }
    </style>
</head>

<body>

<!-- NAV -->
@include('partials.navbar')

<div class="container mt-5">

    <div class="row">

        <!-- PRODUCT INFO -->
        <div class="col-md-8">

            <div class="card shadow-sm p-4">

                <h2>{{ $product->name }}</h2>

                <div class="price mt-2">
                    ৳ {{ $product->price }}
                </div>

                <p class="supplier mt-2">
                    Supplier: {{ $product->supplier->name ?? 'Unknown' }}
                </p>

                <hr>

                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <div class="text-muted small">
                    MOQ: {{ $product->moq }} units
                </div>

                @if($product->stock <= 50)
                    <span class="badge bg-danger">Limited Stock</span>
                @endif

            </div>

        </div>

        <!-- ACTION PANEL -->
        <div class="col-md-4">

            <div class="card shadow-sm p-4">

                <h5>Purchase</h5>

                <p class="text-muted">
                    Add this product to your cart and proceed to checkout.
                </p>

                @auth
                    <a href="/cart/add/{{ $product->id }}" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                @endauth

                <small class="text-muted d-block mt-2">
                    Login required at checkout
                </small>

            </div>

        </div>

    </div>

</div>

</body>
</html>
