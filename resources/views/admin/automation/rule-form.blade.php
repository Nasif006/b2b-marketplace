@extends('layouts.admin')

@section('title', 'New Rule')
@section('page-title', 'Automation — New Rule')

@section('content')

<div class="mb-4">
    <a href="/admin/automation/rules" class="btn-admin btn-admin-ghost" style="padding:5px 14px;font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Rules
    </a>
</div>

<div style="max-width:600px;">
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title"><i class="bi bi-lightning-charge me-2"></i>Create Automation Rule</span>
        </div>
        <div class="admin-card-body">

            @if($errors->any())
            <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:8px;padding:12px 16px;margin-bottom:16px;color:#f87171;font-size:13px;">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
            @endif

            <form method="POST" action="/admin/automation/rules">
                @csrf

                <div class="mb-3">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Rule Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Welcome email on registration"
                        style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">IF Trigger *</label>
                        <select name="trigger" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\AutomationRule::triggerOptions() as $val => $label)
                            <option value="{{ $val }}" {{ old('trigger') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">THEN Action *</label>
                        <select name="action" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\AutomationRule::actionOptions() as $val => $label)
                            <option value="{{ $val }}" {{ old('action') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Email Subject <span style="color:var(--text-muted);font-weight:400;">(if send_email)</span></label>
                    <input type="text" name="payload_subject" value="{{ old('payload_subject') }}"
                        placeholder="e.g. Welcome to B2B Platform!"
                        style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                </div>

                <div class="mb-3">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Message / SMS Body</label>
                    <textarea name="payload_message" rows="3" placeholder="e.g. Thank you for registering. Your account is ready."
                        style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;resize:vertical;">{{ old('payload_message') }}</textarea>
                </div>

                <div class="mb-4">
                    <div class="form-check" style="display:flex;align-items:center;gap:8px;">
                        <input type="checkbox" name="is_active" id="is_active" checked
                            style="width:16px;height:16px;accent-color:var(--accent);">
                        <label for="is_active" style="font-size:13px;color:var(--text-dim);cursor:pointer;">
                            Activate rule immediately
                        </label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="bi bi-check2"></i> Save Rule
                    </button>
                    <a href="/admin/automation/rules" class="btn-admin btn-admin-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
