<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

@include('partials.navbar')

<div class="container mt-4">

    <h3>My Orders</h3>

    @forelse($orders as $order)

        <div class="card shadow-sm mb-3">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h5>Order #{{ $order->id }}</h5>

                    <span class="badge bg-info">
                        {{ $order->status }}
                    </span>
                </div>

                <p class="mb-1">Total: ৳{{ $order->total }}</p>

                <a href="/orders/{{ $order->id }}" class="btn btn-primary btn-sm mt-2">
                    View Details
                </a>

                <a href="/orders/{{ $order->id }}/invoice" class="btn btn-outline-secondary btn-sm mt-2">
                    Invoice
                </a>

            </div>
        </div>

    @empty

        <div class="alert alert-info">
            No orders found.
        </div>

    @endforelse

</div>

</body>
</html>
