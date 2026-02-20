


<?php $__env->startSection('page-title', 'Mes formations'); ?>
<?php $__env->startSection('page-subtitle', 'Liste de toutes vos formations'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $inscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-img-top" style="height: 140px; background-image: url('<?php echo e($inscription->formation->image_url ?? 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>'); background-size: cover; background-position: center;"></div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($inscription->formation->titre); ?></h5>
                    <p class="card-text text-muted small">
                        <i class="bi bi-person"></i> <?php echo e($inscription->formation->formateur->nom ?? 'Formateur'); ?>

                    </p>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Progression</span>
                            <span><?php echo e(rand(10, 90)); ?>%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: <?php echo e(rand(10, 90)); ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-<?php echo e($inscription->statut == 'termine' ? 'success' : 'warning'); ?>">
                            <?php echo e($inscription->statut); ?>

                        </span>
                        <a href="<?php echo e(route('apprenant.formation.show', $inscription->formation->id)); ?>" class="btn btn-sm btn-primary">
                            Voir plus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted"></i>
                <h4 class="mt-3">Aucune formation</h4>
                <p class="text-muted">Vous n'êtes inscrit à aucune formation pour le moment.</p>
                <a href="<?php echo e(route('formations')); ?>" class="btn btn-primary mt-2">
                    <i class="bi bi-search"></i> Explorer les formations
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?php echo e($inscriptions->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.apprenant', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/formations/index.blade.php ENDPATH**/ ?>