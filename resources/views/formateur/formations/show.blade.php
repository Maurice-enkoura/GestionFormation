<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la formation - Formateur - EduForm</title>

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

        /* Sidebar */
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

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
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

        /* Course Header */
        .course-header {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .course-cover {
            height: 300px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .course-cover-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
            display: flex;
            align-items: flex-end;
            padding: 2rem;
        }

        .course-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .course-meta {
            color: rgba(255,255,255,0.9);
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .course-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            text-align: center;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #10b981;
            margin: 0.5rem 0 0.2rem;
        }

        .stat-card p {
            color: #64748b;
            margin: 0;
            font-size: 0.9rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .stat-icon i {
            font-size: 1.8rem;
            color: #10b981;
        }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .content-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .btn-add {
            background: #10b981;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background: #059669;
            transform: translateY(-2px);
            color: white;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-edit:hover {
            background: #d97706;
            transform: translateY(-2px);
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
            color: white;
        }

        /* Modules */
        .module-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .module-header {
            background: #f8fafc;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .module-header h4 {
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .module-header .badge {
            background: #10b981;
            color: white;
            font-size: 0.8rem;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
        }

        .module-content {
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .contenu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contenu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .contenu-item:last-child {
            border-bottom: none;
        }

        .contenu-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contenu-icon {
            width: 40px;
            height: 40px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contenu-icon i {
            color: #10b981;
            font-size: 1.2rem;
        }

        .contenu-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
        }

        .btn-edit-icon {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .btn-edit-icon:hover {
            background: #f59e0b;
            color: white;
        }

        .btn-delete-icon {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .btn-delete-icon:hover {
            background: #ef4444;
            color: white;
        }

        .btn-view-icon {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .btn-view-icon:hover {
            background: #10b981;
            color: white;
        }

        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
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

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .course-title {
                font-size: 1.8rem;
            }
            
            .course-meta {
                flex-direction: column;
                gap: 0.5rem;
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
                <a href="{{ route('formateur.dashboard') }}">
                    <i class="bi bi-house-door"></i><span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.formations.index') }}" class="active">
                    <i class="bi bi-book"></i><span>Mes formations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.apprenants.index') }}">
                    <i class="bi bi-people"></i><span>Apprenants</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.evaluations.index') }}">
                    <i class="bi bi-star"></i><span>Évaluations</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.messages.index') }}">
                    <i class="bi bi-chat"></i><span>Messages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.profil') }}">
                    <i class="bi bi-person"></i><span>Mon profil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('formateur.parametres') }}">
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
                <h2>Détails de la formation</h2>
                <p>{{ $formation->titre }}</p>
            </div>
            <div class="user-info">
                <div class="notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif">3</span>
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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Course Header -->
        <div class="course-header">
            <div class="course-cover" style="background-image: url('{{ $formation->image_url ?? 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}')">
                <div class="course-cover-overlay">
                    <div>
                        <h1 class="course-title">{{ $formation->titre }}</h1>
                        <div class="course-meta">
                            <span class="course-meta-item">
                                <i class="bi bi-calendar"></i>
                                Début: {{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}
                            </span>
                            <span class="course-meta-item">
                                <i class="bi bi-calendar-check"></i>
                                Fin: {{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}
                            </span>
                            <span class="course-meta-item">
                                <i class="bi bi-people"></i>
                                {{ $stats['total_inscriptions'] ?? 0 }} inscrits
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-files"></i>
                </div>
                <h3>{{ $stats['total_modules'] ?? 0 }}</h3>
                <p>Modules</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-file-text"></i>
                </div>
                <h3>{{ $stats['total_contenus'] ?? 0 }}</h3>
                <p>Contenus</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3>{{ $stats['total_inscriptions'] ?? 0 }}</h3>
                <p>Inscrits</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-star"></i>
                </div>
                <h3>0</h3>
                <p>Note moyenne</p>
            </div>
        </div>

        <!-- Description -->
        <div class="content-card">
            <div class="content-header">
                <h3>Description</h3>
                <div class="d-flex gap-2">
                    <a href="{{ route('formateur.formations.edit', $formation->id) }}" class="btn-edit">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('formateur.formations.destroy', $formation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-secondary" style="line-height: 1.8;">{{ $formation->description ?? 'Aucune description disponible.' }}</p>
        </div>

        <!-- Modules et Contenus -->
        <div class="content-card">
            <div class="content-header">
                <h3>Modules et contenus</h3>
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addModuleModal">
                    <i class="bi bi-plus-circle"></i> Ajouter un module
                </button>
            </div>

            @if(isset($formation->modules) && $formation->modules->count() > 0)
                @foreach($formation->modules as $module)
                <div class="module-item">
                    <div class="module-header" data-bs-toggle="collapse" data-bs-target="#module{{ $module->id }}">
                        <h4>
                            <i class="bi bi-folder2-open text-primary"></i>
                            {{ $module->titre }}
                        </h4>
                        <div>
                            <span class="badge me-2">{{ $module->contenus->count() }} contenu(s)</span>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                    <div id="module{{ $module->id }}" class="collapse show">
                        <div class="module-content">
                            @if($module->description)
                                <p class="text-muted mb-3">{{ $module->description }}</p>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0">Contenus</h6>
                                <button class="btn-add btn-sm" data-bs-toggle="modal" data-bs-target="#addContenuModal{{ $module->id }}">
                                    <i class="bi bi-plus-circle"></i> Ajouter un contenu
                                </button>
                            </div>

                            @if($module->contenus && $module->contenus->count() > 0)
                                <ul class="contenu-list">
                                    @foreach($module->contenus as $contenu)
                                    <li class="contenu-item">
                                        <div class="contenu-info">
                                            <div class="contenu-icon">
                                                <i class="bi bi-{{ $contenu->type == 'video' ? 'play-circle' : 'file-text' }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">{{ $contenu->description ?? 'Contenu' }}</h6>
                                                <small class="text-muted">{{ ucfirst($contenu->type) }}</small>
                                            </div>
                                        </div>
                                        <div class="contenu-actions">
                                            <a href="{{ $contenu->url }}" target="_blank" class="btn-icon btn-view-icon">
                                                <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                            <button class="btn-icon btn-edit-icon" onclick="editContenu({{ $contenu->id }})">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('formateur.contenus.destroy', $contenu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce contenu ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete-icon">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted fst-italic text-center py-3">Aucun contenu dans ce module</p>
                            @endif

                            <div class="mt-3 d-flex justify-content-end gap-2">
                                <button class="btn-edit-icon btn-icon" onclick="editModule({{ $module->id }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('formateur.modules.destroy', $module->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce module ? Tous les contenus associés seront également supprimés.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete-icon">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-folder2-open display-1 text-muted"></i>
                    <h5 class="mt-3">Aucun module créé</h5>
                    <p class="text-muted">Commencez par ajouter un module à votre formation</p>
                    <button class="btn-add mt-2" data-bs-toggle="modal" data-bs-target="#addModuleModal">
                        <i class="bi bi-plus-circle"></i> Ajouter un module
                    </button>
                </div>
            @endif
        </div>
    </main>

    <!-- Modal Ajouter Module -->
    <div class="modal fade" id="addModuleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('formateur.formations.modules.store', $formation->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Titre du module</label>
                            <input type="text" name="titre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (optionnelle)</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modals Ajouter Contenu (un par module) -->
    @if(isset($formation->modules) && $formation->modules->count() > 0)
        @foreach($formation->modules as $module)
        <div class="modal fade" id="addContenuModal{{ $module->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un contenu au module "{{ $module->titre }}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('formateur.contenus.store', $module->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Type de contenu</label>
                                <select name="type" class="form-select" required>
                                    <option value="video">Vidéo</option>
                                    <option value="document">Document</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">URL du contenu</label>
                                <input type="url" name="url" class="form-control" placeholder="https://..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Titre du contenu">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editModule(moduleId) {
            alert('Fonction d\'édition du module à implémenter');
        }

        function editContenu(contenuId) {
            alert('Fonction d\'édition du contenu à implémenter');
        }
    </script>
</body>
</html>