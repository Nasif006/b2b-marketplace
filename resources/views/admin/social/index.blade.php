@extends('layouts.admin')

@section('title', 'Social Media')
@section('page-title', 'Social Media — Scheduled Posts')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Social Media</div>
        <div class="page-subtitle">Schedule and manage posts across platforms</div>
    </div>
    <div class="d-flex gap-2">
        <a href="/admin/social/calendar" class="btn-admin btn-admin-ghost">
            <i class="bi bi-calendar3"></i> Calendar
        </a>
        <a href="/admin/social/create" class="btn-admin btn-admin-primary">
            <i class="bi bi-plus"></i> Schedule Post
        </a>
    </div>
</div>

{{-- PLATFORM STATS --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card accent">
            <i class="bi bi-facebook stat-icon"></i>
            <div class="stat-label">Facebook Posts</div>
            <div class="stat-value">{{ \App\Models\SocialPost::where('platform','facebook')->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card purple">
            <i class="bi bi-instagram stat-icon"></i>
            <div class="stat-label">Instagram Posts</div>
            <div class="stat-value">{{ \App\Models\SocialPost::where('platform','instagram')->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card success">
            <i class="bi bi-check-circle stat-icon"></i>
            <div class="stat-label">Posted</div>
            <div class="stat-value">{{ \App\Models\SocialPost::where('status','posted')->count() }}</div>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title"><i class="bi bi-share me-2"></i>All Posts</span>
        <span style="font-size:12px;color:var(--text-muted);">{{ $posts->total() }} total</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Platform</th>
                <th>Content</th>
                <th>Scheduled</th>
                <th>Status</th>
                <th>Engagement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    @if($post->platform === 'facebook')
                        <span style="color:#4f8ef7;font-weight:600;font-size:13px;"><i class="bi bi-facebook"></i> Facebook</span>
                    @else
                        <span style="color:#a78bfa;font-weight:600;font-size:13px;"><i class="bi bi-instagram"></i> Instagram</span>
                    @endif
                </td>
                <td style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:var(--text-dim);font-size:13px;">
                    {{ $post->content }}
                </td>
                <td style="font-size:12px;color:var(--text-muted);">
                    {{ $post->scheduled_at->format('d M Y, H:i') }}
                </td>
                <td>
                    <span class="badge-status {{ $post->status === 'posted' ? 'confirmed' : ($post->status === 'failed' ? 'rejected' : 'pending') }}">
                        {{ ucfirst($post->status) }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--text-muted);">
                    @if($post->status === 'posted')
                        <i class="bi bi-heart-fill" style="color:#f87171;"></i> {{ $post->likes }}
                        &nbsp;<i class="bi bi-chat-fill" style="color:#93c5fd;"></i> {{ $post->comments }}
                    @else
                        —
                    @endif
                </td>
                <td style="display:flex;gap:6px;">
                    @if($post->status === 'pending')
                    <form method="POST" action="/admin/social/{{ $post->id }}/post">
                        @csrf
                        <button type="submit" class="btn-admin btn-admin-primary" style="padding:4px 10px;font-size:12px;">
                            Publish
                        </button>
                    </form>
                    @endif
                    <form method="POST" action="/admin/social/{{ $post->id }}"
                        onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-admin"
                            style="padding:4px 10px;font-size:12px;background:rgba(239,68,68,0.1);color:#f87171;border:1px solid rgba(239,68,68,0.2);">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:32px;">
                    No posts scheduled. <a href="/admin/social/create" style="color:var(--accent);">Schedule your first post</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($posts->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">{{ $posts->links() }}</div>
    @endif
</div>

@endsection
