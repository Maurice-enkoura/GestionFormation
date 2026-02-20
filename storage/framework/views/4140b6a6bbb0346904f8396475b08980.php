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

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            opacity: 0.9;
            margin-bottom: 1.5rem;
            max-width: 500px;
        }

        .create-btn {
            background: white;
            color: #10b981;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 1.8rem;
            color: #10b981;
        }

        .stat-info h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .stat-info p {
            color: #64748b;
            margin: 0;
            font-size: 0.9rem;
        }

        /* Section Title */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .view-all {
            color: #10b981;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .view-all:hover {
            gap: 0.5rem;
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
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .formation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .formation-image {
            height: 140px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .formation-content {
            padding: 1.2rem;
        }

        .formation-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .formation-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .formation-stats span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .formation-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn-edit {
            background: #10b981;
            color: white;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Activity List */
        .activity-list {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon i {
            color: #10b981;
        }

        .activity-detail {
            flex: 1;
        }

        .activity-detail h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.2rem 0;
        }

        .activity-detail p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Responsive */
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

            .formations-grid {
                grid-template-columns: repeat(2, 1fr);
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
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 16px;
        }

        .empty-state i {
            font-size: 4rem;
            color: #10b981;
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="<?php echo e(route('formateur.dashboard')); ?>" class="sidebar-logo">Edu<span>Form</span></a>
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo e(route('formateur.dashboard')); ?>" class="active">
                    <i class="bi bi-house-door"></i><span>Tableau de bord</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('formateur.formations.index')); ?>">
                    <i class="bi bi-book"></i><span>Mes formations</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('formateur.apprenants.index')); ?>">
                    <i class="bi bi-people"></i><span>Apprenants</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('formateur.evaluations.index')); ?>">
                    <i class="bi bi-star"></i><span>Évaluations</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('formateur.messages.index')); ?>">
                    <i class="bi bi-chat"></i><span>Messages</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('formateur.profil')); ?>">
                    <i class="bi bi-person"></i><span>Mon profil</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('formateur.parametres')); ?>">
                    <i class="bi bi-gear"></i><span>Paramètres</span>
                </a>
            </li>
            <li class="logout">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
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
                <h2>Tableau de bord</h2>
                <p>Bienvenue sur votre espace formateur</p>
            </div>
            <div class="user-info">
                <div class="notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif">3</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo e(strtoupper(substr($formateur->nom, 0, 2))); ?>

                    </div>
                    <div>
                        <div class="fw-bold"><?php echo e($formateur->nom); ?></div>
                        <div class="text-secondary small"><?php echo e(ucfirst($formateur->role)); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="welcome-card">
            <h3>Bonjour, <?php echo e(explode(' ', $formateur->nom)[0]); ?> ! 👋</h3>
            <p>
                Vous avez <?php echo e($stats['total_formations']); ?> formation(s) active(s)
                et <?php echo e($stats['total_apprenants']); ?> apprenant(s) au total.
            </p>
            <a href="<?php echo e(route('formateur.formations.create')); ?>" class="create-btn">
                <i class="bi bi-plus-circle"></i> Créer une formation
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-info">
                    <h4><?php echo e($stats['total_formations']); ?></h4>
                    <p>Formations</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-info">
                    <h4><?php echo e($stats['total_apprenants']); ?></h4>
                    <p>Apprenants</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="stat-info">
                    <h4>0</h4>
                    <p>Note moyenne</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-info">
                    <h4>0</h4>
                    <p>Heures enseignées</p>
                </div>
            </div>
        </div>

        <!-- Mes formations -->
        <div class="section-title">
            <h3>Mes formations</h3>
            <a href="<?php echo e(route('formateur.formations.index')); ?>" class="view-all">
                Voir tout <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="formations-grid">
            <?php
                $formations = $formateur->formations()->withCount('inscriptions')->latest()->take(3)->get();
            ?>

            <?php $__empty_1 = true; $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="formation-card">
                    <div class="formation-image" style="background-image: url('<?php echo e($formation->image_url ?? 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>')">
                    </div>
                    <div class="formation-content">
                        <h4 class="formation-title"><?php echo e($formation->titre); ?></h4>
                        <div class="formation-stats">
                            <span><i class="bi bi-people"></i> <?php echo e($formation->inscriptions_count ?? 0); ?></span>
                            <span><i class="bi bi-star-fill text-warning"></i> 0</span>
                        </div>
                        <div class="formation-footer">
                            <a href="<?php echo e(route('formateur.formations.edit', $formation->id)); ?>" class="btn-edit">Modifier</a>
                            <small class="text-muted"><?php echo e($formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : ''); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-book"></i>
                        <h5 class="mt-3">Aucune formation</h5>
                        <p class="text-muted">Commencez par créer votre première formation</p>
                        <a href="<?php echo e(route('formateur.formations.create')); ?>" class="btn btn-primary mt-2">
                            Créer une formation
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Activité récente -->
        <div class="row">
            <div class="col-md-7">
                <div class="section-title">
                    <h3>Activité récente</h3>
                    <a href="#" class="view-all">Voir tout <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="bi bi-person-add"></i>
                        </div>
                        <div class="activity-detail">
                            <h4>Bienvenue sur EduForm</h4>
                            <p>Commencez à créer vos formations</p>
                        </div>
                        <div class="activity-time">Maintenant</div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="section-title">
                    <h3>Conseils</h3>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <div class="activity-detail">
                            <h4>Créez votre première formation</h4>
                            <p>Partagez votre expertise avec vos apprenants</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/index.blade.php ENDPATH**/ ?>