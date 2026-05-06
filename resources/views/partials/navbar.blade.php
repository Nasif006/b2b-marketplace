{{-- =========================================================
    SHARED NAVBAR (SINGLE SOURCE OF TRUTH)
    - Used by: welcome, index, show pages
    - Bootstrap-based (no Breeze dependency)
    - Handles guest/auth + roles
========================================================= --}}

<nav class="navbar navbar-dark bg-dark px-3">

    <!-- BRAND -->
    <a class="navbar-brand" href="/">B2B Marketplace</a>

    <div class="d-flex gap-2 align-items-center">

        {{-- =========================
            PUBLIC LINKS
        ========================== --}}
        <a href="/products" class="btn btn-outline-light btn-sm">
            Browse
        </a>

        {{-- =========================
            AUTH STATE SWITCH
        ========================== --}}
        @auth

            {{-- CART (ONLY FOR LOGGED USERS) --}}
            <a href="/cart" class="btn btn-outline-light btn-sm">
                Cart ({{ count(session('cart', [])) }})
            </a>

            {{-- =========================
                ROLE-BASED DASHBOARDS
            ========================== --}}

            @php
                $role = auth()->user()->role?->name;
            @endphp

            @if($role === 'buyer')
                <a href="/dashboard" class="btn btn-outline-light btn-sm">
                    Dashboard
                </a>

                <a href="/orders" class="btn btn-outline-light btn-sm">
                    My Orders
                </a>
            @endif

            @if($role === 'supplier')
                <a href="/supplier/dashboard" class="btn btn-outline-light btn-sm">
                    Supplier
                </a>
            @endif

            @if($role === 'admin')
                <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">
                    Admin
                </a>
            @endif

            {{-- PROFILE / LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-warning btn-sm">
                    Logout
                </button>
            </form>

        @else

            {{-- =========================
                GUEST LINKS
            ========================== --}}
            <a href="/login" class="btn btn-outline-light btn-sm">
                Login
            </a>

            <a href="/register" class="btn btn-warning btn-sm">
                Register
            </a>

        @endauth

    </div>

</nav>
