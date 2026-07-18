<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product — Supplier Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --amber:#d97706;--amber-soft:rgba(217,119,6,0.1);--amber-border:rgba(217,119,6,0.25); }
        body { background:#fafaf8;font-family:'Segoe UI',sans-serif; }
        .top-bar { background:linear-gradient(135deg,#1c1008,#2d1a0e);padding:0 28px;height:56px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid rgba(217,119,6,0.2); }
        .top-bar-brand { color:white;font-weight:700;font-size:16px;text-decoration:none;display:flex;align-items:center;gap:8px; }
        .top-bar-brand span { background:linear-gradient(135deg,var(--amber),#f59e0b);width:26px;height:26px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:13px; }
        .tb-btn { padding:5px 14px;border-radius:7px;font-size:13px;font-weight:500;text-decoration:none;transition:all 0.15s; }
        .tb-ghost { background:rgba(255,255,255,0.07);color:#d4b483;border:1px solid rgba(255,255,255,0.1); }
        .tb-ghost:hover { background:rgba(255,255,255,0.12);color:white; }
        .page-wrap { max-width:680px;margin:40px auto;padding:0 16px; }
        .page-title { font-size:22px;font-weight:700;color:#1c1008;letter-spacing:-0.3px;margin-bottom:4px; }
        .page-sub { font-size:13px;color:#78716c;margin-bottom:28px; }
        .form-card { background:white;border:1px solid #e7e5e4;border-radius:14px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,0.04); }
        .field-label { font-size:12px;font-weight:600;color:#57534e;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;display:block; }
        .field-input { width:100%;background:#fafaf8;border:1px solid #e7e5e4;color:#1c1917;border-radius:8px;padding:9px 12px;font-size:14px;transition:border-color 0.15s;font-family:inherit; }
        .field-input:focus { outline:none;border-color:var(--amber);box-shadow:0 0 0 3px var(--amber-soft); }
        .field-hint { font-size:11px;color:#a8a29e;margin-top:4px; }
        .image-preview-box { width:100%;height:160px;background:#f5f5f4;border:2px dashed #e7e5e4;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-top:10px;overflow:hidden; }
        .image-preview-box img { width:100%;height:100%;object-fit:cover;border-radius:8px; }
        .btn-submit { width:100%;padding:11px;background:linear-gradient(135deg,var(--amber),#b45309);color:white;border:none;border-radius:9px;font-size:15px;font-weight:600;cursor:pointer;transition:all 0.2s;font-family:inherit; }
        .btn-submit:hover { opacity:0.92;transform:translateY(-1px); }
        .alert-error { background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:20px;color:#dc2626;font-size:13px; }
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

    <div class="page-title">Edit Product</div>
    <div class="page-sub">Update the details for <strong>{{ $product->name }}</strong></div>

    @if($errors->any())
    <div class="alert-error">
        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
    </div>
    @endif

    <div class="form-card">
        <form method="POST" action="/supplier/products/{{ $product->id }}">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12">
                    <label class="field-label">Product Name *</label>
                    <input type="text" name="name" class="field-input"
                        value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="col-12">
                    <label class="field-label">Description</label>
                    <textarea name="description" class="field-input" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Price (৳) *</label>
                    <input type="number" name="price" class="field-input"
                        value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="field-label">Stock Quantity *</label>
                    <input type="number" name="stock" class="field-input"
                        value="{{ old('stock', $product->stock) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="field-label">MOQ *</label>
                    <input type="number" name="moq" class="field-input"
                        value="{{ old('moq', $product->moq) }}" required>
                    <div class="field-hint">Minimum order quantity</div>
                </div>

                <div class="col-12">
                    <label class="field-label">Product Image URL</label>
                    <input type="url" name="image" id="imageUrl" class="field-input"
                        placeholder="https://example.com/image.jpg"
                        value="{{ old('image', $product->image) }}"
                        oninput="previewImage(this.value)">
                    <div class="field-hint">Paste any image URL. Leave blank to use a placeholder.</div>
                    <div class="image-preview-box" id="previewBox">
                        @if($product->image)
                            <img src="{{ $product->image }}" onerror="this.src='https://placehold.co/600x400/e2e8f0/94a3b8?text=No+Image'">
                        @else
                            <div style="color:#a8a29e;font-size:13px;text-align:center;">
                                <i class="bi bi-image" style="font-size:28px;display:block;margin-bottom:6px;"></i>
                                No image set
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check2 me-2"></i>Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(url) {
    const box = document.getElementById('previewBox');
    if (url && url.startsWith('http')) {
        box.innerHTML = '<img src="' + url + '" onerror="this.parentNode.innerHTML=\'<div style=color:#a8a29e;text-align:center;>Invalid URL</div>\'">';
    } else {
        box.innerHTML = '<div style="color:#a8a29e;font-size:13px;text-align:center;"><i class=\'bi bi-image\' style=\'font-size:28px;display:block;margin-bottom:6px;\'></i>No image set</div>';
    }
}
</script>
</body>
</html>
