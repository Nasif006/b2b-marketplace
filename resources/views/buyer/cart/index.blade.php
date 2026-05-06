<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    @include('partials.navbar')

    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Your Cart</h3>

            <a href="/products" class="btn btn-primary btn-sm">
                Continue Shopping
            </a>
        </div>

        @if(empty($cart))

            <div class="alert alert-info">
                Your cart is empty.
            </div>

        @else

            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php $grandTotal = 0; @endphp

                            @foreach($cart as $id => $item)

                                @php
                                    $total = $item['price'] * $item['qty'];
                                    $grandTotal += $total;
                                @endphp

                                <tr>

                                    <td>{{ $item['name'] }}</td>

                                    <td>৳{{ $item['price'] }}</td>

                                    <td>

                                        <!-- QTY CONTROLS -->
                                        <div class="d-flex align-items-center gap-2">

                                            <a href="/cart/decrease/{{ $id }}"
                                            class="btn btn-sm btn-outline-secondary">
                                                -
                                            </a>

                                            <span>{{ $item['qty'] }}</span>

                                            <a href="/cart/add/{{ $id }}"
                                            class="btn btn-sm btn-outline-secondary">
                                                +
                                            </a>

                                        </div>

                                    </td>

                                    <td>৳{{ $total }}</td>

                                    <td>
                                        <a href="/cart/remove/{{ $id }}"
                                        class="btn btn-danger btn-sm">
                                            Remove
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <div class="d-flex justify-content-between mt-3">

                        <h5>Grand Total: ৳{{ $grandTotal }}</h5>

                        <a href="/checkout" class="btn btn-success">
                            Checkout
                        </a>

                    </div>

                </div>
            </div>

        @endif

    </div>

</body>
</html>
