<!DOCTYPE html>
<html>
<head>
    <title>Register - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f8; }
        .auth-card { max-width: 480px; margin: 60px auto; }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="card shadow-sm">
        <div class="card-body p-4">

            <h4 class="mb-4 text-center fw-bold">Create an Account</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Register As</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="role" value="buyer" id="role_buyer"
                                {{ old('role', 'buyer') === 'buyer' ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_buyer">Buyer</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"
                                name="role" value="supplier" id="role_supplier"
                                {{ old('role') === 'supplier' ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_supplier">Supplier</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100">Register</button>
            </form>

            <hr>
            <div class="text-center small">
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
