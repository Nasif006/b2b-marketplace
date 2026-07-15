<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }} - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f5f6f8; }
        .invoice-wrap { max-width:780px;margin:40px auto;background:white;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden; }
        .invoice-header { background:linear-gradient(135deg,#0f1117,#1a1e2e);color:white;padding:32px 40px;display:flex;justify-content:space-between;align-items:flex-start; }
        .brand-name { font-size:20px;font-weight:700; }
        .brand-tag { font-size:11px;color:#6b7280;margin-top:2px; }
        .inv-title { font-size:28px;font-weight:700;color:#4f8ef7;text-align:right; }
        .inv-num { font-size:13px;color:#9ca3af;text-align:right;margin-top:2px; }
        .invoice-body { padding:32px 40px; }
        .meta-grid { display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid #f1f3f5; }
        .meta-label { font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:#9ca3af;margin-bottom:4px; }
        .meta-value { font-size:14px;font-weight:500;color:#111827; }
        .inv-table { width:100%;border-collapse:collapse;margin-bottom:24px; }
        .inv-table th { font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:#9ca3af;padding:10px 14px;background:#f9fafb;border-bottom:1px solid #e5e7eb;text-align:left; }
        .inv-table td { padding:14px;border-bottom:1px solid #f1f3f5;font-size:14px;color:#374151; }
        .inv-table tr:last-child td { border-bottom:none; }
        .totals-box { width:260px;margin-left:auto;margin-bottom:32px; }
        .totals-row { display:flex;justify-content:space-between;padding:8px 0;font-size:14px;color:#6b7280;border-bottom:1px solid #f1f3f5; }
        .totals-row.grand { font-size:16px;font-weight:700;color:#111827;border-bottom:none;padding-top:12px; }
        .invoice-footer { background:#f9fafb;padding:20px 40px;display:flex;justify-content:space-between;align-items:center;border-top:1px solid #e5e7eb; }
        .status-paid { background:#d1fae5;color:#065f46;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500; }
        .status-pending { background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500; }
        @media print {
            body { background:white; }
            .invoice-wrap { box-shadow:none;margin:0;border-radius:0; }
            .no-print { display:none !important; }
        }
    </style>
</head>
<body>

<div class="no-print">@include('partials.navbar')</div>

<div class="invoice-wrap">

    <div class="invoice-header">
        <div>
            <div class="brand-name">B2B Platform</div>
            <div class="brand-tag">business-to-business marketplace</div>
        </div>
        <div>
            <div class="inv-title">INVOICE</div>
            <div class="inv-num">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>
    </div>

    <div class="invoice-body">

        @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 no-print">
            <i class="bi bi-check-circle-fill"></i> Order placed successfully!
        </div>
        @endif

        <div class="meta-grid">
            <div>
                <div class="meta-label">Billed To</div>
                <div class="meta-value">{{ auth()->user()->name }}</div>
                <div style="font-size:13px;color:#6b7280;">{{ auth()->user()->email }}</div>
            </div>
            <div>
                <div class="meta-label">Invoice Date</div>
                <div class="meta-value">{{ $order->created_at->format('d M Y') }}</div>
                <div style="font-size:13px;color:#6b7280;">{{ $order->created_at->format('H:i') }}</div>
            </div>
            <div>
                <div class="meta-label">Payment</div>
                <div class="meta-value">{{ strtoupper($order->payment_method) }}</div>
                <span class="{{ $order->payment_status === 'paid' ? 'status-paid' : 'status-pending' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        @if($order->transaction_id)
        <div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:8px;padding:10px 16px;margin-bottom:24px;font-size:13px;color:#0369a1;">
            <i class="bi bi-shield-check me-2"></i>
            Transaction ID: <strong>{{ $order->transaction_id }}</strong>
        </div>
        @endif

        <table class="inv-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $i => $item)
                <tr>
                    <td style="color:#9ca3af;">{{ $i + 1 }}</td>
                    <td style="font-weight:500;color:#111827;">{{ $item->product->name }}</td>
                    <td>৳ {{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td style="text-align:right;font-weight:600;">৳ {{ number_format($item->price * $item->qty, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals-box">
            <div class="totals-row"><span>Subtotal</span><span>৳ {{ number_format($order->total, 2) }}</span></div>
            <div class="totals-row"><span>Tax (0%)</span><span>৳ 0.00</span></div>
            <div class="totals-row grand"><span>Grand Total</span><span style="color:#4f8ef7;">৳ {{ number_format($order->total, 2) }}</span></div>
        </div>

    </div>

    <div class="invoice-footer">
        <div style="font-size:13px;color:#6b7280;">
            <i class="bi bi-heart-fill" style="color:#f87171;"></i> Thank you for your business!
        </div>
        <div class="d-flex gap-2 no-print">
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-printer me-1"></i> Print
            </button>
            <a href="/orders" class="btn btn-dark btn-sm">
                <i class="bi bi-bag me-1"></i> My Orders
            </a>
        </div>
    </div>

</div>
</body>
</html>
