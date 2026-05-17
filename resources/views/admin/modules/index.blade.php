@extends('layouts.admin')
@section('title', 'Module Control')
@section('page-title', 'System — Module Control')

@section('content')

<div class="page-header">
    <div class="page-title">Module Control</div>
    <div class="page-subtitle">Enable or disable platform modules</div>
</div>

<div class="row g-3">
    @forelse($modules as $module)
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-body" style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <div style="font-size:14px;font-weight:600;color:var(--text);margin-bottom:4px;">
                        {{ $module->label }}
                    </div>
                    <span class="badge-status {{ $module->is_enabled ? 'confirmed' : 'inactive' }}">
                        {{ $module->is_enabled ? 'Enabled' : 'Disabled' }}
                    </span>
                </div>
                <form method="POST" action="/admin/modules/{{ $module->id }}/toggle">
                    @csrf
                    <button type="submit" class="btn-admin {{ $module->is_enabled ? 'btn-admin-ghost' : 'btn-admin-primary' }}"
                        style="padding:6px 14px;font-size:13px;">
                        {{ $module->is_enabled ? 'Disable' : 'Enable' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div style="text-align:center;padding:40px;color:var(--text-muted);">
            No modules found. Run: <code>php artisan db:seed --class=ModuleSettingSeeder</code>
        </div>
    </div>
    @endforelse
</div>

@endsection
