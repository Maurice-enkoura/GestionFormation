{{-- resources/views/layouts/formateur.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Formateur - EduForm</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fc;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: white;
            padding: 2rem 1rem;
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 2rem;
            padding-left: 1rem;
        }

        .sidebar-logo span {
            color: #0d6efd;
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
            padding: 1rem;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu a i {
            font-size: 1.3rem;
        }

        .sidebar-menu .logout {
            margin-top: 3rem;
        }

        .sidebar-menu .logout button {
            background: transparent;
            border: none;
            color: #ef4444;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            width: 100%;
            text-align: left;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .sidebar-menu .logout button:hover {
            background: rgba(239, 68, 68, 0.1);
            transform: translateX(5px);
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 2rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        }

        .page-title h2 {
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            font-size: 1.5rem;
        }

        .page-title p {
            color: #64748b;
            margin: 0;
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
        }

        .badge-notif {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #0d6efd;
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-logo span {
                display: none;
            }

            .sidebar-menu a span {
                display: none;
            }

            .main-content {
                margin-left: 80px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('formateur.dashboard') }}" class="sidebar-logo">Edu<span>Form</span></a>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('formateur.dashboard') }}" class="{{ request()->routeIs('formateur.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i><span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.formations.index') }}" class="{{ request()->routeIs('formateur.formations.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i><span>Mes formations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.apprenants.index') }}" class="{{ request()->routeIs('formateur.apprenants.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i><span>Apprenants</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.evaluations.index') }}" class="{{ request()->routeIs('formateur.evaluations.*') ? 'active' : '' }}">
                    <i class="bi bi-star"></i><span>Évaluations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.messages.index') }}" class="{{ request()->routeIs('formateur.messages.*') ? 'active' : '' }}">
                    <i class="bi bi-chat"></i><span>Messages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.profil') }}" class="{{ request()->routeIs('formateur.profil') ? 'active' : '' }}">
                    <i class="bi bi-person"></i><span>Mon profil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.parametres') }}" class="{{ request()->routeIs('formateur.parametres') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i><span>Paramètres</span>
                </a>
            </li>
            <li class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h2>@yield('page-title', 'Tableau de bord')</h2>
                <p>@yield('page-subtitle', 'Bienvenue sur votre espace formateur')</p>
            </div>
            
            <div class="user-info">
                <div class="notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif">0</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->nom, 0, 2)) }}
                    </div>
                    <div>
                        <div class="fw-bold">{{ auth()->user()->nom }}</div>
                        <div class="text-secondary small">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>