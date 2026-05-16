@extends('layouts.admin')

@section('title', 'Schedule Post')
@section('page-title', 'Social Media — Schedule Post')

@section('content')

<div class="mb-4">
    <a href="/admin/social" class="btn-admin btn-admin-ghost" style="padding:5px 14px;font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div style="max-width:600px;">
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title"><i class="bi bi-share me-2"></i>Schedule New Post</span>
        </div>
        <div class="admin-card-body">

            @if($errors->any())
            <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:8px;padding:12px 16px;margin-bottom:16px;color:#f87171;font-size:13px;">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
            @endif

            <form method="POST" action="/admin/social">
                @csrf

                <div class="mb-3">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Platform *</label>
                    <div style="display:flex;gap:12px;">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;background:var(--surface-2);border:1px solid var(--border);border-radius:8px;padding:10px 16px;flex:1;">
                            <input type="radio" name="platform" value="facebook" {{ old('platform','facebook') === 'facebook' ? 'checked' : '' }}
                                style="accent-color:var(--accent);">
                            <i class="bi bi-facebook" style="color:#4f8ef7;"></i>
                            <span style="font-size:13px;color:var(--text);">Facebook</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;background:var(--surface-2);border:1px solid var(--border);border-radius:8px;padding:10px 16px;flex:1;">
                            <input type="radio" name="platform" value="instagram" {{ old('platform') === 'instagram' ? 'checked' : '' }}
                                style="accent-color:var(--accent);">
                            <i class="bi bi-instagram" style="color:#a78bfa;"></i>
                            <span style="font-size:13px;color:var(--text);">Instagram</span>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Post Content *</label>
                    <textarea name="content" rows="5"
                        placeholder="Write your post content here..."
                        style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;resize:vertical;" required>{{ old('content') }}</textarea>
                    <div style="font-size:11px;color:var(--text-muted);margin-top:4px;">Max 2000 characters</div>
                </div>

                <div class="mb-4">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Schedule Date & Time *</label>
                    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}"
                        style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="bi bi-clock"></i> Schedule Post
                    </button>
                    <a href="/admin/social" class="btn-admin btn-admin-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
