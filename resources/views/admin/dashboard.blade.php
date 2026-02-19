{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur - EduForm</title>
    
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
            --dark: #0f172a;
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f5fa;
            overflow-x: hidden;
        }

        /* Sidebar */
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
        .sidebar.collapsed .sidebar-menu a span {
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
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.05);
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
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            width: 100%;
            border-radius: 14px;
            font-weight: 500;
            cursor: pointer;
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

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        }

        .page-title h2 {
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            background: white;
            border: 1px solid #e2e8f0;
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
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.8rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            gap: 1.2rem;
            border: 1px solid #eef2f6;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 2rem;
            color: var(--primary);
        }

        .stat-info h4 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .stat-info p {
            color: var(--gray);
            margin: 0;
        }

        /* Dashboard Cards pour les rôles */
        .role-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.8rem;
            margin: 2rem 0;
        }

        .role-card {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #eef2f6;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 40px rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
        }

        .role-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .role-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .role-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .role-card p {
            color: var(--gray);
            margin: 0;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .quick-actions h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .btn-action {
            padding: 1rem;
            border-radius: 12px;
            text-decoration: none;
            color: var(--dark);
            background: #f8fafc;
            border: 1px solid #eef2f6;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-action:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateY(-3px);
        }

        /* Tables */
        .table-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
            font-weight: 600;
            color: var(--gray);
            font-size: 0.9rem;
            padding: 1rem;
            background: #f8fafc;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .badge-role {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-role.admin {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .badge-role.formateur {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .badge-role.apprenant {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        @media (max-width: 768px) {
            .stats-grid,
            .role-cards {
                grid-template-columns: 1fr;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <i class="bi bi-shield-lock-fill"></i>
        <span>EduForm Admin</span>
    </a>
    
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="bi bi-speedometer2"></i>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.utilisateurs.index') }}">
                <i class="bi bi-people"></i>
                <span>Utilisateurs</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.formations.index') }}">
                <i class="bi bi-book"></i>
                <span>Formations</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.formateurs.index') }}">
                <i class="bi bi-person-badge"></i>
                <span>Formateurs</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}" onclick="event.preventDefault(); showRoleSelector();">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                <span>Voir les pages</span>
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

<!-- Sidebar Toggle -->
<div class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
    <i class="bi bi-chevron-left" id="toggleIcon"></i>
</div>

<!-- Main Content -->
<main class="main-content" id="mainContent">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="page-title">
            <h2>Tableau de bord administrateur</h2>
            <p>Bienvenue sur votre espace d'administration</p>
        </div>
        
        <div class="user-info">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nom, 0, 2)) }}
                </div>
                <div>
                    <div class="user-name">{{ auth()->user()->nom }}</div>
                    <small class="text-muted">Administrateur</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['total_users'] ?? 0 }}</h4>
                <p>Utilisateurs totaux</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-book"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['total_formations'] ?? 0 }}</h4>
                <p>Formations</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-person-badge"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['total_formateurs'] ?? 0 }}</h4>
                <p>Formateurs</p>
            </div>
        </div>
    </div>

    <!-- Sélecteur de pages rôles (caché par défaut) -->
    <div id="roleSelector" style="display: none;">
        <h3 class="mb-3">Choisissez une vue :</h3>
        <div class="role-cards">
            <a href="{{ route('admin.dashboard') }}" class="role-card">
                <div class="role-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h3>Admin</h3>
                <p>Dashboard administrateur</p>
            </a>
            
            <a href="{{ route('formateur.dashboard') }}" class="role-card">
                <div class="role-icon" style="background: linear-gradient(135deg, #8b5cf6, #6366f1);">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h3>Formateur</h3>
                <p>Dashboard formateur</p>
            </a>
            
            <a href="{{ route('apprenant.dashboard') }}" class="role-card">
                <div class="role-icon" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                    <i class="bi bi-person"></i>
                </div>
                <h3>Apprenant</h3>
                <p>Dashboard apprenant</p>
            </a>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="quick-actions">
        <h3><i class="bi bi-lightning-charge me-2" style="color: var(--primary);"></i>Actions rapides</h3>
        <div class="action-buttons">
            <a href="{{ route('admin.utilisateurs.create') }}" class="btn-action">
                <i class="bi bi-person-plus me-2"></i>Ajouter un utilisateur
            </a>
            <a href="{{ route('admin.formations.create') }}" class="btn-action">
                <i class="bi bi-plus-circle me-2"></i>Créer une formation
            </a>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-action">
                <i class="bi bi-person-badge me-2"></i>Gérer formateurs
            </a>
        </div>
    </div>

    <!-- Derniers utilisateurs -->
    <div class="table-card">
        <div class="table-header">
            <h4><i class="bi bi-people me-2" style="color: var(--primary);"></i>Derniers utilisateurs</h4>
            <a href="{{ route('admin.utilisateurs.index') }}" class="view-all">
                Voir tout <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($derniersUtilisateurs ?? [] as $user)
                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge-role {{ $user->role }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.utilisateurs.show', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.utilisateurs.edit', $user) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun utilisateur</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dernières formations -->
    <div class="table-card">
        <div class="table-header">
            <h4><i class="bi bi-book me-2" style="color: var(--primary);"></i>Dernières formations</h4>
            <a href="{{ route('admin.formations.index') }}" class="view-all">
                Voir tout <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Formateur</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dernieresFormations ?? [] as $formation)
                    <tr>
                        <td>{{ $formation->titre }}</td>
                        <td>{{ $formation->formateur->nom ?? 'Non assigné' }}</td>
                        <td>{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.formations.show', $formation) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.formations.edit', $formation) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune formation</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();

    // Toggle sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');
        
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
        toggleBtn.classList.toggle('collapsed');
        
        if (sidebar.classList.contains('collapsed')) {
            toggleIcon.classList.remove('bi-chevron-left');
            toggleIcon.classList.add('bi-chevron-right');
        } else {
            toggleIcon.classList.remove('bi-chevron-right');
            toggleIcon.classList.add('bi-chevron-left');
        }
    }

    // Afficher le sélecteur de rôles
    function showRoleSelector() {
        const selector = document.getElementById('roleSelector');
        if (selector.style.display === 'none') {
            selector.style.display = 'block';
            selector.scrollIntoView({ behavior: 'smooth' });
        } else {
            selector.style.display = 'none';
        }
    }
</script>
</body>
</html>