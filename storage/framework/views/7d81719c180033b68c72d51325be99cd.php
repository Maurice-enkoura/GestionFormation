


<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Profil apprenant</h1>
        <a href="<?php echo e(route('formateur.apprenants.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="user-avatar mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2rem;">
                        <?php echo e(strtoupper(substr($apprenant->nom, 0, 2))); ?>

                    </div>
                    <h4><?php echo e($apprenant->nom); ?></h4>
                    <p class="text-muted"><?php echo e($apprenant->email); ?></p>
                    <p class="text-muted small">Membre depuis <?php echo e($apprenant->created_at->format('d/m/Y')); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5>Statistiques</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total formations:</span>
                        <strong><?php echo e($stats['total_formations']); ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>En cours:</span>
                        <strong><?php echo e($stats['formations_en_cours']); ?></strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Terminées:</span>
                        <strong><?php echo e($stats['formations_terminees']); ?></strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formations suivies</h5>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $inscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mb-3 pb-3 border-bottom">
                        <h6><?php echo e($inscription->formation->titre); ?></h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-<?php echo e($inscription->statut == 'termine' ? 'success' : 'warning'); ?>">
                                    <?php echo e($inscription->statut); ?>

                                </span>
                                <small class="text-muted ms-2">Inscrit le <?php echo e($inscription->created_at->format('d/m/Y')); ?></small>
                            </div>
                            <a href="<?php echo e(route('formateur.formations.show', $inscription->formation)); ?>" class="btn btn-sm btn-outline-primary">
                                Voir la formation
                            </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-muted py-3">Aucune inscription</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.formateur', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/apprenants/show.blade.php ENDPATH**/ ?>