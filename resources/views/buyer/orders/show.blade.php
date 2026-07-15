<!DOCTYPE html>
<html>
<head>
    <title>Order #{{ $order->id }} - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>body { background:#f5f6f8; }</style>
</head>
<body>

@include('partials.navbar')

<div class="container mt-4" style="max-width:720px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h4>
            <div class="text-muted small">{{ $order->created_at->format('d M Y, H:i') }}</div>
        </div>
        <div class="d-flex gap-2 align-items-center">
            @php
                $badge = match($order->status) {
                    'confirmed' => 'success',
                    'rejected'  => 'danger',
                    default     => 'warning',
                };
            @endphp
            <span class="badge bg-{{ $badge }}">{{ ucfirst($order->status) }}</span>
            <a href="/orders/{{ $order->id }}/invoice" class="btn btn-dark btn-sm">
                <i class="bi bi-receipt me-1"></i> Invoice
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>৳ {{ number_format($item->price, 2) }}</td>
                        <td class="text-end fw-semibold">৳ {{ number_format($item->price * $item->qty, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Grand Total</td>
                        <td class="text-end fw-bold text-success">৳ {{ number_format($order->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex gap-4 flex-wrap">
            <div>
                <div class="text-muted small">Payment Method</div>
                <div class="fw-semibold">{{ strtoupper($order->payment_method) }}</div>
            </div>
            <div>
                <div class="text-muted small">Payment Status</div>
                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
            @if($order->transaction_id)
            <div>
                <div class="text-muted small">Transaction ID</div>
                <div class="fw-semibold" style="font-family:monospace;">{{ $order->transaction_id }}</div>
            </div>
            @endif
        </div>
    </div>

    <a href="/orders" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back to Orders
    </a>

</div>
</body>
</html>
