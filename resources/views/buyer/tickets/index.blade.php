<!DOCTYPE html>
<html>
<head>
    <title>My Tickets - B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background:#f5f6f8;">

@include('partials.navbar')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">My Support Tickets</h4>
        <a href="/tickets/create" class="btn btn-dark btn-sm">
            <i class="bi bi-plus"></i> New Ticket
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($tickets as $ticket)
    <div class="card shadow-sm mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <div class="fw-semibold">#{{ $ticket->id }} — {{ $ticket->subject }}</div>
                <div class="text-muted small mt-1">{{ $ticket->created_at->format('d M Y') }}</div>
            </div>
            <div class="d-flex align-items-center gap-3">
                @php
                    $badge = match($ticket->status) {
                        'closed'      => 'success',
                        'in_progress' => 'warning',
                        default       => 'danger',
                    };
                @endphp
                <span class="badge bg-{{ $badge }}">{{ ucfirst(str_replace('_',' ',$ticket->status)) }}</span>
                @if($ticket->admin_response)
                    <span class="badge bg-info">Response received</span>
                @endif
            </div>
        </div>
        @if($ticket->admin_response)
        <div class="card-footer bg-light">
            <div class="small text-muted mb-1">Admin Response:</div>
            <div class="small">{{ $ticket->admin_response }}</div>
        </div>
        @endif
    </div>
    @empty
    <div class="text-center text-muted py-5">
        No tickets yet. <a href="/tickets/create">Submit your first ticket</a>
    </div>
    @endforelse
</div>

</body>
</html>
