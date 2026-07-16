{{-- =========================================================
    SHARED NAVBAR (SINGLE SOURCE OF TRUTH)
    - Used by: welcome, index, show pages
    - Bootstrap-based (no Breeze dependency)
    - Handles guest/auth + roles
========================================================= --}}

<nav class="navbar navbar-dark bg-dark px-3">

    <a class="navbar-brand" href="/">B2B Marketplace</a>

    <div class="d-flex gap-2 align-items-center">

        <a href="/products" class="btn btn-outline-light btn-sm">Browse</a>

        @auth

            <a href="/cart" class="btn btn-outline-light btn-sm">
                Cart ({{ count(session('cart', [])) }})
            </a>

            @php $role = auth()->user()->role?->name; @endphp

            @if($role === 'buyer')
                <a href="/dashboard" class="btn btn-outline-light btn-sm">Dashboard</a>
                <a href="/orders" class="btn btn-outline-light btn-sm">My Orders</a>
                <a href="/tickets" class="btn btn-outline-light btn-sm">Support</a>
            @endif

            @if($role === 'supplier')
                <a href="/supplier/dashboard" class="btn btn-outline-light btn-sm">Supplier</a>
            @endif

            @if($role === 'admin')
                <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">Admin</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-warning btn-sm">Logout</button>
            </form>

        @else
            <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
            <a href="/register" class="btn btn-warning btn-sm">Register</a>
        @endauth

    </div>

</nav>
