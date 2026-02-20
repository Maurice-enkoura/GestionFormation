<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Formateur - EduForm</title>

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

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .profile-header {
            background: linear-gradient(135deg, #10b981, #059669);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #10b981;
            font-weight: 700;
            font-size: 3rem;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profile-body {
            padding: 2rem;
        }

        .info-group {
            margin-bottom: 1.5rem;
        }

        .info-label {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.1rem;
        }

        .stats-card {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 16px;
            text-align: center;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #10b981;
        }

        .stats-label {
            color: #64748b;
            font-size: 0.9rem;
        }

        .btn-edit {
            background: #10b981;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background: #059669;
            transform: translateY(-2px);
            color: white;
        }

        .btn-outline-edit {
            background: transparent;
            color: #10b981;
            border: 2px solid #10b981;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-edit:hover {
            background: #10b981;
            color: white;
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

            .profile-header {
                padding: 2rem 1rem;
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
                <a href="<?php echo e(route('formateur.profil')); ?>" class="active">
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
                <h2>Mon profil</h2>
                <p>Gérez vos informations personnelles</p>
            </div>
            <div class="user-info">
                <div class="notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif">3</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo e(strtoupper(substr($user->nom, 0, 2))); ?>

                    </div>
                    <div>
                        <div class="fw-bold"><?php echo e($user->nom); ?></div>
                        <div class="text-secondary small"><?php echo e(ucfirst($user->role)); ?></div>
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

        <!-- Profile Content -->
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <?php echo e(strtoupper(substr($user->nom, 0, 2))); ?>

                        </div>
                        <h4><?php echo e($user->nom); ?></h4>
                        <p class="mb-0"><?php echo e(ucfirst($user->role)); ?></p>
                    </div>
                    <div class="profile-body">
                        <div class="info-group">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?php echo e($user->email); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Téléphone</div>
                            <div class="info-value"><?php echo e($user->telephone ?? 'Non renseigné'); ?></div>
                        </div>
                        <div class="info-group">
                            <div class="info-label">Membre depuis</div>
                            <div class="info-value"><?php echo e($user->created_at->format('d/m/Y')); ?></div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-number"><?php echo e($stats['formations'] ?? 0); ?></div>
                                    <div class="stats-label">Formations</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-number"><?php echo e($stats['apprenants'] ?? 0); ?></div>
                                    <div class="stats-label">Apprenants</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-card">
                    <div class="profile-body">
                        <h4 class="mb-4">Modifier mes informations</h4>
                        
                        <form action="<?php echo e(route('formateur.profil.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nom complet</label>
                                    <input type="text" 
                                           name="nom" 
                                           class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('nom', $user->nom)); ?>" 
                                           required>
                                    <?php $__errorArgs = ['nom'];
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

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('email', $user->email)); ?>" 
                                           required>
                                    <?php $__errorArgs = ['email'];
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

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Téléphone</label>
                                    <input type="text" 
                                           name="telephone" 
                                           class="form-control <?php $__errorArgs = ['telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('telephone', $user->telephone ?? '')); ?>">
                                    <?php $__errorArgs = ['telephone'];
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

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Spécialité</label>
                                    <input type="text" 
                                           name="specialite" 
                                           class="form-control <?php $__errorArgs = ['specialite'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('specialite', $user->specialite ?? '')); ?>">
                                    <?php $__errorArgs = ['specialite'];
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

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Bio</label>
                                    <textarea name="bio" 
                                              class="form-control <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                              rows="4"><?php echo e(old('bio', $user->bio ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['bio'];
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

                                <div class="col-12">
                                    <hr>
                                    <div class="d-flex gap-3">
                                        <button type="submit" class="btn-edit">
                                            <i class="bi bi-check-circle me-2"></i>Enregistrer
                                        </button>
                                        <a href="<?php echo e(route('formateur.parametres')); ?>" class="btn-outline-edit">
                                            <i class="bi bi-gear me-2"></i>Paramètres
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/profil/index.blade.php ENDPATH**/ ?>