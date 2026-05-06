<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create Product</h2>

        <a href="/supplier/products" class="btn btn-secondary">
            ← Back to Products
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="/supplier/products">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input name="name" class="form-control" placeholder="e.g. Rice 25kg bag">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (৳)</label>
                    <input name="price" type="number" class="form-control" placeholder="e.g. 1800">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input name="stock" type="number" class="form-control" placeholder="e.g. 100">
                </div>

                <div class="mb-3">
                    <label class="form-label">Minimum Order Quantity (MOQ)</label>
                    <input name="moq" type="number" class="form-control" placeholder="e.g. 10">
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Create Product
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>
