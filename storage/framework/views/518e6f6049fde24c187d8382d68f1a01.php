<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Formateur - EduForm</title>

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

        /* Settings Card */
        .settings-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .settings-header {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .settings-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .settings-header p {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0.3rem 0 0 0;
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

        .btn-outline-secondary {
            border: 2px solid #e2e8f0;
            color: #64748b;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #f8fafc;
            color: #1e293b;
        }

        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .preference-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .preference-item:last-child {
            border-bottom: none;
        }

        .form-switch {
            padding-left: 2.5rem;
        }

        .form-switch .form-check-input {
            width: 3rem;
            height: 1.5rem;
        }

        .form-switch .form-check-input:checked {
            background-color: #10b981;
            border-color: #10b981;
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
        <a href="<?php echo e(route('formateur.dashboard')); ?>" class="sidebar-logo">Edu<span>Form</span></a>
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo e(route('formateur.dashboard')); ?>">
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
                <a href="<?php echo e(route('formateur.parametres')); ?>" class="active">
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
                <h2>Paramètres</h2>
                <p>Gérez vos préférences et votre sécurité</p>
            </div>
            <div class="user-info">
                <div class="notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif">3</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo e(strtoupper(substr(auth()->user()->nom, 0, 2))); ?>

                    </div>
                    <div>
                        <div class="fw-bold"><?php echo e(auth()->user()->nom); ?></div>
                        <div class="text-secondary small"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Password Settings -->
        <div class="settings-card">
            <div class="settings-header">
                <h3>Changer le mot de passe</h3>
                <p>Mettez à jour votre mot de passe régulièrement pour plus de sécurité</p>
            </div>

            <form action="<?php echo e(route('formateur.parametres.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" 
                               name="current_password" 
                               class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               required>
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" 
                               name="new_password" 
                               class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               required>
                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" 
                               name="new_password_confirmation" 
                               class="form-control" 
                               required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn-save">
                            <i class="bi bi-key me-2"></i>Changer le mot de passe
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preferences -->
        <div class="settings-card">
            <div class="settings-header">
                <h3>Préférences</h3>
                <p>Personnalisez votre expérience sur la plateforme</p>
            </div>

            <div class="preference-item">
                <div>
                    <h6 class="fw-bold mb-1">Notifications par email</h6>
                    <p class="text-muted small mb-0">Recevoir des notifications par email pour les nouvelles inscriptions</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="emailNotif" checked disabled>
                </div>
            </div>

            <div class="preference-item">
                <div>
                    <h6 class="fw-bold mb-1">Rappels de cours</h6>
                    <p class="text-muted small mb-0">Recevoir des rappels avant le début de vos formations</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="courseReminders" checked disabled>
                </div>
            </div>

            <div class="preference-item">
                <div>
                    <h6 class="fw-bold mb-1">Newsletter</h6>
                    <p class="text-muted small mb-0">Recevoir la newsletter mensuelle d'EduForm</p>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="newsletter" disabled>
                </div>
            </div>

            <div class="mt-3">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Ces options seront bientôt disponibles
                </small>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/parametres/index.blade.php ENDPATH**/ ?>