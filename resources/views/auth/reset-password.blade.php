<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - B2B Platform</title>
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

            <h4 class="mb-4 text-center fw-bold">Reset Password</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $request->email) }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-dark w-100">Reset Password</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
