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
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        [data-bs-theme="light"] .sidebar {
            background-color: var(--light-card);
            border-right: 1px solid rgba(0,0,0,0.05);
        }
        .sidebar .logo-area {
            padding: 20px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: var(--primary-gold);
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        [data-bs-theme="light"] .sidebar .logo-area {
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .sidebar .nav-item {
            padding: 5px 15px;
        }
        .sidebar-header {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            padding: 18px 15px 5px 35px;
            display: block;
        }
        .sidebar .nav-link {
            color: #a0a0a0;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        [data-bs-theme="light"] .sidebar .nav-link {
            color: #666;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(197, 168, 128, 0.1);
            color: var(--primary-gold);
        }
        .sidebar .nav-link i {
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
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
            padding: 0 30px;
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
            padding: 20px 25px;
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
            padding: 30px;
            flex: 1;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-area">
                RaniSahab
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="sidebar-header">Boutique Catalog</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="fas fa-gem"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-folder-open"></i> Categories
                    </a>
                </li>

                <li class="sidebar-header">Sales Operations</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}">
                        <i class="fas fa-ticket-alt"></i> Coupons / Promos
                    </a>
                </li>

                <li class="sidebar-header">Bridal & Studio</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}" href="{{ route('admin.appointments.index') }}">
                        <i class="fas fa-calendar-check"></i> Consultations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.bridal-packages.*') ? 'active' : '' }}" href="{{ route('admin.bridal-packages.index') }}">
                        <i class="fas fa-crown"></i> Bridal Packages
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.designs.*') ? 'active' : '' }}" href="{{ route('admin.designs.index') }}">
                        <i class="fas fa-magic"></i> Custom Designs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.measurements.*') ? 'active' : '' }}" href="{{ route('admin.measurements.index') }}">
                        <i class="fas fa-cut"></i> Fitting Specs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.makeup-bookings.*') ? 'active' : '' }}" href="{{ route('admin.makeup-bookings.index') }}">
                        <i class="fas fa-sparkles"></i> Makeup Bookings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.makeup-services.*') ? 'active' : '' }}" href="{{ route('admin.makeup-services.index') }}">
                        <i class="fas fa-palette"></i> Makeup Services
                    </a>
                </li>
                
                <!-- We will add more links as we build out modules -->
                <li class="nav-item mt-3">
                    <span class="text-uppercase text-muted" style="font-size: 11px; font-weight: 700; letter-spacing: 1px; padding-left: 35px;">System</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                        <i class="fas fa-shield-alt"></i> Roles & Permissions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-user-tie"></i> Admin Users
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div>
                    <!-- Breadcrumb space -->
                    <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <button class="theme-toggle" id="themeToggleBtn">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-reset" id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=c5a880&color=fff" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                            <span class="fw-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const htmlElement = document.documentElement;
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);

        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                themeToggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
