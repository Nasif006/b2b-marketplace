<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

@include('partials.navbar')

<div class="container mt-4">

    <h3>Checkout</h3>

    <div class="row mt-3">

        <!-- CART SUMMARY -->
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php $grandTotal = 0; @endphp

                            @foreach($cart as $item)

                                @php
                                    $total = $item['price'] * $item['qty'];
                                    $grandTotal += $total;
                                @endphp

                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>৳{{ $total }}</td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <h5 class="mt-3">
                        Grand Total: ৳{{ $grandTotal }}
                    </h5>

                </div>
            </div>

        </div>

        <!-- PLACE ORDER -->
        <div class="col-md-4">

            <div class="card shadow-sm p-3">

                <h5>Order Summary</h5>

                <p class="text-muted">
                    Review your order before placing it.
                </p>

                <form method="POST" action="/checkout">
                    @csrf

                    <!-- PAYMENT METHOD (STEP 3 ADDED HERE) -->
                    <h6 class="mt-3">Payment Method</h6>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                        <label class="form-check-label">
                            Cash on Delivery
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="fake">
                        <label class="form-check-label">
                            Online Payment (Demo)
                        </label>
                    </div>

                    <!-- EXISTING BUTTON -->
                    <button class="btn btn-success w-100 mt-3">
                        Place Order
                    </button>
                </form>

                <a href="/cart" class="btn btn-outline-secondary w-100 mt-2">
                    Back to Cart
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>
