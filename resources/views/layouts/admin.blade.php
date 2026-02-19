
{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - EduForm Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1a2639 100%);
        }
        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 10px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }
        .sidebar .nav-link i {
            margin-right: 0.8rem;
        }
        .main-content {
            padding: 2rem;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border-radius: 15px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <div class="p-3">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-shield-lock-fill me-2"></i>EduForm Admin
                    </h4>
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}" 
                           href="{{ route('admin.utilisateurs.index') }}">
                            <i class="bi bi-people"></i> Utilisateurs
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.formations.*') ? 'active' : '' }}" 
                           href="{{ route('admin.formations.index') }}">
                            <i class="bi bi-book"></i> Formations
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.formateurs.*') ? 'active' : '' }}" 
                           href="{{ route('admin.formateurs.index') }}">
                            <i class="bi bi-person-badge"></i> Formateurs
                        </a>
                        <hr class="bg-secondary">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-danger">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0">
                <div class="main-content">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
