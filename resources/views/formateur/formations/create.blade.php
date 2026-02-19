<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une formation - Formateur - EduForm</title>

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

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .form-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            padding: 0.8rem 1.2rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            outline: none;
        }

        .btn-save {
            background: #10b981;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: transparent;
            color: #64748b;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            color: #1e293b;
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
                <h2>Créer une formation</h2>
                <p>Partagez votre expertise avec vos apprenants</p>
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

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-header">
                <h3>Informations de la formation</h3>
            </div>

            <form action="{{ route('formateur.formations.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Titre de la formation</label>
                        <input type="text" 
                               name="titre" 
                               class="form-control @error('titre') is-invalid @enderror" 
                               value="{{ old('titre') }}" 
                               placeholder="Ex: Développement Web Full Stack"
                               required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="5" 
                                  placeholder="Décrivez le contenu de votre formation, les objectifs, les prérequis..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date de début</label>
                        <input type="date" 
                               name="date_debut" 
                               class="form-control @error('date_debut') is-invalid @enderror" 
                               value="{{ old('date_debut') }}"
                               required>
                        @error('date_debut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date de fin</label>
                        <input type="date" 
                               name="date_fin" 
                               class="form-control @error('date_fin') is-invalid @enderror" 
                               value="{{ old('date_fin') }}"
                               required>
                        @error('date_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Image URL (optionnel)</label>
                        <input type="url" 
                               name="image_url" 
                               class="form-control @error('image_url') is-invalid @enderror" 
                               value="{{ old('image_url') }}" 
                               placeholder="https://example.com/image.jpg">
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Laissez vide pour utiliser une image par défaut</small>
                    </div>

                    <div class="col-12">
                        <hr>
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('formateur.formations.index') }}" class="btn-cancel">
                                Annuler
                            </a>
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-circle me-2"></i>Créer la formation
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>