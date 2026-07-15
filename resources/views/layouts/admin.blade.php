<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — B2B Platform</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 240px;
            --topbar-height: 56px;
            --bg: #0f1117;
            --sidebar-bg: #13161f;
            --surface: #1a1e2e;
            --surface-2: #212538;
            --border: rgba(255,255,255,0.07);
            --accent: #4f8ef7;
            --accent-soft: rgba(79,142,247,0.12);
            --accent-2: #7c3aed;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text: #e8eaf0;
            --text-muted: #6b7280;
            --text-dim: #9ca3af;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            font-size: 14px;
        }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            overflow: hidden;
        }

        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid var(--border);
            gap: 10px;
        }

        .brand-icon {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }

        .brand-name {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
            color: var(--text);
        }

        .brand-badge {
            font-size: 9px;
            background: var(--accent-soft);
            color: var(--accent);
            border: 1px solid rgba(79,142,247,0.3);
            padding: 1px 6px;
            border-radius: 20px;
            font-family: 'DM Mono', monospace;
            margin-left: auto;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 16px 20px 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 20px;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 400;
            border-left: 2px solid transparent;
            transition: all 0.15s ease;
        }

        .sidebar-link:hover {
            color: var(--text);
            background: rgba(255,255,255,0.04);
            border-left-color: rgba(79,142,247,0.4);
        }

        .sidebar-link.active {
            color: var(--accent);
            background: var(--accent-soft);
            border-left-color: var(--accent);
            font-weight: 500;
        }

        .sidebar-link i {
            font-size: 15px;
            width: 18px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--border);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-info { flex: 1; min-width: 0; }

        .user-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* ── MAIN AREA ── */
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .admin-topbar {
            height: var(--topbar-height);
            background: var(--sidebar-bg);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--text);
            flex: 1;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(239,68,68,0.1);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-logout:hover {
            background: rgba(239,68,68,0.2);
            color: #fca5a5;
        }

        /* ── CONTENT ── */
        .admin-content {
            flex: 1;
            padding: 28px;
        }

        /* ── REUSABLE COMPONENTS ── */
        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--text);
            letter-spacing: -0.3px;
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 22px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .stat-card:hover { border-color: rgba(255,255,255,0.12); }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 80px; height: 80px;
            border-radius: 50%;
            opacity: 0.06;
            transform: translate(20px, -20px);
        }

        .stat-card.accent::before { background: var(--accent); }
        .stat-card.success::before { background: var(--success); }
        .stat-card.warning::before { background: var(--warning); }
        .stat-card.purple::before { background: var(--accent-2); }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 600;
            color: var(--text);
            font-family: 'DM Mono', monospace;
            letter-spacing: -1px;
            line-height: 1;
        }

        .stat-icon {
            position: absolute;
            top: 18px; right: 18px;
            font-size: 20px;
            opacity: 0.5;
        }

        .stat-card.accent .stat-icon { color: var(--accent); }
        .stat-card.success .stat-icon { color: var(--success); }
        .stat-card.warning .stat-icon { color: var(--warning); }
        .stat-card.purple .stat-icon { color: var(--accent-2); }

        .admin-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .admin-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-card-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .admin-card-body { padding: 20px; }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 10px 16px;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .admin-table td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            color: var(--text-dim);
            font-size: 13.5px;
        }

        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-status.pending {
            background: rgba(245,158,11,0.12);
            color: #fbbf24;
            border: 1px solid rgba(245,158,11,0.2);
        }

        .badge-status.active, .badge-status.confirmed {
            background: rgba(16,185,129,0.12);
            color: #34d399;
            border: 1px solid rgba(16,185,129,0.2);
        }

        .badge-status.inactive, .badge-status.rejected {
            background: rgba(239,68,68,0.1);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
        }

        .btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
            border: none;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-admin-primary {
            background: var(--accent);
            color: white;
        }

        .btn-admin-primary:hover {
            background: #3b7ef5;
            color: white;
        }

        .btn-admin-ghost {
            background: rgba(255,255,255,0.06);
            color: var(--text-dim);
            border: 1px solid var(--border);
        }

        .btn-admin-ghost:hover {
            background: rgba(255,255,255,0.1);
            color: var(--text);
        }

        /* Alert overrides */
        .alert { border-radius: 10px; border: 1px solid; font-size: 13.5px; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
    </style>
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="admin-sidebar">

    <div class="sidebar-brand">
        <div class="brand-icon">⚡</div>
        <span class="brand-name">B2B Platform</span>
        <span class="brand-badge">ADMIN</span>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section-label">Overview</div>
        <a href="/admin/dashboard" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        <div class="nav-section-label">Commerce</div>
        <a href="/admin/users" class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Users
        </a>
        <a href="/admin/orders" class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
            <i class="bi bi-bag"></i> Orders
        </a>
        <a href="/admin/products" class="sidebar-link {{ request()->is('admin/products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>

        <div class="nav-section-label">CRM</div>
        <a href="/admin/crm/customers" class="sidebar-link {{ request()->is('admin/crm/customers*') ? 'active' : '' }}">
            <i class="bi bi-person-lines-fill"></i> Customers
        </a>
        <a href="/admin/crm/leads" class="sidebar-link {{ request()->is('admin/crm/leads*') ? 'active' : '' }}">
            <i class="bi bi-funnel"></i> Leads
        </a>

        <div class="nav-section-label">Automation</div>
        <a href="/admin/automation/rules" class="sidebar-link {{ request()->is('admin/automation/rules*') ? 'active' : '' }}">
            <i class="bi bi-lightning-charge"></i> Workflow Rules
        </a>
        <a href="/admin/automation/logs" class="sidebar-link {{ request()->is('admin/automation/logs*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> Logs
        </a>

        <div class="nav-section-label">Marketing</div>
        <a href="/admin/campaigns" class="sidebar-link {{ request()->is('admin/campaigns*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i> Campaigns
        </a>
        <a href="/admin/social" class="sidebar-link {{ request()->is('admin/social*') ? 'active' : '' }}">
            <i class="bi bi-share"></i> Social Media
        </a>

        <div class="nav-section-label">Support</div>
        <a href="/admin/tickets" class="sidebar-link {{ request()->is('admin/tickets*') ? 'active' : '' }}">
            <i class="bi bi-headset"></i> Tickets
        </a>

        <div class="nav-section-label">System</div>
        <a href="/admin/modules" class="sidebar-link {{ request()->is('admin/modules*') ? 'active' : '' }}">
            <i class="bi bi-toggles"></i> Module Control
        </a>

    </nav>

    <div class="sidebar-footer">
        <div class="user-chip">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
    </div>

</aside>

{{-- ── MAIN ── --}}
<div class="admin-main">

    {{-- TOPBAR --}}
    <div class="admin-topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="admin-content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                style="background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.2);color:#34d399;">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
                style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.2);color:#f87171;">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
