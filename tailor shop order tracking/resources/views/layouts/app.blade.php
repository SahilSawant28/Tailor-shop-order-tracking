<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Tailor Shop</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== CSS Variables (Design Tokens) ===== */
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-text: rgba(255,255,255,0.7);
            --sidebar-active: #667eea;
            --sidebar-hover: rgba(255,255,255,0.06);
            --topbar-height: 64px;
            --topbar-bg: #ffffff;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --accent: #667eea;
            --accent-dark: #5a67d8;
        }

        * { font-family: 'Inter', sans-serif; }
        body {
            background: var(--body-bg);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ===== Sidebar ===== */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            overflow-y: auto;
            scrollbar-width: none;
        }

        #sidebar::-webkit-scrollbar { display: none; }

        .sidebar-brand {
            padding: 1.5rem 1.25rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
            line-height: 1.2;
        }

        .sidebar-brand-sub {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            font-weight: 400;
        }

        /* Sidebar navigation */
        .sidebar-nav {
            padding: 1rem 0;
            flex: 1;
        }

        .sidebar-section-title {
            color: rgba(255,255,255,0.25);
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.75rem 1.25rem 0.35rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1.25rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.2s;
            position: relative;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: rgba(255,255,255,0.95);
        }

        .sidebar-link.active {
            background: rgba(102,126,234,0.15);
            color: #a5b4fc;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--sidebar-active);
            border-radius: 0 3px 3px 0;
        }

        .sidebar-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Badge in sidebar (for notifications count) */
        .sidebar-badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.45rem;
            border-radius: 20px;
        }

        /* Sidebar footer (user info) */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.85rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .sidebar-username {
            color: rgba(255,255,255,0.85);
            font-size: 0.82rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .sidebar-role {
            color: rgba(255,255,255,0.35);
            font-size: 0.7rem;
        }

        /* ===== Main Content Area ===== */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Top Navbar ===== */
        #topbar {
            height: var(--topbar-height);
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--text-secondary);
            padding: 0.25rem;
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .topbar-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--body-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.2s;
            position: relative;
        }

        .topbar-icon-btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        .notification-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid var(--topbar-bg);
        }

        .topbar-user-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--body-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.4rem 0.75rem;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-primary);
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .topbar-user-btn:hover {
            border-color: var(--accent);
            color: var(--text-primary);
        }

        .topbar-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
        }

        /* ===== Page Content ===== */
        .page-content {
            padding: 1.75rem 1.5rem;
            flex: 1;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        /* ===== Cards ===== */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            background: var(--card-bg);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        /* ===== Stat Cards ===== */
        .stat-card {
            border-radius: 14px;
            padding: 1.25rem;
            border: 1px solid var(--border-color);
            background: white;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* ===== Alerts / Flash Messages ===== */
        .flash-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .flash-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        /* ===== Tables ===== */
        .table th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--text-secondary);
            border-bottom: 2px solid var(--border-color);
            padding: 0.75rem 1rem;
        }

        .table td {
            font-size: 0.875rem;
            color: var(--text-primary);
            padding: 0.875rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* ===== Badges ===== */
        .badge {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        /* ===== Buttons ===== */
        .btn {
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
        }

        /* ===== Responsive: Mobile sidebar ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1039;
        }

        @media (max-width: 991.98px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            #main-content {
                margin-left: 0;
            }

            .topbar-toggle {
                display: flex;
            }
        }
    </style>

    {{-- Extra styles from child views --}}
    @stack('styles')
</head>
<body>

{{-- ===== Sidebar ===== --}}
<nav id="sidebar">
    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="bi bi-scissors"></i>
        </div>
        <div>
            <div class="sidebar-brand-text">Tailor Shop</div>
            <div class="sidebar-brand-sub">Management System</div>
        </div>
    </a>

    {{-- Navigation Links --}}
    <div class="sidebar-nav">

        {{-- Main --}}
        <div class="sidebar-section-title">Main</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        {{-- Customers --}}
        <div class="sidebar-section-title">Customers</div>

        <a href="#" class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            Customers
        </a>

        <a href="#" class="sidebar-link {{ request()->routeIs('measurements.*') ? 'active' : '' }}">
            <i class="bi bi-rulers"></i>
            Measurements
        </a>

        {{-- Garments & Orders --}}
        <div class="sidebar-section-title">Orders</div>

        <a href="#" class="sidebar-link {{ request()->routeIs('garments.*') ? 'active' : '' }}">
            <i class="bi bi-bag"></i>
            Garments
        </a>

        <a href="#" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            Orders
        </a>

        <a href="#" class="sidebar-link {{ request()->routeIs('order-stages.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i>
            Stitching Stages
        </a>

        {{-- Finance --}}
        <div class="sidebar-section-title">Finance</div>

        <a href="#" class="sidebar-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i>
            Payments
        </a>

        {{-- Admin only links --}}
        @if(auth()->user()->isAdmin())

            <div class="sidebar-section-title">Administration</div>

            <a href="#" class="sidebar-link {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i>
                Staff
            </a>

            <a href="#" class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i>
                Reports
            </a>

            <a href="#" class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                Settings
            </a>

        @endif

        {{-- Notifications --}}
        <div class="sidebar-section-title">Alerts</div>

        <a href="#" class="sidebar-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
            <i class="bi bi-bell"></i>
            Notifications
            <span class="sidebar-badge">0</span>
        </a>

    </div>

    {{-- Sidebar Footer: Logged-in user info --}}
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="sidebar-username">{{ auth()->user()->name }}</div>
                <div class="sidebar-role">
                    {{ ucfirst(auth()->user()->role) }}
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Mobile sidebar overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ===== Main Content ===== --}}
<div id="main-content">

    {{-- Top Navbar --}}
    <header id="topbar">
        {{-- Toggle button (mobile) --}}
        <button class="topbar-toggle" id="sidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>

        {{-- Page title --}}
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>

        {{-- Right side --}}
        <div class="topbar-right">
            {{-- Notifications bell --}}
            <a href="#" class="topbar-icon-btn" title="Notifications">
                <i class="bi bi-bell"></i>
                <span class="notification-dot"></span>
            </a>

            {{-- User dropdown --}}
            <div class="dropdown">
                <a class="topbar-user-btn dropdown-toggle"
                   href="#"
                   id="userDropdown"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <div class="topbar-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border" aria-labelledby="userDropdown">
                    <li>
                        <div class="dropdown-item-text py-2">
                            <div class="fw-semibold" style="font-size:0.85rem;">{{ auth()->user()->name }}</div>
                            <div class="text-muted" style="font-size:0.75rem;">{{ auth()->user()->email }}</div>
                            <div class="mt-1">
                                <span class="badge {{ auth()->user()->isAdmin() ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person me-2"></i>My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        {{-- Logout uses POST for security (CSRF protection) --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- Page Content --}}
    <main class="page-content">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="flash-success">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-error">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif

        {{-- Child views inject their content here --}}
        @yield('content')
    </main>

</div>{{-- end #main-content --}}

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Mobile sidebar toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    });

    // Auto-hide flash messages after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.flash-success, .flash-error').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>

{{-- Extra scripts from child views --}}
@stack('scripts')

</body>
</html>
