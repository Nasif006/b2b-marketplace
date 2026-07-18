<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Products — Supplier Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --amber:#d97706;--amber-soft:rgba(217,119,6,0.1); }
        body { background:#fafaf8;font-family:'Segoe UI',sans-serif; }
        .top-bar { background:linear-gradient(135deg,#1c1008,#2d1a0e);padding:0 28px;height:56px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(217,119,6,0.2); }
        .top-bar-brand { color:white;font-weight:700;font-size:16px;text-decoration:none;display:flex;align-items:center;gap:8px; }
        .top-bar-brand span { background:linear-gradient(135deg,var(--amber),#f59e0b);width:26px;height:26px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:13px; }
        .tb-btn { padding:5px 14px;border-radius:7px;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s; }
        .tb-ghost { background:rgba(255,255,255,0.07);color:#d4b483;border:1px solid rgba(255,255,255,0.1); }
        .tb-ghost:hover { background:rgba(255,255,255,0.12);color:white; }
        .page-wrap { max-width:1000px;margin:36px auto;padding:0 20px; }
        .page-header { display:flex;justify-content:space-between;align-items:center;margin-bottom:24px; }
        .page-title { font-size:22px;font-weight:700;color:#1c1008; }
        .btn-add { display:inline-flex;align-items:center;gap:6px;padding:8px 18px;background:linear-gradient(135deg,var(--amber),#b45309);color:white;border-radius:9px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.15s; }
        .btn-add:hover { opacity:0.9;color:white;transform:translateY(-1px); }
        .product-table { background:white;border:1px solid #e7e5e4;border-radius:14px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.04); }
        .product-table table { width:100%;border-collapse:collapse; }
        .product-table th { font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:#78716c;padding:12px 16px;background:#fafaf8;border-bottom:1px solid #e7e5e4;text-align:left; }
        .product-table td { padding:14px 16px;border-bottom:1px solid #f5f5f4;font-size:14px;color:#44403c;vertical-align:middle; }
        .product-table tr:last-child td { border-bottom:none; }
        .product-table tr:hover td { background:#fffbf5; }
        .product-thumb { width:44px;height:44px;border-radius:8px;object-fit:cover;border:1px solid #e7e5e4; }
        .product-thumb-placeholder { width:44px;height:44px;border-radius:8px;background:#f5f5f4;display:flex;align-items:center;justify-content:center;color:#a8a29e;border:1px solid #e7e5e4; }
        .stock-low { background:#fef2f2;color:#dc2626;border:1px solid #fecaca;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600; }
        .stock-ok { color:#44403c; }
        .btn-edit { padding:4px 12px;background:#fffbeb;color:#b45309;border:1px solid #fde68a;border-radius:6px;font-size:12px;font-weight:500;text-decoration:none;transition:all 0.15s; }
        .btn-edit:hover { background:#fef3c7;color:#92400e; }
        .btn-delete { padding:4px 12px;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;transition:all 0.15s; }
        .btn-delete:hover { background:#fee2e2; }
        .alert-success { background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:10px 16px;margin-bottom:16px;color:#15803d;font-size:13px; }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="top-bar-brand" href="/supplier/dashboard">
        <span>📦</span> Supplier Panel
    </a>
    <div class="d-flex gap-2">
        <a href="/supplier/dashboard" class="tb-btn tb-ghost">Dashboard</a>
        <a href="/supplier/products" class="tb-btn tb-ghost">Products</a>
        <a href="/supplier/orders" class="tb-btn tb-ghost">Orders</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button class="tb-btn" style="background:rgba(217,119,6,0.15);color:#d97706;border:1px solid rgba(217,119,6,0.3);cursor:pointer;font-family:inherit;">Logout</button>
        </form>
    </div>
</div>

<div class="page-wrap">

    @if(session('success'))
    <div class="alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div class="page-title">My Products <span style="font-size:14px;color:#a8a29e;font-weight:400;">({{ count($products) }})</span></div>
        <a href="/supplier/products/create" class="btn-add">
            <i class="bi bi-plus"></i> Add Product
        </a>
    </div>

    <div class="product-table">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>MOQ</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ $product->image }}" class="product-thumb"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div class="product-thumb-placeholder" style="display:none;">
                                <i class="bi bi-image"></i>
                            </div>
                        @else
                            <div class="product-thumb-placeholder">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;color:#1c1917;">{{ $product->name }}</div>
                        @if($product->description)
                        <div style="font-size:12px;color:#a8a29e;margin-top:2px;">{{ Str::limit($product->description, 50) }}</div>
                        @endif
                    </td>
                    <td style="font-weight:600;color:#1c1917;">৳ {{ number_format($product->price, 0) }}</td>
                    <td>
                        @if($product->stock <= 50)
                            <span class="stock-low">{{ $product->stock }} ⚠</span>
                        @else
                            <span class="stock-ok">{{ $product->stock }}</span>
                        @endif
                    </td>
                    <td style="color:#78716c;">{{ $product->moq }}</td>
                    <td style="display:flex;gap:6px;">
                        <a href="/supplier/products/{{ $product->id }}/edit" class="btn-edit">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="/supplier/products/{{ $product->id }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Delete {{ $product->name }}?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:#a8a29e;">
                        No products yet.
                        <a href="/supplier/products/create" style="color:var(--amber);">Add your first product</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
