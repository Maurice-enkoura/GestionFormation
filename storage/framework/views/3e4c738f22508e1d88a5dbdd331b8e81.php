

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4">Évaluations</h1>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <select name="formation_id" class="form-select">
                            <option value="">Toutes les formations</option>
                            <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($formation->id); ?>" <?php echo e(request('formation_id') == $formation->id ? 'selected' : ''); ?>>
                                <?php echo e($formation->titre); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Apprenant</th>
                            <th>Formation</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($evaluation->user->nom); ?></td>
                            <td><?php echo e($evaluation->formation->titre); ?></td>
                            <td>
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i class="bi bi-star<?php echo e($i <= $evaluation->note ? '-fill text-warning' : ''); ?>"></i>
                                <?php endfor; ?>
                            </td>
                            <td><?php echo e(Str::limit($evaluation->commentaire, 50)); ?></td>
                            <td><?php echo e($evaluation->created_at->format('d/m/Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('formateur.evaluations.show', $evaluation)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Détails
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Aucune évaluation</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <?php echo e($evaluations->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.formateur', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/evaluations/index.blade.php ENDPATH**/ ?>