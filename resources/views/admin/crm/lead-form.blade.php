@extends('layouts.admin')

@section('title', isset($lead) ? 'Edit Lead' : 'Add Lead')
@section('page-title', isset($lead) ? 'CRM — Edit Lead' : 'CRM — Add Lead')

@section('content')

<div class="mb-4">
    <a href="/admin/crm/leads" class="btn-admin btn-admin-ghost" style="padding:5px 14px;font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Leads
    </a>
</div>

<div style="max-width:600px;">
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">
                <i class="bi bi-person-plus me-2"></i>
                {{ isset($lead) ? 'Edit Lead' : 'New Lead' }}
            </span>
        </div>
        <div class="admin-card-body">

            @if($errors->any())
            <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:8px;padding:12px 16px;margin-bottom:16px;color:#f87171;font-size:13px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ isset($lead) ? '/admin/crm/leads/'.$lead->id : '/admin/crm/leads' }}">
                @csrf
                @if(isset($lead)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Name *</label>
                        <input type="text" name="name" value="{{ old('name', $lead->name ?? '') }}"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;" required>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Company</label>
                        <input type="text" name="company" value="{{ old('company', $lead->company ?? '') }}"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Email</label>
                        <input type="email" name="email" value="{{ old('email', $lead->email ?? '') }}"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $lead->phone ?? '') }}"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Source *</label>
                        <select name="source" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\Lead::sourceOptions() as $s)
                            <option value="{{ $s }}" {{ old('source', $lead->source ?? 'manual') === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Status *</label>
                        <select name="status" style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;">
                            @foreach(\App\Models\Lead::statusOptions() as $s)
                            <option value="{{ $s }}" {{ old('status', $lead->status ?? 'new') === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;">Notes</label>
                        <textarea name="notes" rows="3"
                            style="width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--text);border-radius:8px;padding:8px 12px;font-size:13px;resize:vertical;">{{ old('notes', $lead->notes ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn-admin btn-admin-primary">
                        <i class="bi bi-check2"></i> {{ isset($lead) ? 'Update Lead' : 'Save Lead' }}
                    </button>
                    <a href="/admin/crm/leads" class="btn-admin btn-admin-ghost">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
