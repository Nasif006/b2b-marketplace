<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Platform Features — B2B Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0f172a;
            --navy-2: #1e293b;
            --blue: #3b82f6;
            --blue-2: #60a5fa;
            --blue-soft: rgba(59,130,246,0.1);
            --border: rgba(255,255,255,0.08);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8fafc;
            margin: 0;
        }

        /* ── NAVBAR ── */
        .site-nav {
            background: var(--navy);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
        }

        .nav-brand {
            font-size: 18px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-brand-icon {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--blue), #7c3aed);
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
        }

        .nav-links { display: flex; align-items: center; gap: 8px; }

        .nav-btn {
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            border: none;
        }

        .nav-btn-ghost {
            background: rgba(255,255,255,0.08);
            color: #cbd5e1;
            border: 1px solid var(--border);
        }

        .nav-btn-ghost:hover { background: rgba(255,255,255,0.14); color: white; }

        .nav-btn-primary { background: var(--blue); color: white; }
        .nav-btn-primary:hover { background: #2563eb; color: white; }

        /* ── HERO ── */
        .page-hero {
            background: linear-gradient(135deg, var(--navy) 0%, #1e3a5f 100%);
            padding: 64px 20px 56px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -80px; left: 50%;
            transform: translateX(-50%);
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 70%);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.3);
            color: var(--blue-2);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .page-hero h1 {
            font-size: clamp(28px, 4vw, 46px);
            font-weight: 700;
            letter-spacing: -1px;
            margin-bottom: 14px;
        }

        .page-hero p {
            font-size: 16px;
            color: #94a3b8;
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ── TECH STACK BAR ── */
        .tech-bar {
            background: var(--navy-2);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 14px 0;
        }

        .tech-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-family: 'DM Mono', monospace;
            margin: 3px;
        }

        /* ── MODULE SECTIONS ── */
        .module-section {
            padding: 64px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .module-section:last-of-type { border-bottom: none; }
        .module-section:nth-child(even) { background: white; }
        .module-section:nth-child(odd) { background: #f8fafc; }

        .module-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .module-title {
            font-size: clamp(22px, 3vw, 30px);
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 10px;
        }

        .module-desc {
            font-size: 15px;
            color: #475569;
            line-height: 1.7;
            margin-bottom: 28px;
            max-width: 520px;
        }

        .feature-list { list-style: none; padding: 0; margin: 0; }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #374151;
        }

        .feature-list li:last-child { border-bottom: none; }

        .feature-list li i {
            font-size: 15px;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .feature-list li strong {
            color: #0f172a;
            font-weight: 600;
        }

        /* ── MODULE DEMO CARD ── */
        .demo-card {
            background: var(--navy);
            border-radius: 16px;
            padding: 28px;
            color: white;
            height: 100%;
            min-height: 280px;
            position: relative;
            overflow: hidden;
        }

        .demo-card::before {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            opacity: 0.06;
        }

        .demo-card-icon {
            font-size: 36px;
            margin-bottom: 16px;
            display: block;
        }

        .demo-card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .demo-card-sub {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .demo-route {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-family: 'DM Mono', monospace;
            color: #94a3b8;
            margin-bottom: 6px;
            display: block;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-done {
            background: rgba(16,185,129,0.12);
            color: #34d399;
            border: 1px solid rgba(16,185,129,0.2);
        }

        .status-mock {
            background: rgba(245,158,11,0.12);
            color: #fbbf24;
            border: 1px solid rgba(245,158,11,0.2);
        }

        /* ── ARCHITECTURE ── */
        .arch-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            height: 100%;
        }

        .arch-title {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .arch-item {
            font-size: 12px;
            color: #64748b;
            padding: 4px 0;
            border-bottom: 1px solid #f1f5f9;
            font-family: 'DM Mono', monospace;
        }

        .arch-item:last-child { border-bottom: none; }

        /* ── FOOTER ── */
        .page-footer {
            background: var(--navy);
            color: #475569;
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }

        .page-footer a { color: #64748b; text-decoration: none; }
        .page-footer a:hover { color: #94a3b8; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="site-nav">
    <a class="nav-brand" href="/">
        <div class="nav-brand-icon">⚡</div>
        B2B Platform
    </a>
    <div class="nav-links">
        <a href="/" class="nav-btn nav-btn-ghost"><i class="bi bi-arrow-left me-1"></i>Home</a>
        <a href="/products" class="nav-btn nav-btn-ghost">Marketplace</a>
        @auth
            <a href="{{ auth()->user()->role?->name === 'admin' ? '/admin/dashboard' : (auth()->user()->role?->name === 'supplier' ? '/supplier/dashboard' : '/dashboard') }}"
                class="nav-btn nav-btn-primary">Dashboard</a>
        @else
            <a href="/register" class="nav-btn nav-btn-primary">Get Started</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<div class="page-hero">
    <div class="hero-badge"><i class="bi bi-journal-code"></i> Platform Documentation</div>
    <h1>B2B Platform — Feature Overview</h1>
    <p>A complete breakdown of every module, feature, and technical decision in this business automation platform.</p>
</div>

{{-- TECH STACK BAR --}}
<div class="tech-bar">
    <div class="container text-center">
        @foreach(['Laravel 12', 'PHP 8.2', 'MySQL', 'Bootstrap 5', 'Blade Templates', 'Session Auth', 'Role Middleware', 'Eloquent ORM', 'cPanel Hosting', 'GitHub CI'] as $tech)
        <span class="tech-pill">{{ $tech }}</span>
        @endforeach
    </div>
</div>

{{-- ── MODULE 1: E-COMMERCE ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#eff6ff;color:#1d4ed8;">
                    <i class="bi bi-shop"></i> Module 01
                </div>
                <div class="module-title">E-Commerce & Marketplace</div>
                <div class="module-desc">A full B2B wholesale marketplace where suppliers list products and buyers place bulk orders — with MOQ enforcement, stock tracking, and invoice generation.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Multi-vendor product listings</strong> — Each supplier manages their own product catalogue independently</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>MOQ enforcement</strong> — Minimum Order Quantity applied automatically at cart level</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Stock tracking</strong> — Live stock display with low-stock alerts (≤50 units flagged)</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Cart → Checkout → Order</strong> — Full purchase flow with session-based cart</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Per-supplier order splitting</strong> — Cart items grouped by supplier, separate orders created</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Payment methods</strong> — Cash on Delivery + Fake payment gateway (demo)</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Invoice generation</strong> — Professional print-ready invoice per order with transaction ID</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#1e3a5f);">
                    <div class="demo-card-icon">🛒</div>
                    <div class="demo-card-title">E-Commerce Routes</div>
                    <div class="demo-card-sub">Public marketplace + authenticated buyer flow</div>
                    <span class="demo-route">GET /products</span>
                    <span class="demo-route">GET /products/{id}</span>
                    <span class="demo-route">GET /cart</span>
                    <span class="demo-route">POST /checkout</span>
                    <span class="demo-route">GET /orders/{id}/invoice</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Fully Implemented</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MODULE 2: CRM ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5 flex-row-reverse">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#f0fdf4;color:#15803d;">
                    <i class="bi bi-person-lines-fill"></i> Module 02
                </div>
                <div class="module-title">CRM — Customer Relationship Management</div>
                <div class="module-desc">Auto-tracks every buyer as a customer profile from the moment they register. Segments customers by spend, logs every interaction, and manages leads through a sales pipeline.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Auto customer profiling</strong> — Profile created automatically when buyer registers</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Purchase history tracking</strong> — All orders visible per customer with totals</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Customer segmentation</strong> — Auto-calculated: New (0-10k), Regular (10k-50k), VIP (50k+)</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Lead management pipeline</strong> — Track potential customers: New → Contacted → Qualified → Converted</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Interaction history</strong> — Log calls, messages, RFQs, and notes per customer</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#14532d);">
                    <div class="demo-card-icon">👥</div>
                    <div class="demo-card-title">CRM Routes</div>
                    <div class="demo-card-sub">Admin-only access via role middleware</div>
                    <span class="demo-route">GET /admin/crm/customers</span>
                    <span class="demo-route">GET /admin/crm/customers/{id}</span>
                    <span class="demo-route">POST /admin/crm/customers/{id}/interactions</span>
                    <span class="demo-route">GET /admin/crm/leads</span>
                    <span class="demo-route">POST /admin/crm/leads</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Fully Implemented</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MODULE 3: WORKFLOW AUTOMATION ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#faf5ff;color:#6d28d9;">
                    <i class="bi bi-lightning-charge"></i> Module 03
                </div>
                <div class="module-title">Workflow Automation Engine</div>
                <div class="module-desc">A database-driven IF→THEN rule engine. Admin creates rules that fire automatically when platform events occur. Every execution is logged with status and details.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Rule builder UI</strong> — Create IF trigger → THEN action rules from admin panel</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Live triggers</strong> — order_placed and user_registered fire automatically in real-time</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Action types</strong> — send_email, send_sms, notify_supplier, log_interaction</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Enable/disable rules</strong> — Toggle individual rules without deleting them</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Execution log trail</strong> — Every rule execution recorded with status (success/failed)</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>AutomationEngine service</strong> — Dedicated service class handles rule matching and execution</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#2e1065);">
                    <div class="demo-card-icon">⚡</div>
                    <div class="demo-card-title">How a Rule Fires</div>
                    <div class="demo-card-sub">Example: buyer places order</div>
                    <span class="demo-route">1. Buyer submits checkout</span>
                    <span class="demo-route">2. AutomationEngine::fire('order_placed')</span>
                    <span class="demo-route">3. DB query: active rules WHERE trigger = 'order_placed'</span>
                    <span class="demo-route">4. Matching rule action executes</span>
                    <span class="demo-route">5. Log written to workflow_logs</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Fully Implemented</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MODULE 4: MARKETING ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5 flex-row-reverse">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#fff7ed;color:#c2410c;">
                    <i class="bi bi-megaphone"></i> Module 04
                </div>
                <div class="module-title">Marketing Automation</div>
                <div class="module-desc">Create and schedule email/SMS campaigns with trigger-based delivery. Pre-built templates for the most common B2B marketing scenarios.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Campaign creation</strong> — Name, type (email/SMS), trigger, subject, body, schedule</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Trigger-based campaigns</strong> — Link campaigns to order_placed, user_registered, abandoned_cart</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Template system</strong> — Welcome, Order Confirmation, Abandoned Cart templates displayed</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Campaign scheduling</strong> — Set future date/time for campaign delivery</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Status tracking</strong> — Draft → Scheduled → Sent lifecycle</div></li>
                    <li><i class="bi bi-check-circle-fill" style="color:#fbbf24;"></i><div><strong>Actual email sending</strong> — Currently logs to file. Real SMTP: one .env config change away</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#431407);">
                    <div class="demo-card-icon">📧</div>
                    <div class="demo-card-title">Campaign Routes</div>
                    <div class="demo-card-sub">Full CRUD with send tracking</div>
                    <span class="demo-route">GET /admin/campaigns</span>
                    <span class="demo-route">GET /admin/campaigns/create</span>
                    <span class="demo-route">POST /admin/campaigns</span>
                    <span class="demo-route">POST /admin/campaigns/{id}/send</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Implemented</span>
                        <span class="status-badge status-mock ms-2"><i class="bi bi-info-circle"></i> Email = Log Driver</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MODULE 5: SOCIAL MEDIA ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#fdf2f8;color:#be185d;">
                    <i class="bi bi-share"></i> Module 05
                </div>
                <div class="module-title">Social Media Management</div>
                <div class="module-desc">Schedule and manage social media posts for Facebook and Instagram from one dashboard. Content calendar view shows all scheduled posts chronologically.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Post scheduling</strong> — Schedule posts for Facebook or Instagram with date/time</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Content calendar</strong> — Posts grouped by day in chronological calendar view</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Platform stats</strong> — Separate counts for Facebook vs Instagram posts</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Manual publish</strong> — Mark posts as published, generates mock engagement data</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Engagement tracking</strong> — Likes and comments tracked per post (mock data for demo)</div></li>
                    <li><i class="bi bi-check-circle-fill" style="color:#fbbf24;"></i><div><strong>Real API posting</strong> — Requires Facebook/Instagram API keys. Architecture is API-ready</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#500724);">
                    <div class="demo-card-icon">📱</div>
                    <div class="demo-card-title">Social Media Routes</div>
                    <div class="demo-card-sub">Schedule, calendar, and publish flow</div>
                    <span class="demo-route">GET /admin/social</span>
                    <span class="demo-route">GET /admin/social/calendar</span>
                    <span class="demo-route">GET /admin/social/create</span>
                    <span class="demo-route">POST /admin/social</span>
                    <span class="demo-route">POST /admin/social/{id}/post</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Implemented</span>
                        <span class="status-badge status-mock ms-2"><i class="bi bi-info-circle"></i> API = Mock</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MODULE 6: ADMIN PANEL ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5 flex-row-reverse">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#f0f9ff;color:#0369a1;">
                    <i class="bi bi-shield-check"></i> Module 06
                </div>
                <div class="module-title">Admin Control Panel</div>
                <div class="module-desc">A full-featured admin dashboard with dark UI, sidebar navigation, user management, module control, and platform-wide monitoring. Accessible only to admin role.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Role-based access</strong> — Admin, Supplier, Buyer — each with separate dashboards and middleware</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>User management</strong> — View all users, change roles, delete accounts</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Module control</strong> — Enable/disable CRM, Automation, Marketing, Social, Tickets independently</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Platform stats dashboard</strong> — Live counts: users, products, orders, revenue</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Support ticket management</strong> — View, respond, and update status of buyer tickets</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Orders & Products overview</strong> — Platform-wide order list and product catalogue</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#0c4a6e);">
                    <div class="demo-card-icon">🛡️</div>
                    <div class="demo-card-title">Admin Panel Access</div>
                    <div class="demo-card-sub">Protected by role:admin middleware</div>
                    <span class="demo-route">GET /admin/dashboard</span>
                    <span class="demo-route">GET /admin/users</span>
                    <span class="demo-route">GET /admin/modules</span>
                    <span class="demo-route">GET /admin/tickets</span>
                    <span class="demo-route">GET /admin/orders</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Fully Implemented</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MODULE 7: SUPPORT ── --}}
<div class="module-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="module-tag" style="background:#f0fdf4;color:#15803d;">
                    <i class="bi bi-headset"></i> Module 07
                </div>
                <div class="module-title">Support Ticket System</div>
                <div class="module-desc">Buyers submit support tickets from their dashboard. Admin responds from the admin panel. Full status lifecycle management.</div>

                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Ticket submission</strong> — Buyers submit tickets with subject and message</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Status lifecycle</strong> — Open → In Progress → Closed</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Admin response</strong> — Admin writes response and updates status in one action</div></li>
                    <li><i class="bi bi-check-circle-fill text-success"></i><div><strong>Buyer visibility</strong> — Buyers see admin response and current status in their ticket list</div></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="demo-card" style="background:linear-gradient(135deg,#0f172a,#14532d);">
                    <div class="demo-card-icon">🎧</div>
                    <div class="demo-card-title">Ticket Flow</div>
                    <div class="demo-card-sub">Buyer → Admin → Resolution</div>
                    <span class="demo-route">GET /tickets/create (buyer)</span>
                    <span class="demo-route">POST /tickets (buyer)</span>
                    <span class="demo-route">GET /admin/tickets (admin)</span>
                    <span class="demo-route">GET /admin/tickets/{id} (admin)</span>
                    <span class="demo-route">POST /admin/tickets/{id}/respond</span>
                    <div class="mt-3">
                        <span class="status-badge status-done"><i class="bi bi-check2"></i> Fully Implemented</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── DATABASE DESIGN ── --}}
<div style="padding:64px 0;background:#f8fafc;border-bottom:1px solid #e2e8f0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="module-tag d-inline-flex" style="background:#f0f9ff;color:#0369a1;">
                <i class="bi bi-database"></i> Database
            </div>
            <div class="module-title">Database Design</div>
            <p style="color:#64748b;font-size:15px;">{{ count(['users','roles','products','orders','order_items','customers','leads','interactions','automation_rules','workflow_logs','campaigns','social_posts','tickets','module_settings']) }} tables — fully normalized relational schema</p>
        </div>

        <div class="row g-3">
            @foreach([
                ['Core Auth', 'bi-person-lock', ['users','roles','sessions','password_reset_tokens']],
                ['Commerce', 'bi-shop', ['products','orders','order_items']],
                ['CRM', 'bi-person-lines-fill', ['customers','leads','interactions']],
                ['Automation', 'bi-lightning-charge', ['automation_rules','workflow_logs']],
                ['Marketing', 'bi-megaphone', ['campaigns','social_posts']],
                ['Platform', 'bi-gear', ['tickets','module_settings','jobs','cache']],
            ] as [$title, $icon, $tables])
            <div class="col-md-4 col-sm-6">
                <div class="arch-card">
                    <div class="arch-title">
                        <i class="bi {{ $icon }}" style="color:var(--blue);"></i>
                        {{ $title }}
                    </div>
                    @foreach($tables as $table)
                    <div class="arch-item">{{ $table }}</div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ── ROLE SYSTEM ── --}}
<div style="padding:64px 0;background:white;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="module-tag d-inline-flex" style="background:#faf5ff;color:#6d28d9;">
                <i class="bi bi-diagram-3"></i> Access Control
            </div>
            <div class="module-title">Role-Based Access System</div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div style="background:linear-gradient(135deg,#0f172a,#1e3a5f);border-radius:14px;padding:28px;color:white;">
                    <div style="font-size:28px;margin-bottom:12px;">🛡️</div>
                    <div style="font-size:16px;font-weight:700;margin-bottom:8px;">Admin</div>
                    <div style="font-size:13px;color:#64748b;margin-bottom:16px;">Full platform control</div>
                    <div style="font-size:12px;color:#94a3b8;line-height:2;">
                        ✓ All modules access<br>
                        ✓ User management<br>
                        ✓ CRM & automation<br>
                        ✓ Module enable/disable<br>
                        ✓ Ticket management
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background:linear-gradient(135deg,#431407,#7c2d12);border-radius:14px;padding:28px;color:white;">
                    <div style="font-size:28px;margin-bottom:12px;">📦</div>
                    <div style="font-size:16px;font-weight:700;margin-bottom:8px;">Supplier</div>
                    <div style="font-size:13px;color:#9a3412;margin-bottom:16px;">Product & order management</div>
                    <div style="font-size:12px;color:#94a3b8;line-height:2;">
                        ✓ Product CRUD<br>
                        ✓ Inventory management<br>
                        ✓ Order accept/reject<br>
                        ✓ Supplier dashboard<br>
                        ✓ Low stock alerts
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background:linear-gradient(135deg,#052e16,#14532d);border-radius:14px;padding:28px;color:white;">
                    <div style="font-size:28px;margin-bottom:12px;">🛒</div>
                    <div style="font-size:16px;font-weight:700;margin-bottom:8px;">Buyer</div>
                    <div style="font-size:13px;color:#166534;margin-bottom:16px;">Marketplace purchasing</div>
                    <div style="font-size:12px;color:#94a3b8;line-height:2;">
                        ✓ Browse & search products<br>
                        ✓ Cart & checkout<br>
                        ✓ Order history<br>
                        ✓ Invoice download<br>
                        ✓ Support tickets
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<div class="page-footer">
    <div>⚡ B2B Platform — Built with Laravel 12 + Bootstrap 5</div>
    <div style="display:flex;gap:16px;">
        <a href="/">Home</a>
        <a href="/products">Marketplace</a>
        <a href="/login">Login</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
