<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Gestion Stages SN')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .flag-stripe {
            background: linear-gradient(to right, #00853E 33%, #FDEF42 33%, #FDEF42 66%, #E31B23 66%);
            height: 3px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }
        
        .admin-sidebar {
            position: fixed;
            top: 3px;
            left: 0;
            bottom: 0;
            width: 260px;
            background: #0B1E33;
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
            padding-top: 20px;
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #1a365d;
            border-radius: 10px;
        }
        
        .admin-sidebar .logo {
            padding: 0 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        
        .admin-sidebar .logo h2 {
            font-size: 20px;
            font-weight: 800;
            color: #10B981;
        }
        
        .admin-sidebar .logo span {
            color: #FCD34D;
        }
        
        .admin-sidebar .logo small {
            display: block;
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            font-weight: 300;
        }
        
        .admin-sidebar .nav-section {
            padding: 20px 16px 8px;
            font-size: 11px;
            font-weight: 600;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .admin-sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            margin: 2px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
        }
        
        .admin-sidebar .nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }
        
        .admin-sidebar .nav-item.active {
            background: rgba(16,185,129,0.15);
            color: #10B981;
        }
        
        .admin-sidebar .nav-item.active i {
            color: #10B981;
        }
        
        .admin-sidebar .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            color: rgba(255,255,255,0.4);
        }
        
        .admin-sidebar .nav-item .badge {
            margin-left: auto;
            background: #10B981;
            color: white;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .admin-sidebar .user-card {
            padding: 16px 20px;
            margin: 20px 12px 12px;
            background: rgba(255,255,255,0.04);
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.06);
        }
        
        .admin-sidebar .user-card .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10B981, #059669);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
        }
        
        .admin-sidebar .user-card .user-name {
            font-weight: 600;
            font-size: 14px;
        }
        
        .admin-sidebar .user-card .user-role {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
        }
        
        .admin-main {
            margin-left: 260px;
            padding-top: 3px;
            min-height: 100vh;
            background: #F1F5F9;
        }
        
        .admin-main .admin-header {
            background: white;
            padding: 16px 32px;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 3px;
            z-index: 999;
        }
        
        .admin-main .admin-header .page-title {
            font-size: 18px;
            font-weight: 700;
            color: #0B1E33;
        }
        
        .admin-main .admin-header .page-title small {
            font-weight: 400;
            font-size: 13px;
            color: #6B7280;
            margin-left: 8px;
        }
        
        .admin-main .admin-content {
            padding: 28px 32px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            .admin-sidebar.open {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .admin-main .admin-header {
                padding: 12px 16px;
            }
            .admin-main .admin-content {
                padding: 16px;
            }
            .sidebar-toggle {
                display: block !important;
            }
        }
        
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #0B1E33;
            cursor: pointer;
        }
        
        /* Overlay mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }
        .sidebar-overlay.active {
            display: block;
        }
        
        .admin-card {
            transition: all 0.3s ease;
        }
        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px -8px rgba(0,0,0,0.08);
        }
        
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px -8px rgba(0,0,0,0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in:nth-child(1) { animation-delay: 0.05s; }
        .fade-in:nth-child(2) { animation-delay: 0.1s; }
        .fade-in:nth-child(3) { animation-delay: 0.15s; }
        .fade-in:nth-child(4) { animation-delay: 0.2s; }
    </style>
</head>
<body>
    <div class="flag-stripe"></div>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar Admin -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="logo">
            <h2>Gestion <span>Stages</span></h2>
            <small>🇸🇳 Sénégal • Administration</small>
        </div>

        <div class="user-card">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role"><i class="fas fa-crown me-1" style="color:#FCD34D;"></i> Administrateur</div>
                </div>
            </div>
        </div>

        <div class="nav-section">Navigation</div>
        
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Tableau de bord
        </a>
        
        <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Utilisateurs
            <span class="badge">{{ \App\Models\User::count() }}</span>
        </a>
        
        <a href="{{ route('admin.entreprises') }}" class="nav-item {{ request()->routeIs('admin.entreprises*') ? 'active' : '' }}">
            <i class="fas fa-building"></i> Entreprises
            <span class="badge">{{ \App\Models\Entreprise::count() }}</span>
        </a>
        
        <a href="{{ route('admin.stages') }}" class="nav-item {{ request()->routeIs('admin.stages*') ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i> Stages
            <span class="badge">{{ \App\Models\Stage::count() }}</span>
        </a>
        
        <a href="{{ route('admin.candidatures') }}" class="nav-item {{ request()->routeIs('admin.candidatures*') ? 'active' : '' }}">
            <i class="fas fa-file-signature"></i> Candidatures
            <span class="badge">{{ \App\Models\Candidature::count() }}</span>
        </a>

        <div class="nav-section" style="margin-top:20px;">Compte</div>
        
        <a href="{{ route('dashboard') }}" class="nav-item">
            <i class="fas fa-arrow-left"></i> Retour au site
        </a>
        
        <form method="POST" action="{{ route('logout') }}" style="margin: 4px 12px;">
            @csrf
            <button type="submit" class="nav-item" style="background:none;border:none;width:100%;cursor:pointer;color:rgba(255,255,255,0.6);">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </aside>
<a href="{{ route('admin.entreprises.create') }}" class="nav-item">
    <i class="fas fa-plus-circle"></i> Ajouter une entreprise
</a>
    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title">
                    @yield('page-title', 'Tableau de bord')
                    <small>@yield('page-subtitle', 'Administration')</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span style="font-size:13px;color:#6B7280;">
                    <i class="far fa-calendar-alt me-1"></i> {{ now()->format('d/m/Y H:i') }}
                </span>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle (mobile)
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    overlay.classList.toggle('active');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                });
            }

            // Auto-close sidebar on resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>