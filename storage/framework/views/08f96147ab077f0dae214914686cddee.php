
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard Admin - EduForm'); ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Toastr Notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
            --info: #3b82f6;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 1.5rem 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
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
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 2rem;
            padding-left: 1rem;
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover {
            transform: scale(1.05);
        }

        .sidebar-logo i {
            color: var(--primary);
            margin-right: 0.5rem;
            background: rgba(99, 102, 241, 0.2);
            padding: 0.3rem;
            border-radius: 12px;
        }

        .sidebar-logo span {
            background: linear-gradient(135deg, white, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.3rem;
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
            width: 24px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover i {
            transform: scale(1.1);
            color: var(--primary);
        }

        .sidebar-menu .logout {
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
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

        /* Toggle sidebar */
        .sidebar-toggle {
            position: fixed;
            left: var(--sidebar-width);
            top: 50%;
            transform: translateY(-50%);
            width: 28px;
            height: 60px;
            background: white;
            border-radius: 0 16px 16px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
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
            background: #f1f5f9;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid #eef2f6;
        }

        .page-title h2 {
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            font-size: 1.5rem;
        }

        .page-title p {
            color: #64748b;
            margin: 0.2rem 0 0 0;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .notifications {
            position: relative;
            cursor: pointer;
            width: 45px;
            height: 45px;
            background: #f8fafc;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .notifications:hover {
            background: var(--primary);
        }

        .notifications:hover i {
            color: white;
        }

        .notifications i {
            font-size: 1.3rem;
            color: #64748b;
            transition: all 0.3s ease;
        }

        .badge-notif {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            transition: all 0.3s ease;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .user-profile:hover {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }

        .user-name {
            font-weight: 600;
            color: #0f172a;
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.8rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .user-role i {
            color: var(--primary);
            font-size: 0.6rem;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-overlay.active {
            display: flex;
        }

        .spinner-custom {
            width: 60px;
            height: 60px;
            border: 4px solid #e2e8f0;
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 90px;
            }

            .sidebar-logo span,
            .sidebar-menu a span {
                display: none;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 1rem;
            }

            .sidebar-menu a i {
                margin: 0;
                font-size: 1.5rem;
            }

            .main-content {
                margin-left: 90px;
            }
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

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .user-info {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-custom"></div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-logo">
            <i class="bi bi-mortarboard-fill"></i>
            <span>EduForm Admin</span>
        </a>

        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" data-tooltip="Dashboard">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.utilisateurs.index')); ?>" class="<?php echo e(request()->routeIs('admin.utilisateurs*') ? 'active' : ''); ?>" data-tooltip="Utilisateurs">
                    <i class="bi bi-people"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.formateurs.index')); ?>" class="<?php echo e(request()->routeIs('admin.formateurs*') ? 'active' : ''); ?>" data-tooltip="Formateurs">
                    <i class="bi bi-person-badge"></i>
                    <span>Formateurs</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.formations.index')); ?>" class="<?php echo e(request()->routeIs('admin.formations*') ? 'active' : ''); ?>" data-tooltip="Formations">
                    <i class="bi bi-book"></i>
                    <span>Formations</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.evaluations.index')); ?>" class="<?php echo e(request()->routeIs('admin.evaluations*') ? 'active' : ''); ?>" data-tooltip="Évaluations">
                    <i class="bi bi-star"></i>
                    <span>Évaluations</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.messages.index')); ?>" class="<?php echo e(request()->routeIs('admin.messages*') ? 'active' : ''); ?>" data-tooltip="Messages">
                    <i class="bi bi-chat"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.statistiques')); ?>" class="<?php echo e(request()->routeIs('admin.statistiques*') ? 'active' : ''); ?>" data-tooltip="Statistiques">
                    <i class="bi bi-graph-up"></i>
                    <span>Statistiques</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.parametres')); ?>" class="<?php echo e(request()->routeIs('admin.parametres*') ? 'active' : ''); ?>" data-tooltip="Paramètres">
                    <i class="bi bi-gear"></i>
                    <span>Paramètres</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('home')); ?>" data-tooltip="Retour au site">
                    <i class="bi bi-house-door"></i>
                    <span>Retour au site</span>
                </a>
            </li>

            <!-- Déconnexion -->
            <li class="logout">
                <form method="POST" action="<?php echo e(route('logout')); ?>" id="logoutForm">
                    <?php echo csrf_field(); ?>
                    <button type="submit" data-tooltip="Déconnexion">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Sidebar Toggle -->
    <div class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-chevron-left" id="toggleIcon"></i>
    </div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h2><?php echo $__env->yieldContent('page-title', 'Dashboard Administrateur'); ?></h2>
                <p><i class="bi bi-house-door me-1"></i> <?php echo $__env->yieldContent('page-subtitle', 'Accueil / Dashboard'); ?></p>
            </div>

            <div class="user-info">
                <div class="notifications" id="notificationsBtn" data-tooltip="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif" id="notificationBadge">0</span>
                </div>
                <div class="user-profile" onclick="window.location.href='<?php echo e(route('admin.profil')); ?>'">
                    <div class="user-avatar">
                        <?php echo e(strtoupper(substr(auth()->user()->nom ?? 'A', 0, 2))); ?>

                    </div>
                    <div>
                        <div class="user-name"><?php echo e(auth()->user()->nom ?? 'Admin'); ?></div>
                        <div class="user-role">
                            <i class="bi bi-circle-fill"></i>
                            Administrateur
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Configuration Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
        };

        // Initialisation AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-in-out'
        });

        // Gestion Sidebar
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');

        // État initial
        const sidebarState = localStorage.getItem('adminSidebarCollapsed') === 'true';

        if (sidebarState) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            toggleBtn.classList.add('collapsed');
            toggleIcon.classList.remove('bi-chevron-left');
            toggleIcon.classList.add('bi-chevron-right');
        }

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            toggleBtn.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('bi-chevron-left');
                toggleIcon.classList.add('bi-chevron-right');
                localStorage.setItem('adminSidebarCollapsed', 'true');
            } else {
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
                localStorage.setItem('adminSidebarCollapsed', 'false');
            }
        });

        // Gestion mobile
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');

            document.addEventListener('click', function(e) {
                if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('mobile-visible');
                }
            });

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-visible');
            });
        }

        // Loading Overlay
        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('active');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.remove('active');
        }

        // Gestion déconnexion
        document.getElementById('logoutForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            this.submit();
        });

        // Tooltips
        document.querySelectorAll('[data-tooltip]').forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const tooltip = document.createElement('div');
                tooltip.className = 'custom-tooltip';
                tooltip.textContent = this.dataset.tooltip;
                document.body.appendChild(tooltip);

                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';

                this.addEventListener('mouseleave', function() {
                    tooltip.remove();
                });
            });
        });

        // Masquer loading après chargement
        window.addEventListener('load', hideLoading);
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/layouts/admin.blade.php ENDPATH**/ ?>