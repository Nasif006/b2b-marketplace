<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Product</h2>

    <form method="POST" action="/supplier/products/{{ $product->id }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>MOQ</label>
            <input type="number" name="moq" value="{{ $product->moq }}" class="form-control">
        </div>

        <button class="btn btn-primary">Update Product</button>
    </form>
</div>

</body>
</html>
