<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - B2B Platform</title>
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

            <h4 class="mb-3 text-center fw-bold">Forgot Password</h4>
            <p class="text-muted small mb-4">Enter your email and we'll send you a reset link.</p>

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

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" required autofocus>
                </div>

                <button type="submit" class="btn btn-dark w-100">Send Reset Link</button>
            </form>

            <hr>
            <div class="text-center small">
                <a href="{{ route('login') }}">Back to Login</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
