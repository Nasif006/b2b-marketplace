<!DOCTYPE html>
<html>
<head>
    <title>Login - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f8; }
        .auth-card { max-width: 420px; margin: 80px auto; }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="card shadow-sm">
        <div class="card-body p-4">

            <h4 class="mb-4 text-center fw-bold">Login to B2B Platform</h4>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>

            <hr>

            <div class="text-center small">
                <a href="{{ route('password.request') }}">Forgot password?</a>
                &nbsp;|&nbsp;
                <a href="{{ route('register') }}">Create account</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
