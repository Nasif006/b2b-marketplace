<nav class="navbar navbar-dark bg-dark px-3">

    <a class="navbar-brand" href="/supplier/dashboard">
        Supplier Panel
    </a>

    <div class="d-flex gap-2">

        <a href="/supplier/dashboard" class="btn btn-outline-light btn-sm">
            Dashboard
        </a>

        <a href="/supplier/products" class="btn btn-outline-light btn-sm">
            Products
        </a>

        <a href="/supplier/orders" class="btn btn-outline-light btn-sm">
            Orders
        </a>

       <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>

    </div>

</nav>
