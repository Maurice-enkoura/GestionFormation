


<?php $__env->startSection('title', 'Gestion des formations - Administration'); ?>
<?php $__env->startSection('page-title', 'Gestion des formations'); ?>
<?php $__env->startSection('page-subtitle', 'Admin / Formations'); ?>

<?php $__env->startSection('content'); ?>
<!-- Filtres et recherche -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.formations.index')); ?>" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher une formation..." value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-3">
                        <select name="formateur_id" class="form-select">
                            <option value="">Tous les formateurs</option>
                            <?php $__currentLoopData = $formateurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formateur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($formateur->id); ?>" <?php echo e(request('formateur_id') == $formateur->id ? 'selected' : ''); ?>>
                                    <?php echo e($formateur->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filtrer
                        </button>
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="<?php echo e(route('admin.formations.create')); ?>" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Nouvelle formation
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques rapides -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10">
                <i class="bi bi-book text-primary"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['total'] ?? 0); ?></h4>
                <p>Total formations</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10">
                <i class="bi bi-check-circle text-success"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['publiees'] ?? 0); ?></h4>
                <p>Formations publiées</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-opacity-10">
                <i class="bi bi-people text-info"></i>
            </div>
            <div class="stat-info">
                <h4><?php echo e($stats['inscriptions'] ?? 0); ?></h4>
                <p>Inscriptions totales</p>
            </div>
        </div>
    </div>
</div>

<!-- Liste des formations -->
<div class="card">
    <div class="card-body">
        <?php if($formations->isEmpty()): ?>
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted"></i>
                <h4 class="mt-3">Aucune formation</h4>
                <p class="text-muted">Commencez par créer une nouvelle formation.</p>
                <a href="<?php echo e(route('admin.formations.create')); ?>" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Créer une formation
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Formateur</th>
                            <th>Modules</th>
                            <th>Inscriptions</th>
                            <th>Dates</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <strong><?php echo e($formation->titre); ?></strong>
                                <br>
                                <small class="text-muted"><?php echo e(Str::limit($formation->description, 50)); ?></small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar-sm me-2">
                                        <?php echo e(strtoupper(substr($formation->formateur->nom, 0, 2))); ?>

                                    </div>
                                    <?php echo e($formation->formateur->nom); ?>

                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info"><?php echo e($formation->modules_count ?? 0); ?> modules</span>
                            </td>
                            <td>
                                <span class="badge bg-success"><?php echo e($formation->inscriptions_count ?? 0); ?> inscrits</span>
                            </td>
                            <td>
                                <small>
                                    <i class="bi bi-calendar"></i> Début: <?php echo e($formation->date_debut ? $formation->date_debut->format('d/m/Y') : 'N/A'); ?>

                                    <br>
                                    <i class="bi bi-calendar-check"></i> Fin: <?php echo e($formation->date_fin ? $formation->date_fin->format('d/m/Y') : 'N/A'); ?>

                                </small>
                            </td>
                            <td>
                                <?php if($formation->est_active ?? true): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('admin.formations.show', $formation)); ?>" class="btn btn-sm btn-outline-primary" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.formations.edit', $formation)); ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.formations.statistiques', $formation)); ?>" class="btn btn-sm btn-outline-info" title="Statistiques">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.formations.modules.index', $formation)); ?>" class="btn btn-sm btn-outline-secondary" title="Voir modules">
                                        <i class="bi bi-collection"></i>
                                    </a>
                                    <?php if($formation->est_active ?? true): ?>
                                        <form action="<?php echo e(route('admin.formations.desactiver', $formation)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Désactiver" onclick="return confirm('Désactiver cette formation ?')">
                                                <i class="bi bi-pause-circle"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('admin.formations.activer', $formation)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Activer">
                                                <i class="bi bi-play-circle"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($formations->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .user-avatar-sm {
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.2rem;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid #eef2f6;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .stat-info h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }
    
    .stat-info p {
        margin: 0;
        font-size: 0.85rem;
        color: #64748b;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/admin/formations/index.blade.php ENDPATH**/ ?>