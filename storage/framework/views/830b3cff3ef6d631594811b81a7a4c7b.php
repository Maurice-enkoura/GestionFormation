


<?php $__env->startSection('title', 'Statistiques globales - Administration'); ?>
<?php $__env->startSection('page-title', 'Statistiques globales'); ?>
<?php $__env->startSection('page-subtitle', 'Admin / Statistiques'); ?>

<?php $__env->startSection('content'); ?>
<!-- Cartes de statistiques -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10">
                <i class="bi bi-people text-primary"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_users'] ?? 0); ?></h4>
                <p>Utilisateurs totaux</p>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> +<?php echo e($stats['nouveaux_users'] ?? 0); ?> ce mois
                </small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10">
                <i class="bi bi-book text-success"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_formations'] ?? 0); ?></h4>
                <p>Formations</p>
                <small class="text-muted"><?php echo e($stats['formations_publiees'] ?? 0); ?> publiées</small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10">
                <i class="bi bi-person-badge text-warning"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_formateurs'] ?? 0); ?></h4>
                <p>Formateurs</p>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> <?php echo e($stats['formateurs_actifs'] ?? 0); ?> actifs
                </small>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-opacity-10">
                <i class="bi bi-mortarboard text-info"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total_apprenants'] ?? 0); ?></h4>
                <p>Apprenants</p>
                <small class="text-success"><?php echo e($stats['apprenants_actifs'] ?? 0); ?> actifs</small>
            </div>
        </div>
    </div>
</div>

<!-- Graphiques -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-graph-up me-2 text-primary"></i>
                    Évolution des inscriptions
                </h5>
                <select class="form-select form-select-sm w-auto" id="yearSelect">
                    <option value="<?php echo e(date('Y')); ?>"><?php echo e(date('Y')); ?></option>
                    <option value="<?php echo e(date('Y')-1); ?>"><?php echo e(date('Y')-1); ?></option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="inscriptionsChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-pie-chart me-2 text-primary"></i>
                    Répartition des utilisateurs
                </h5>
            </div>
            <div class="card-body">
                <canvas id="usersChart" style="height: 250px;"></canvas>
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="bi bi-circle-fill text-primary me-2"></i> Apprenants</span>
                        <span class="fw-bold"><?php echo e($stats['total_apprenants'] ?? 0); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="bi bi-circle-fill text-success me-2"></i> Formateurs</span>
                        <span class="fw-bold"><?php echo e($stats['total_formateurs'] ?? 0); ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><i class="bi bi-circle-fill text-warning me-2"></i> Administrateurs</span>
                        <span class="fw-bold"><?php echo e($stats['total_admins'] ?? 0); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tableaux de données -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-trophy me-2 text-primary"></i>
                    Top formations
                </h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Formateur</th>
                            <th>Inscriptions</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $topFormations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($formation->titre); ?></td>
                            <td><?php echo e($formation->formateur->nom); ?></td>
                            <td><?php echo e($formation->inscriptions_count); ?></td>
                            <td>
                                <span class="text-warning">
                                    <?php echo e(number_format($formation->note_moyenne, 1)); ?> ★
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-4">Aucune donnée disponible</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-star me-2 text-primary"></i>
                    Top formateurs
                </h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Formations</th>
                            <th>Apprenants</th>
                            <th>Note moyenne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $topFormateurs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formateur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($formateur->nom); ?></td>
                            <td><?php echo e($formateur->formations_count); ?></td>
                            <td><?php echo e($formateur->total_apprenants ?? 0); ?></td>
                            <td>
                                <span class="text-warning">
                                    <?php echo e(number_format($formateur->note_moyenne, 1)); ?> ★
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-4">Aucune donnée disponible</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Activité récente -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    Activité récente
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $activiteRecente ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon me-3">
                                <i class="bi bi-<?php echo e($activite['icone'] ?? 'circle'); ?>"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong><?php echo e($activite['titre']); ?></strong>
                                <p class="mb-0 text-muted small"><?php echo e($activite['description']); ?></p>
                            </div>
                            <small class="text-muted"><?php echo e($activite['time']); ?></small>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x display-4 text-muted"></i>
                        <p class="mt-2">Aucune activité récente</p>
                    </div>
                    <?php endif; ?>
                </div>
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
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
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

        // Graphique des utilisateurs
        const usersCtx = document.getElementById('usersChart').getContext('2d');
        new Chart(usersCtx, {
            type: 'doughnut',
            data: {
                labels: ['Apprenants', 'Formateurs', 'Admins'],
                datasets: [{
                    data: [
                        <?php echo e($stats['total_apprenants'] ?? 65); ?>,
                        <?php echo e($stats['total_formateurs'] ?? 25); ?>,
                        <?php echo e($stats['total_admins'] ?? 10); ?>

                    ],
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
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
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
        margin: 0.2rem 0 0 0;
        font-size: 0.9rem;
    }

    .stat-info small {
        font-size: 0.8rem;
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

    .table th {
        font-weight: 600;
        color: #64748b;
        border-bottom-width: 1px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/admin/statistiques.blade.php ENDPATH**/ ?>