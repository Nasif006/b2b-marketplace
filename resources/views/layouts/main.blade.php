<!DOCTYPE html>
<html>
<head>
    <title>B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">B2B Platform</span>

    <div>
        <span class="text-white me-3">
            {{ auth()->user()->name ?? 'Guest' }}
        </span>

        @auth
            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button class="btn btn-sm btn-danger">Logout</button>
            </form>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
