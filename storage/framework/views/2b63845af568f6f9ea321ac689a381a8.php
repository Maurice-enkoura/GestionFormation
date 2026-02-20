


<?php $__env->startSection('title', 'Dashboard Administrateur'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('page-subtitle', 'Accueil / Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10">
                <i class="bi bi-people text-primary"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_users'] ?? 0); ?></h4>
                <p>Utilisateurs totaux</p>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> +<?php echo e($stats['nouveaux_aujourdhui'] ?? 0); ?> aujourd'hui
                </small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10">
                <i class="bi bi-book text-success"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_formations'] ?? 0); ?></h4>
                <p>Formations</p>
                <small class="text-muted"><?php echo e($stats['total_formateurs'] ?? 0); ?> formateurs</small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10">
                <i class="bi bi-person-badge text-warning"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_formateurs'] ?? 0); ?></h4>
                <p>Formateurs</p>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> <?php echo e($stats['taux_engagement'] ?? 0); ?>% actifs
                </small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-opacity-10">
                <i class="bi bi-currency-euro text-info"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e(number_format($stats['revenus_mensuels'] ?? 0, 0, ',', ' ')); ?> €</h4>
                <p>Revenus mensuels</p>
                <small class="text-success">+12% vs mois dernier</small>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques -->
<div class="row g-4 mb-4">
    <div class="col-lg-8" data-aos="fade-up">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-graph-up me-2 text-primary"></i>
                    Inscriptions mensuelles
                </h5>
                <select class="form-select form-select-sm w-auto" id="chartYear">
                    <option value="<?php echo e(date('Y')); ?>"><?php echo e(date('Y')); ?></option>
                    <option value="<?php echo e(date('Y')-1); ?>"><?php echo e(date('Y')-1); ?></option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="inscriptionsChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-pie-chart me-2 text-primary"></i>
                    Répartition des rôles
                </h5>
            </div>
            <div class="card-body">
                <canvas id="rolesChart" style="height: 250px;"></canvas>
                <div class="mt-3">
                    <?php
                        $totalRoles = array_sum($repartitionRoles ?? [1,1,1]);
                    ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="bi bi-circle-fill text-primary me-2"></i> Apprenants</span>
                        <span class="fw-bold"><?php echo e($repartitionRoles[0] ?? 0); ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span><i class="bi bi-circle-fill text-success me-2"></i> Formateurs</span>
                        <span class="fw-bold"><?php echo e($repartitionRoles[1] ?? 0); ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-circle-fill text-warning me-2"></i> Admins</span>
                        <span class="fw-bold"><?php echo e($repartitionRoles[2] ?? 0); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dernières activités et formations -->
<div class="row g-4">
    <div class="col-lg-6" data-aos="fade-up">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    Activité récente
                </h5>
                <a href="#" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $activiteRecente ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group-item d-flex align-items-center">
                    <div class="activity-icon me-3">
                        <i class="bi bi-<?php echo e($activite['icon']); ?>"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1"><?php echo e($activite['titre']); ?></h6>
                        <p class="mb-1 text-muted small"><?php echo e($activite['description']); ?></p>
                    </div>
                    <small class="text-muted"><?php echo e($activite['time']); ?></small>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center py-4">
                    <i class="bi bi-calendar-x display-4 text-muted"></i>
                    <p class="mt-2">Aucune activité récente</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-stars me-2 text-primary"></i>
                    Dernières formations
                </h5>
                <a href="<?php echo e(route('admin.formations.index')); ?>" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $dernieresFormations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1"><?php echo e($formation->titre); ?></h6>
                            <p class="mb-1 text-muted small">
                                <i class="bi bi-person me-1"></i> <?php echo e($formation->formateur->nom ?? 'N/A'); ?>

                            </p>
                        </div>
                        <a href="<?php echo e(route('admin.formations.show', $formation)); ?>" class="btn btn-sm btn-light">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center py-4">
                    <i class="bi bi-book display-4 text-muted"></i>
                    <p class="mt-2">Aucune formation</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Derniers utilisateurs -->
        <div class="card mt-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-people me-2 text-primary"></i>
                    Derniers inscrits
                </h5>
                <a href="<?php echo e(route('admin.utilisateurs.index')); ?>" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $derniersUtilisateurs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="list-group-item">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar-sm me-3">
                            <?php echo e(strtoupper(substr($user->nom, 0, 2))); ?>

                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0"><?php echo e($user->nom); ?></h6>
                            <small class="text-muted">
                                <span class="badge bg-<?php echo e($user->role === 'admin' ? 'danger' : ($user->role === 'formateur' ? 'success' : 'primary')); ?> bg-opacity-10 text-<?php echo e($user->role === 'admin' ? 'danger' : ($user->role === 'formateur' ? 'success' : 'primary')); ?> me-2">
                                    <?php echo e(ucfirst($user->role)); ?>

                                </span>
                                <?php echo e($user->created_at->diffForHumans()); ?>

                            </small>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="list-group-item text-center py-4">
                    <i class="bi bi-people display-4 text-muted"></i>
                    <p class="mt-2">Aucun utilisateur</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des inscriptions
        const inscriptionsCtx = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(inscriptionsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Inscriptions',
                    data: <?php echo e(json_encode($inscriptionsMensuelles ?? [65, 59, 80, 81, 56, 55, 40, 48, 70, 75, 85, 90])); ?>,
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Graphique des rôles
        const rolesCtx = document.getElementById('rolesChart').getContext('2d');
        new Chart(rolesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Apprenants', 'Formateurs', 'Admins'],
                datasets: [{
                    data: <?php echo e(json_encode($repartitionRoles ?? [65, 25, 10])); ?>,
                    backgroundColor: ['#6366f1', '#22c55e', '#f59e0b'],
                    borderWidth: 0
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
                cutout: '70%'
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<style>
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
        border: 1px solid #eef2f6;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.1);
        border-color: var(--primary);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
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
        margin: 0.2rem 0 0.3rem 0;
        font-size: 0.9rem;
    }

    .stat-info small {
        font-size: 0.8rem;
    }

    .card {
        border: 1px solid #eef2f6;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .card-header {
        border-bottom: 1px solid #eef2f6;
        padding: 1.2rem 1.5rem;
        border-radius: 20px 20px 0 0 !important;
    }

    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 1rem 1.5rem;
    }

    .list-group-item:first-child {
        border-top: none;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
    }

    .user-avatar-sm {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>