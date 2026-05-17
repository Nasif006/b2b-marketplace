<!DOCTYPE html>
<html>
<head>
    <title>New Ticket - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f5f6f8;">

@include('partials.navbar')

<div class="container mt-4" style="max-width:600px;">
    <h4 class="mb-4">Submit Support Ticket</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="/tickets">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control"
                        value="{{ old('subject') }}" placeholder="Brief description of your issue" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="body" class="form-control" rows="5"
                        placeholder="Describe your issue in detail..." required>{{ old('body') }}</textarea>
                </div>
                <button type="submit" class="btn btn-dark w-100">Submit Ticket</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
