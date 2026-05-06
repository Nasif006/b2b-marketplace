<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="alert alert-success">
        Order placed successfully!
    </div>

    <div class="d-flex justify-content-between">
        <h3>Invoice</h3>
        <span>Order #{{ $order->id }}</span>
    </div>

    <hr>

    <p><strong>Date:</strong> {{ $order->created_at }}</p>
    <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
    <p><strong>Status:</strong> {{ $order->payment_status }}</p>

    @if($order->transaction_id)
        <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
    @endif

    <table class="table mt-4">
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

    <h5 class="text-end">Grand Total: ৳{{ $order->total }}</h5>

    <div class="text-end mt-3">
        <button onclick="window.print()" class="btn btn-outline-secondary">
            Print Invoice
        </button>

        <a href="/products" class="btn btn-primary mt-2">
            Back to Marketplace
        </a>
    </div>

</div>

</body>
</html>
