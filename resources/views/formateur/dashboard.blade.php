<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Formateur - EduForm</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* Sidebar améliorée */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: white;
            padding: 1.5rem 1rem;
            transition: all 0.3s ease;
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

        .sidebar-logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            padding: 0.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo span {
            color: #10b981;
            background: rgba(16, 185, 129, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 8px;
            font-size: 1rem;
            margin-left: 0.5rem;
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
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 12px;
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
            width: 3px;
            background: #10b981;
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .sidebar-menu a:hover::before,
        .sidebar-menu a.active::before {
            transform: scaleY(1);
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu a i {
            font-size: 1.3rem;
            width: 24px;
        }

        .sidebar-menu .logout {
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
        }

        .sidebar-menu .logout button {
            color: #f87171 !important;
            background: transparent;
            border: none;
            display: flex;
            align-items: center;
            gap: 1rem;
            width: 100%;
            padding: 0.9rem 1rem;
            font-weight: 500;
        }

        .sidebar-menu .logout button:hover {
            background: rgba(248, 113, 113, 0.1);
            border-radius: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 1.5rem 2rem;
            min-height: 100vh;
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
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        .page-title h2 {
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #0f172a, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-title p {
            color: #64748b;
            margin: 0.2rem 0 0 0;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 2rem;
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
            background: #10b981;
            color: white;
            transform: translateY(-2px);
        }

        .badge-notif {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #10b981;
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            border: 2px solid white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: #10b981;
            color: white;
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
            border: 2px solid white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #10b981, #059669, #047857);
            border-radius: 30px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.2);
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.1); opacity: 0.5; }
        }

        .welcome-card h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .welcome-card p {
            opacity: 0.95;
            margin-bottom: 2rem;
            max-width: 500px;
            font-size: 1.1rem;
        }

        .create-btn {
            background: white;
            color: #10b981;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .create-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            color: #059669;
        }

        .create-btn i {
            font-size: 1.2rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
            border-color: #10b981;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 2rem;
            color: #10b981;
        }

        .stat-info h4 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            line-height: 1.2;
        }

        .stat-info p {
            color: #64748b;
            margin: 0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Section Title */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title h3 i {
            color: #10b981;
        }

        .view-all {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            background: rgba(16, 185, 129, 0.1);
        }

        .view-all:hover {
            gap: 0.8rem;
            background: #10b981;
            color: white;
        }

        /* Formations Grid */
        .formations-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .formation-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        .formation-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 50px rgba(16, 185, 129, 0.15);
            border-color: #10b981;
        }

        .formation-image {
            height: 160px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .formation-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .badge-active {
            background: #10b981;
            color: white;
        }

        .badge-draft {
            background: #f59e0b;
            color: white;
        }

        .formation-content {
            padding: 1.5rem;
        }

        .formation-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.8rem;
            line-height: 1.4;
        }

        .formation-stats {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.2rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .formation-stats span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .formation-stats i {
            color: #10b981;
        }

        .formation-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.2rem;
            border-top: 2px dashed #e2e8f0;
        }

        .btn-edit {
            background: #10b981;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-edit:hover {
            background: #059669;
            transform: translateX(3px);
            color: white;
        }

        .btn-stats {
            color: #64748b;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .btn-stats:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        /* Activity List */
        .activity-list {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            transform: translateX(5px);
        }

        .activity-icon {
            width: 45px;
            height: 45px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon i {
            font-size: 1.3rem;
            color: #10b981;
        }

        .activity-detail {
            flex: 1;
        }

        .activity-detail h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 0.2rem 0;
        }

        .activity-detail p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #94a3b8;
            font-weight: 500;
            padding: 0.3rem 0.8rem;
            background: #f1f5f9;
            border-radius: 50px;
        }

        /* Apprenants List */
        .apprenants-list {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        .apprenant-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .apprenant-item:last-child {
            border-bottom: none;
        }

        .apprenant-item:hover {
            transform: translateX(5px);
        }

        .apprenant-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .apprenant-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }

        .apprenant-details h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0;
        }

        .apprenant-details p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0.2rem 0 0 0;
        }

        .apprenant-progress {
            font-weight: 700;
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
        }

        /* Graphique container */
        .chart-container {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .formations-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 90px;
                padding: 1.5rem 0.5rem;
            }

            .sidebar-logo span,
            .sidebar-menu a span {
                display: none;
            }

            .sidebar-logo {
                justify-content: center;
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
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .formations-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
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
</head>

<body>

<aside class="sidebar">
    <a href="{{ route('formateur.dashboard') }}" class="sidebar-logo">
        Edu<span>Form</span>
    </a>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('formateur.dashboard') }}" class="{{ request()->routeIs('formateur.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="{{ route('formateur.formations.index') }}" class="{{ request()->routeIs('formateur.formations.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i>
                <span>Mes formations</span>
            </a>
        </li>
        <li>
            <a href="{{ route('formateur.apprenants.index') }}" class="{{ request()->routeIs('formateur.apprenants.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Apprenants</span>
            </a>
        </li>
        <li>
            <a href="{{ route('formateur.evaluations.index') }}" class="{{ request()->routeIs('formateur.evaluations.*') ? 'active' : '' }}">
                <i class="bi bi-star"></i>
                <span>Évaluations</span>
            </a>
        </li>
        <li>
            <a href="{{ route('formateur.messages.index') }}" class="{{ request()->routeIs('formateur.messages.*') ? 'active' : '' }}">
                <i class="bi bi-chat"></i>
                <span>Messages</span>
                <span class="badge bg-danger ms-auto">{{ $messagesNonLus ?? 0 }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('formateur.profil') }}" class="{{ request()->routeIs('formateur.profil') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}">
                <i class="bi bi-house-door"></i>
                <span>Accueil</span>
            </a>
        </li>
        <li>
            <a href="{{ route('formateur.parametres') }}" class="{{ request()->routeIs('formateur.parametres') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Paramètres</span>
            </a>
        </li>
        <li class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </li>
    </ul>
</aside>

<main class="main-content">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="page-title">
            <h2>Tableau de bord formateur</h2>
            <p>{{ now()->format('l d F Y') }}</p>
        </div>
        <div class="user-info">
            <div class="notifications">
                <i class="bi bi-bell fs-5"></i>
                <span class="badge-notif">{{ $notificationsCount ?? 3 }}</span>
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nom ?? 'F', 0, 2)) }}
                </div>
                <div>
                    <div class="fw-bold">{{ auth()->user()->nom ?? 'Formateur' }}</div>
                    <div class="small text-secondary">
                        <i class="bi bi-patch-check-fill text-success me-1"></i>
                        Formateur certifié
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="welcome-card">
        <h3>Bonjour, {{ explode(' ', auth()->user()->nom ?? 'Formateur')[0] }} ! 👋</h3>
        <p>
            Vous gérez <strong>{{ $formationsCount ?? 8 }}</strong> formations actives 
            et <strong>{{ $apprenantsCount ?? 245 }}</strong> apprenants.
            Continuez votre excellent travail !
        </p>
        <a href="{{ route('formateur.formations.create') }}" class="create-btn">
            <i class="bi bi-plus-circle"></i> 
            Créer une nouvelle formation
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-book"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['formations'] ?? 8 }}</h4>
                <p>Formations actives</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['apprenants'] ?? 245 }}</h4>
                <p>Apprenants inscrits</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-star"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['note_moyenne'] ?? 4.8 }}</h4>
                <p>Note moyenne /5</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['heures'] ?? 342 }}h</h4>
                <p>Heures enseignées</p>
            </div>
        </div>
    </div>

    <!-- Mes formations -->
    <div class="section-title">
        <h3>
            <i class="bi bi-book"></i>
            Mes formations récentes
        </h3>
        <a href="{{ route('formateur.formations.index') }}" class="view-all">
            Voir tout <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="formations-grid">
        <!-- Formation 1 -->
        <div class="formation-card">
            <div class="formation-image" style="background-image: url('https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                <span class="formation-badge badge-active">Publiée</span>
            </div>
            <div class="formation-content">
                <h4 class="formation-title">Développement Web Full Stack</h4>
                <div class="formation-stats">
                    <span><i class="bi bi-people"></i> 89 apprenants</span>
                    <span><i class="bi bi-star-fill text-warning"></i> 4.9</span>
                </div>
                <div class="formation-footer">
                    <a href="#" class="btn-edit">Modifier</a>
                    <i class="bi bi-bar-chart btn-stats" title="Voir les statistiques"></i>
                </div>
            </div>
        </div>

        <!-- Formation 2 -->
        <div class="formation-card">
            <div class="formation-image" style="background-image: url('https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                <span class="formation-badge badge-active">Publiée</span>
            </div>
            <div class="formation-content">
                <h4 class="formation-title">UI/UX Design Masterclass</h4>
                <div class="formation-stats">
                    <span><i class="bi bi-people"></i> 67 apprenants</span>
                    <span><i class="bi bi-star-fill text-warning"></i> 4.7</span>
                </div>
                <div class="formation-footer">
                    <a href="#" class="btn-edit">Modifier</a>
                    <i class="bi bi-bar-chart btn-stats"></i>
                </div>
            </div>
        </div>

        <!-- Formation 3 -->
        <div class="formation-card">
            <div class="formation-image" style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                <span class="formation-badge badge-draft">Brouillon</span>
            </div>
            <div class="formation-content">
                <h4 class="formation-title">Marketing Digital 360</h4>
                <div class="formation-stats">
                    <span><i class="bi bi-people"></i> 45 apprenants</span>
                    <span><i class="bi bi-star-fill text-warning"></i> 4.5</span>
                </div>
                <div class="formation-footer">
                    <a href="#" class="btn-edit">Continuer</a>
                    <i class="bi bi-bar-chart btn-stats"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Deux colonnes : Activité récente et Apprenants récents -->
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="section-title">
                <h3>
                    <i class="bi bi-clock-history"></i>
                    Activité récente
                </h3>
                <a href="#" class="view-all">Voir tout <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-person-add"></i>
                    </div>
                    <div class="activity-detail">
                        <h4>Nouvel apprenant inscrit</h4>
                        <p>Sofia Alami a rejoint "Développement Web Full Stack"</p>
                    </div>
                    <div class="activity-time">Il y a 2h</div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="activity-detail">
                        <h4>Nouvel avis 5 étoiles</h4>
                        <p>Imane Karim a laissé un avis sur "UI/UX Design"</p>
                    </div>
                    <div class="activity-time">Il y a 1j</div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="activity-detail">
                        <h4>Formation terminée</h4>
                        <p>Mohamed Amine a terminé "UI/UX Design" avec 95%</p>
                    </div>
                    <div class="activity-time">Il y a 3j</div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-chat"></i>
                    </div>
                    <div class="activity-detail">
                        <h4>Nouvelle question</h4>
                        <p>Lina El Amrani a posé une question sur le cours</p>
                    </div>
                    <div class="activity-time">Il y a 5j</div>
                </div>
            </div>

            <!-- Graphique des inscriptions -->
            <div class="chart-container">
                <h4 class="mb-3">Évolution des inscriptions</h4>
                <canvas id="inscriptionsChart" style="width:100%; max-height:300px;"></canvas>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="section-title">
                <h3>
                    <i class="bi bi-people"></i>
                    Apprenants récents
                </h3>
                <a href="#" class="view-all">Voir tout <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="apprenants-list">
                <div class="apprenant-item">
                    <div class="apprenant-info">
                        <div class="apprenant-avatar">SA</div>
                        <div class="apprenant-details">
                            <h4>Sofia Alami</h4>
                            <p>Développement Web</p>
                        </div>
                    </div>
                    <div class="apprenant-progress">75%</div>
                </div>

                <div class="apprenant-item">
                    <div class="apprenant-info">
                        <div class="apprenant-avatar">MA</div>
                        <div class="apprenant-details">
                            <h4>Mohamed Amine</h4>
                            <p>UI/UX Design</p>
                        </div>
                    </div>
                    <div class="apprenant-progress">30%</div>
                </div>

                <div class="apprenant-item">
                    <div class="apprenant-info">
                        <div class="apprenant-avatar">LE</div>
                        <div class="apprenant-details">
                            <h4>Lina El Amrani</h4>
                            <p>Marketing Digital</p>
                        </div>
                    </div>
                    <div class="apprenant-progress">15%</div>
                </div>

                <div class="apprenant-item">
                    <div class="apprenant-info">
                        <div class="apprenant-avatar">IK</div>
                        <div class="apprenant-details">
                            <h4>Imane Karim</h4>
                            <p>Développement Web</p>
                        </div>
                    </div>
                    <div class="apprenant-progress">90%</div>
                </div>

                <div class="apprenant-item">
                    <div class="apprenant-info">
                        <div class="apprenant-avatar">RB</div>
                        <div class="apprenant-details">
                            <h4>Reda Benali</h4>
                            <p>UI/UX Design</p>
                        </div>
                    </div>
                    <div class="apprenant-progress">45%</div>
                </div>
            </div>

            <!-- Derniers avis -->
            <div class="section-title mt-4">
                <h3>
                    <i class="bi bi-star"></i>
                    Derniers avis
                </h3>
            </div>

            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(245, 158, 11, 0.1);">
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="d-flex align-items-center gap-2">
                            <h4 class="mb-0">Imane Karim</h4>
                            <span class="text-warning">★★★★★</span>
                        </div>
                        <p>"Super formation, très complète et bien expliquée"</p>
                    </div>
                    <div class="activity-time">Il y a 1j</div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(245, 158, 11, 0.1);">
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="d-flex align-items-center gap-2">
                            <h4 class="mb-0">Reda Benali</h4>
                            <span class="text-warning">★★★★☆</span>
                        </div>
                        <p>"Très bon cours, mais un peu rapide par moments"</p>
                    </div>
                    <div class="activity-time">Il y a 3j</div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Initialisation du graphique
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Nouveaux inscrits',
                    data: [12, 19, 15, 25, 22, 30],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: 'white',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0'
                        }
                    }
                }
            }
        });
    });

    // Animation du scroll pour la sidebar
    window.addEventListener('scroll', function() {
        const sidebar = document.querySelector('.sidebar');
        if (window.scrollY > 100) {
            sidebar.style.transform = 'translateY(0)';
        }
    });

    // Tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>