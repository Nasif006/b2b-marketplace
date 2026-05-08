<!DOCTYPE html>
<html>
<head>
    <title>Verify Email - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f8; }
        .auth-card { max-width: 420px; margin: 80px auto; }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="card shadow-sm">
        <div class="card-body p-4 text-center">

            <h4 class="mb-3 fw-bold">Verify Your Email</h4>
            <p class="text-muted small mb-4">
                Thanks for signing up! Please verify your email address by clicking the link we sent you.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">A new verification link has been sent.</div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-dark w-100 mb-3">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary w-100">Log Out</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
