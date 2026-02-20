


<?php $__env->startSection('page-title', 'Mes évaluations'); ?>
<?php $__env->startSection('page-subtitle', 'Toutes vos notes et commentaires'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-star me-2 text-primary"></i>
                        Mes évaluations
                    </h5>
                </div>
                <div class="card-body">
                    <?php if($evaluations->isEmpty()): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-star display-1 text-muted"></i>
                            <h4 class="mt-3">Aucune évaluation</h4>
                            <p class="text-muted">Vous n'avez pas encore évalué de formation.</p>
                            <a href="<?php echo e(route('apprenant.formations')); ?>" class="btn btn-primary mt-3">
                                <i class="bi bi-book"></i> Voir mes formations
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Formation</th>
                                        <th>Note</th>
                                        <th>Commentaire</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo e($evaluation->formation->titre); ?></strong>
                                            <br>
                                            <small class="text-muted"><?php echo e($evaluation->formation->formateur->nom ?? 'Formateur'); ?></small>
                                        </td>
                                        <td>
                                            <span class="text-warning">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <?php if($i <= $evaluation->note): ?>
                                                        <i class="bi bi-star-fill"></i>
                                                    <?php else: ?>
                                                        <i class="bi bi-star"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                                <span class="ms-2 fw-bold"><?php echo e($evaluation->note); ?>/5</span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                                <?php echo e($evaluation->commentaire ?? 'Aucun commentaire'); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($evaluation->created_at->format('d/m/Y')); ?></td>
                                        <td>
                                            <?php if($evaluation->est_publiee): ?>
                                                <span class="badge bg-success">Publiée</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">En attente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('apprenant.formation.show', $evaluation->formation_id)); ?>" 
                                               class="btn btn-sm btn-outline-primary" title="Voir la formation">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <?php if(!$evaluation->est_publiee): ?>
                                                <a href="<?php echo e(route('apprenant.evaluations.edit', $evaluation)); ?>" 
                                                   class="btn btn-sm btn-outline-warning" title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            <?php echo e($evaluations->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
    
    .table th {
        font-weight: 600;
        color: #475569;
    }
    
    .btn-outline-primary:hover i,
    .btn-outline-warning:hover i {
        color: white;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.apprenant', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/evaluations/index.blade.php ENDPATH**/ ?>