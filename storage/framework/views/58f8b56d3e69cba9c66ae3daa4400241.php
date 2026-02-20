


<?php $__env->startSection('page-title', 'Mes ressources'); ?>
<?php $__env->startSection('page-subtitle', 'Tous les contenus de vos formations'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $contenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="resource-icon me-3" style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-<?php echo e($contenu->type == 'video' ? 'play' : 'text'); ?> fs-3" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <h6 class="mb-1"><?php echo e(Str::limit($contenu->description ?? 'Ressource', 30)); ?></h6>
                            <small class="text-muted"><?php echo e($contenu->type ?? 'Document'); ?></small>
                        </div>
                    </div>
                    
                    <p class="small text-muted mb-2">
                        <i class="bi bi-book"></i> <?php echo e($contenu->module->formation->titre ?? 'Formation'); ?>

                    </p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Ajouté <?php echo e($contenu->created_at->diffForHumans()); ?></small>
                        <a href="<?php echo e($contenu->url); ?>" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-download"></i> Télécharger
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-files display-1 text-muted"></i>
                <h4 class="mt-3">Aucune ressource</h4>
                <p class="text-muted">Aucune ressource n'est disponible pour le moment.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <?php echo e($contenus->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.apprenant', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/ressources/index.blade.php ENDPATH**/ ?>