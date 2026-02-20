

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4">Apprenants</h1>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un apprenant..." value="<?php echo e(request('search')); ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Apprenant</th>
                            <th>Email</th>
                            <th>Inscriptions</th>
                            <th>Date inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $apprenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apprenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 40px; height: 40px;">
                                        <?php echo e(strtoupper(substr($apprenant->nom, 0, 2))); ?>

                                    </div>
                                    <?php echo e($apprenant->nom); ?>

                                </div>
                            </td>
                            <td><?php echo e($apprenant->email); ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo e($apprenant->inscriptions_count); ?> formation(s)</span>
                            </td>
                            <td><?php echo e($apprenant->created_at->format('d/m/Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('formateur.apprenants.show', $apprenant)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Aucun apprenant trouvé</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <?php echo e($apprenants->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.formateur', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/apprenants/index.blade.php ENDPATH**/ ?>