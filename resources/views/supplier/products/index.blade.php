<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href="/supplier/dashboard" class="btn btn-secondary">
            ← Back to Dashboard
        </a>

        <h2>My Products</h2>

        <a href="/supplier/products/create" class="btn btn-success">
            + Add Product
        </a>

    </div>

    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Products</h2>

        <a href="/supplier/products/create" class="btn btn-success">
            + Add Product
        </a>
    </div> --}}

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>MOQ</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>৳ {{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->moq }}</td>

                    <td>
                        <a href="/supplier/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="/supplier/products/{{ $product->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this product?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
