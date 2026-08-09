<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - Luxury Bridal</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (Dark Mode supported) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-gold: #c5a880;
            --primary-gold-hover: #b09167;
            --dark-bg: #121212;
            --dark-card: #1e1e1e;
            --light-bg: #f9f9fa;
            --light-card: #ffffff;
            --sidebar-width: 260px;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--dark-bg);
            color: #e0e0e0;
            overflow-x: hidden;
            transition: background-color 0.3s ease;
        }
        [data-bs-theme="light"] body {
            background-color: var(--light-bg);
            color: #333;
        }
        .wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--dark-card);
            border-right: 1px solid rgba(255,255,255,0.05);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1050;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        [data-bs-theme="light"] .sidebar {
            background-color: var(--light-card);
            border-right: 1px solid rgba(0,0,0,0.05);
        }
        .sidebar .logo-area {
            padding: 20px;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: var(--primary-gold);
            letter-spacing: 2px;
            text-transform: uppercase;
            white-space: nowrap;
        }
        [data-bs-theme="light"] .sidebar .logo-area {
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .sidebar .nav-item {
            padding: 3px 12px;
        }
        .sidebar-header {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            padding: 16px 15px 5px 25px;
            display: block;
            white-space: nowrap;
        }
        .sidebar .nav-link {
            color: #a0a0a0;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        [data-bs-theme="light"] .sidebar .nav-link {
            color: #666;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(197, 168, 128, 0.15);
            color: var(--primary-gold);
            font-weight: 600;
        }
        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }
        
        /* Header */
        .header {
            height: 70px;
            background-color: var(--dark-card);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        [data-bs-theme="light"] .header {
            background-color: var(--light-card);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .theme-toggle {
            cursor: pointer;
            font-size: 20px;
            color: var(--primary-gold);
            background: none;
            border: none;
            outline: none;
        }
        
        /* Cards */
        .card {
            background-color: var(--dark-card);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }
        [data-bs-theme="light"] .card {
            background-color: var(--light-card);
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 18px 25px;
            font-weight: 600;
        }
        [data-bs-theme="light"] .card-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .card-body {
            padding: 25px;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
            color: #fff;
        }
        .btn-primary:hover {
            background-color: var(--primary-gold-hover);
            border-color: var(--primary-gold-hover);
        }
        
        .content-area {
            padding: 25px;
            flex: 1;
        }

        /* Desktop Sidebar Hide/Collapse (Icon Only Mode) */
        @media (min-width: 992px) {
            body.sidebar-collapsed .sidebar {
                width: 75px;
            }
            body.sidebar-collapsed .sidebar .logo-area span,
            body.sidebar-collapsed .sidebar .sidebar-header,
            body.sidebar-collapsed .sidebar .nav-link-text {
                display: none !important;
            }
            body.sidebar-collapsed .sidebar .nav-link {
                justify-content: center;
                padding: 12px 0;
            }
            body.sidebar-collapsed .sidebar .nav-link i {
                margin-right: 0;
                font-size: 18px;
            }
            body.sidebar-collapsed .main-content {
                margin-left: 75px !important;
            }
        }

        /* Mobile Sidebar Drawer Responsive Toggle */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1040;
            backdrop-filter: blur(4px);
        }

        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.show {
                margin-left: 0;
                box-shadow: 0 0 35px rgba(0,0,0,0.9);
            }
            .sidebar-overlay.show {
                display: block;
            }
            .main-content {
                margin-left: 0 !important;
            }
            .content-area {
                padding: 15px;
            }
            .header {
                padding: 0 15px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Backdrop for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar Navigation -->
        <aside class="sidebar" id="adminSidebar">
            <div class="logo-area d-flex align-items-center justify-content-between">
                <span>RaniSahab</span>
                <button class="btn btn-sm text-gold d-lg-none p-0 border-0" id="sidebarCloseBtn"><i class="fas fa-times fs-5"></i></button>
            </div>

            <ul class="nav flex-column mt-3 mb-5">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" title="Dashboard">
                        <i class="fas fa-home"></i> <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <!-- Boutique Catalog -->
                <li class="sidebar-header">Boutique Catalog</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}" title="Products Catalog">
                        <i class="fas fa-gem"></i> <span class="nav-link-text">Products Catalog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}" title="Categories">
                        <i class="fas fa-folder-open"></i> <span class="nav-link-text">Categories</span>
                    </a>
                </li>

                <!-- Sales Operations -->
                <li class="sidebar-header">Sales & Orders</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}" title="Orders Management">
                        <i class="fas fa-shopping-bag"></i> <span class="nav-link-text">Orders Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}" title="Coupons & Promos">
                        <i class="fas fa-ticket-alt"></i> <span class="nav-link-text">Coupons & Promos</span>
                    </a>
                </li>

                <!-- Customer CRM -->
                <li class="sidebar-header">Customer CRM</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}" title="Customers List">
                        <i class="fas fa-users"></i> <span class="nav-link-text">Customers List</span>
                    </a>
                </li>


                <!-- Bridal & Studio -->
                <li class="sidebar-header">Bridal Studio Services</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}" href="{{ route('admin.appointments.index') }}" title="Consultations">
                        <i class="fas fa-calendar-check"></i> <span class="nav-link-text">Consultations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.bridal-packages.*') ? 'active' : '' }}" href="{{ route('admin.bridal-packages.index') }}" title="Bridal Packages">
                        <i class="fas fa-crown"></i> <span class="nav-link-text">Bridal Packages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.designs.*') ? 'active' : '' }}" href="{{ route('admin.designs.index') }}" title="Custom Designs">
                        <i class="fas fa-wand-magic-sparkles"></i> <span class="nav-link-text">Custom Designs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.measurements.*') ? 'active' : '' }}" href="{{ route('admin.measurements.index') }}" title="Fitting Specs">
                        <i class="fas fa-ruler-combined"></i> <span class="nav-link-text">Fitting Specs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.makeup-bookings.*') ? 'active' : '' }}" href="{{ route('admin.makeup-bookings.index') }}" title="Makeup Bookings">
                        <i class="fas fa-sparkles"></i> <span class="nav-link-text">Makeup Bookings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.makeup-services.*') ? 'active' : '' }}" href="{{ route('admin.makeup-services.index') }}" title="Makeup Services">
                        <i class="fas fa-palette"></i> <span class="nav-link-text">Makeup Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}" title="Real Brides Gallery">
                        <i class="fas fa-images"></i> <span class="nav-link-text">Real Brides Gallery</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.contact-inquiries.*') ? 'active' : '' }}" href="{{ route('admin.contact-inquiries.index') }}" title="Contact Inquiries">
                        <i class="fas fa-envelope-open-text"></i> <span class="nav-link-text">Contact Inquiries</span>
                    </a>
                </li>

                <!-- System & Access -->
                <li class="sidebar-header">System Access</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}" title="Roles & Permissions">
                        <i class="fas fa-shield-halved"></i> <span class="nav-link-text">Roles & Permissions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}" title="Admin Users">
                        <i class="fas fa-user-gear"></i> <span class="nav-link-text">Admin Users</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content Wrapper -->
        <main class="main-content">
            <!-- Header Topbar -->
            <header class="header">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-warning btn-sm rounded-circle" id="sidebarToggleBtn" style="width: 38px; height: 38px;" title="Toggle Sidebar Hide/Show">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h5 class="mb-0 fw-bold font-display text-gold">@yield('title', 'Dashboard')</h5>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button class="theme-toggle" id="themeToggleBtn" title="Toggle Light/Dark Theme">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-reset" id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=c5a880&color=fff" alt="Avatar" class="rounded-circle me-2" width="36" height="36">
                            <span class="fw-semibold d-none d-sm-inline-block" style="font-size: 0.9rem;">{{ auth()->user()->name ?? 'Admin' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="background: var(--dark-card);">
                            <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="fas fa-dashboard me-2 text-warning"></i> Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Page Main Content Area -->
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Vendor Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Restore saved sidebar collapsed preference on desktop
        if (window.innerWidth >= 992) {
            if (localStorage.getItem('admin_sidebar_collapsed') === '1') {
                document.body.classList.add('sidebar-collapsed');
            }
        }

        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const htmlElement = document.documentElement;
        
        const savedTheme = localStorage.getItem('theme') || 'dark';
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                const currentTheme = htmlElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                htmlElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });
        }

        function updateIcon(theme) {
            if (themeToggleBtn) {
                if (theme === 'dark') {
                    themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
                } else {
                    themeToggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
                }
            }
        }

        // Universal Sidebar Hide/Show Toggle Handler (Desktop & Mobile)
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const adminSidebar = document.getElementById('adminSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            if (window.innerWidth >= 992) {
                // Desktop: Toggle Collapsed Icon-only Mode
                document.body.classList.toggle('sidebar-collapsed');
                const isCollapsed = document.body.classList.contains('sidebar-collapsed');
                localStorage.setItem('admin_sidebar_collapsed', isCollapsed ? '1' : '0');
            } else {
                // Mobile: Toggle Drawer Slide-in Overlay
                adminSidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            }
        }

        if (sidebarToggleBtn) sidebarToggleBtn.addEventListener('click', toggleSidebar);
        if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', toggleSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
    @stack('scripts')
</body>
</html>
