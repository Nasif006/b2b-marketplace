<!DOCTYPE html>
<html>
<head>
    <title>B2B Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- NAV -->
@include('partials.navbar')

<div class="container mt-4">

    <h2>Marketplace Products</h2>

    <div class="row mt-3">

        @foreach($products as $product)
            <div class="col-md-4 mb-3">

                <div class="card shadow-sm">

                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>

                        <p>Price: ৳{{ $product->price }}</p>
                        <p>Stock: {{ $product->stock }}</p>
                        <div class="text-muted small">
                            MOQ: {{ $product->moq }} units
                        </div>

                        @if($product->stock <= 50)
                            <span class="badge bg-danger">Limited Stock</span>
                        @endif

                        <form method="POST" action="/cart/add">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <input type="number" name="qty"
                                   class="form-control mt-2"
                                   min="{{ $product->moq }}"
                                   value="{{ $product->moq }}">

                            @auth
                                <div class="d-flex gap-2 mt-2">

                                    <a href="/cart/decrease/{{ $product->id }}"
                                    class="btn btn-outline-secondary btn-sm">-</a>

                                    <a href="/cart/add/{{ $product->id }}"
                                    class="btn btn-outline-secondary btn-sm">+</a>

                                </div>

                                <a href="/cart/add/{{ $product->id }}" class="btn btn-primary w-100 mt-2">
                                    Add to Cart
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-2">
                                    Add to Cart
                                </a>
                            @endauth
                        </form>

                        <a href="/products/{{ $product->id }}" class="btn btn-primary w-100 mt-3">
                            View Details
                        </a>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>

</body>
</html>
