<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

{{-- NAVBAR (your unified system) --}}
@include('partials.navbar')

<div class="container mt-4">

    <div class="card shadow-sm p-3">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3 class="mb-0">Order #{{ $order->id }}</h3>

            <span class="badge bg-primary">
                {{ $order->status }}
            </span>

        </div>

        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->items as $item)

                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>৳{{ $item->price }}</td>
                        <td>৳{{ $item->price * $item->qty }}</td>
                    </tr>

                @endforeach
            </tbody>

        </table>

    </div>

</div>

</body>
</html>
