<!DOCTYPE html>
<html>
<head>
    <title>Confirm Password - B2B Platform</title>
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

            <h4 class="mb-3 text-center fw-bold">Confirm Password</h4>
            <p class="text-muted small mb-4">Please confirm your password before continuing.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark w-100">Confirm</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
