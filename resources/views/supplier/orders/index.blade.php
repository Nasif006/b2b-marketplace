<!DOCTYPE html>
<html>
<head>
    <title>Supplier Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

@include('partials.supplier-navbar')

<div class="container mt-4">

    <h3>Incoming Orders</h3>

    @forelse($orders as $order)

        <div class="card shadow-sm mb-3">
            <div class="card-body">

                <h5>Order #{{ $order->id }}</h5>

                <p class="text-muted mb-2">
                    Buyer: {{ $order->user->name ?? 'Unknown' }}
                </p>

                <p>Status: {{ $order->status }}</p>
                <p>Total: ৳{{ $order->total }}</p>

                <hr>

                <h6>Items</h6>

                <ul class="list-group">

                    @foreach($order->items as $item)

                        @if($item->product->user_id == auth()->id())

                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $item->product->name }}</span>
                                <span>Qty: {{ $item->qty }}</span>
                            </li>

                        @endif

                    @endforeach

                </ul>

                <div class="mt-3 d-flex gap-2">

                    @if($order->status == 'pending')

                        <!-- ACCEPT -->
                        <a href="/supplier/orders/{{ $order->id }}/accept"
                        class="btn btn-success btn-sm">
                            Accept
                        </a>

                        <!-- REJECT -->
                        <a href="/supplier/orders/{{ $order->id }}/reject"
                        class="btn btn-danger btn-sm">
                            Reject
                        </a>

                    @elseif($order->status == 'accepted')

                        <span class="badge bg-warning text-dark">
                            Accepted
                        </span>

                    @elseif($order->status == 'shipped')

                        <span class="badge bg-info">
                            Shipped
                        </span>

                    @elseif($order->status == 'delivered')

                        <span class="badge bg-success">
                            Delivered
                        </span>

                    @endif

                </div>

            </div>
        </div>

    @empty

        <div class="alert alert-info">
            No orders yet.
        </div>

    @endforelse

</div>

</body>
</html>
