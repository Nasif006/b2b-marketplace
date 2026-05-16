@extends('layouts.admin')

@section('title', 'Content Calendar')
@section('page-title', 'Social Media — Content Calendar')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <div class="page-title">Content Calendar</div>
        <div class="page-subtitle">All scheduled posts in chronological order</div>
    </div>
    <a href="/admin/social/create" class="btn-admin btn-admin-primary">
        <i class="bi bi-plus"></i> Schedule Post
    </a>
</div>

@php
    $grouped = $posts->groupBy(fn($p) => $p->scheduled_at->format('Y-m-d'));
@endphp

@forelse($grouped as $date => $dayPosts)
<div style="margin-bottom:24px;">
    <div style="font-size:12px;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);margin-bottom:12px;display:flex;align-items:center;gap:10px;">
        <span>{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</span>
        <span style="flex:1;height:1px;background:var(--border);"></span>
    </div>

    <div class="row g-3">
        @foreach($dayPosts as $post)
        <div class="col-md-4">
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:16px;position:relative;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                    @if($post->platform === 'facebook')
                        <span style="color:#4f8ef7;font-size:13px;font-weight:600;">
                            <i class="bi bi-facebook"></i> Facebook
                        </span>
                    @else
                        <span style="color:#a78bfa;font-size:13px;font-weight:600;">
                            <i class="bi bi-instagram"></i> Instagram
                        </span>
                    @endif
                    <span style="font-size:11px;color:var(--text-muted);">
                        {{ $post->scheduled_at->format('H:i') }}
                    </span>
                </div>

                <div style="font-size:13px;color:var(--text-dim);margin-bottom:12px;line-height:1.5;">
                    {{ Str::limit($post->content, 100) }}
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span class="badge-status {{ $post->status === 'posted' ? 'confirmed' : ($post->status === 'failed' ? 'rejected' : 'pending') }}">
                        {{ ucfirst($post->status) }}
                    </span>
                    @if($post->status === 'posted')
                    <span style="font-size:11px;color:var(--text-muted);">
                        <i class="bi bi-heart-fill" style="color:#f87171;"></i> {{ $post->likes }}
                        <i class="bi bi-chat-fill ms-1" style="color:#93c5fd;"></i> {{ $post->comments }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@empty
<div style="text-align:center;padding:60px;color:var(--text-muted);">
    No posts scheduled yet.
    <a href="/admin/social/create" style="color:var(--accent);display:block;margin-top:8px;">Schedule your first post</a>
</div>
@endforelse

@endsection
