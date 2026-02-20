{{-- resources/views/layouts/apprenant.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Apprenant - EduForm')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f5fa;
            overflow-x: hidden;
        }

        /* Sidebar moderne */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark) 0%, #1a2639 100%);
            color: white;
            padding: 1.5rem 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .sidebar-logo span,
        .sidebar.collapsed .sidebar-menu a span,
        .sidebar.collapsed .user-details {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 1rem;
        }

        .sidebar.collapsed .sidebar-menu a i {
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar.collapsed .sidebar-logo {
            text-align: center;
            padding-left: 0;
        }

        .sidebar-logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, white, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            display: block;
            margin-bottom: 2.5rem;
            padding-left: 1rem;
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover {
            transform: scale(1.05);
        }

        .sidebar-logo i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-menu a:hover::before,
        .sidebar-menu a.active::before {
            transform: scaleY(1);
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu a i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover i {
            transform: scale(1.1);
        }

        .sidebar-menu .logout {
            margin-top: 3rem;
        }

        .sidebar-menu .logout button {
            background: transparent;
            border: none;
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            width: 100%;
            border-radius: 14px;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .sidebar-menu .logout button:hover {
            background: rgba(239, 68, 68, 0.1);
            transform: translateX(5px);
        }

        /* Toggle sidebar button */
        .sidebar-toggle {
            position: fixed;
            left: var(--sidebar-width);
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 60px;
            background: white;
            border-radius: 0 30px 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            z-index: 1001;
            transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
            border-left: none;
        }

        .sidebar-toggle.collapsed {
            left: var(--sidebar-collapsed-width);
        }

        .sidebar-toggle i {
            color: var(--primary);
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .sidebar-toggle:hover i {
            transform: scale(1.2);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Bar moderne */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .page-title h2 {
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            font-size: 1.8rem;
        }

        .page-title p {
            color: var(--gray);
            margin: 0;
            font-size: 0.95rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .notifications {
            position: relative;
            cursor: pointer;
        }

        .notifications i {
            font-size: 1.5rem;
            color: var(--gray);
            transition: all 0.3s ease;
        }

        .notifications:hover i {
            color: var(--primary);
            transform: rotate(15deg);
        }

        .badge-notif {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            transition: all 0.3s ease;
            background: white;
            border: 1px solid #e2e8f0;
        }

        .user-profile:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.1);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .user-name {
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .user-role i {
            color: var(--success);
            font-size: 0.6rem;
        }

        /* Cards et autres styles réutilisables */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            border-radius: 16px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .activity-item {
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            transform: translateX(10px);
        }

        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            border-radius: 50px;
            border: none;
            color: var(--gray);
            padding: 0.5rem 1rem;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('apprenant.dashboard') }}" class="sidebar-logo">
            <i class="bi bi-mortarboard-fill"></i>
            <span>EduForm</span>
        </a>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('apprenant.dashboard') }}" class="{{ request()->routeIs('apprenant.dashboard') ? 'active' : '' }}" data-tooltip="Tableau de bord">
                    <i class="bi bi-speedometer2"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('apprenant.formations') }}" class="{{ request()->routeIs('apprenant.formations') || request()->routeIs('apprenant.formation.show') ? 'active' : '' }}" data-tooltip="Mes formations">
                    <i class="bi bi-book"></i>
                    <span>Mes formations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('apprenant.continuer') }}" data-tooltip="Continuer">
                    <i class="bi bi-play-circle"></i>
                    <span>Continuer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('apprenant.ressources') }}" class="{{ request()->routeIs('apprenant.ressources') ? 'active' : '' }}" data-tooltip="Ressources">
                    <i class="bi bi-download"></i>
                    <span>Ressources</span>
                </a>
            </li>
              <li>
        <a href="{{ route('apprenant.evaluations.index') }}" class="{{ request()->routeIs('apprenant.evaluations*') ? 'active' : '' }}" data-tooltip="Mes évaluations">
            <i class="bi bi-star"></i>
            <span>Mes évaluations</span>
        </a>
    </li>
    
            <li>
                <a href="{{ route('apprenant.messages.index') }}" class="{{ request()->routeIs('apprenant.messages*') ? 'active' : '' }}" data-tooltip="Messages">
                    <i class="bi bi-envelope"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('apprenant.profil') }}" class="{{ request()->routeIs('apprenant.profil') ? 'active' : '' }}" data-tooltip="Mon profil">
                    <i class="bi bi-person"></i>
                    <span>Mon profil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('apprenant.parametres') }}" class="{{ request()->routeIs('apprenant.parametres') ? 'active' : '' }}" data-tooltip="Paramètres">
                    <i class="bi bi-gear"></i>
                    <span>Paramètres</span>
                </a>
            </li>

            <!-- Déconnexion sécurisée -->
            <li class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" data-tooltip="Déconnexion">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Sidebar Toggle Button -->
    <div class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-chevron-left" id="toggleIcon"></i>
    </div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h2>@yield('page-title', 'Tableau de bord')</h2>
                <p><i class="bi bi-house-door me-1"></i> @yield('page-subtitle', 'Accueil / Dashboard')</p>
            </div>

            <div class="user-info">
                <div class="notifications" data-tooltip="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif" id="notificationBadge">3</span>
                </div>
                <div class="user-profile" onclick="window.location.href='{{ route('apprenant.profil') }}'">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->nom, 0, 2)) }}
                    </div>
                    <div>
                        <div class="user-name">{{ auth()->user()->nom }}</div>
                        <div class="user-role">
                            <i class="bi bi-circle-fill"></i>
                            {{ ucfirst(auth()->user()->role) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialisation AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-in-out'
        });

        // Gestion de la sidebar
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');

        // État initial basé sur le localStorage
        const sidebarState = localStorage.getItem('sidebarCollapsed') === 'true';

        if (sidebarState) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            toggleBtn.classList.add('collapsed');
            toggleIcon.classList.remove('bi-chevron-left');
            toggleIcon.classList.add('bi-chevron-right');
        }

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            toggleBtn.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('bi-chevron-left');
                toggleIcon.classList.add('bi-chevron-right');
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        }

        // Gestion responsive
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                if (!sidebar.classList.contains('collapsed')) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            } else {
                const savedState = localStorage.getItem('sidebarCollapsed') === 'true';
                if (savedState) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }
        });
    </script>
</body>

</html>