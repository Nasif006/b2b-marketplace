@extends('layouts.admin')

@section('title', isset($campaign) ? 'Edit Campaign' : 'New Campaign')
@section('page-title', isset($campaign) ? 'Marketing — Edit Campaign' : 'Marketing — New Campaign')

@section('content')

<div class="mb-4">
    <a href="/admin/campaigns" class="btn-admin btn-admin-ghost" style="padding:5px 14px;font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div style="max-width:680px;">
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">
                <i class="bi bi-megaphone me-2"></i>
                {{ isset($campaign) ? 'Edit Campaign' : 'New Campaign' }}
            </span>
        </div>
        <div class="admin-card-body">

            @if($errors->any())
            <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:8px;padding:12px 16px;margin-bottom:16px;color:#f87171;font-size:13px;">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ isset($campaign) ? '/admin/campaigns/'.$campaign->id : '/admin/campaigns' }}">
                @csrf
                @if(isset($campaign)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-12">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Campaign Name *</label>
                        <input type="text" name="name" value="{{ old('name', $campaign->name ?? '') }}"
                            placeholder="e.g. Welcome New Buyers - May 2026"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;" required>
                    </div>

                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Type *</label>
                        <select name="type" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\Campaign::typeOptions() as $val => $label)
                            <option value="{{ $val }}" {{ old('type', $campaign->type ?? 'email') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Trigger</label>
                        <select name="trigger" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\Campaign::triggerOptions() as $val => $label)
                            <option value="{{ $val }}" {{ old('trigger', $campaign->trigger ?? 'manual') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Subject <span style="color:var(--text-muted);font-weight:400;">(email only)</span></label>
                        <input type="text" name="subject" value="{{ old('subject', $campaign->subject ?? '') }}"
                            placeholder="e.g. Welcome to B2B Platform!"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                    </div>

                    <div class="col-12">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Message Body *</label>
                        <textarea name="body" rows="6"
                            placeholder="Write your campaign message here..."
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;resize:vertical;" required>{{ old('body', $campaign->body ?? '') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Schedule Date & Time</label>
                        <input type="datetime-local" name="scheduled_at"
                            value="{{ old('scheduled_at', isset($campaign->scheduled_at) ? $campaign->scheduled_at->format('Y-m-d\TH:i') : '') }}"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="bi bi-check2"></i> {{ isset($campaign) ? 'Update' : 'Save Campaign' }}
                    </button>
                    <a href="/admin/campaigns" class="btn-admin btn-admin-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
