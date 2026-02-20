


<?php $__env->startSection('title', 'Modération des évaluations - Administration'); ?>
<?php $__env->startSection('page-title', 'Modération des évaluations'); ?>
<?php $__env->startSection('page-subtitle', 'Admin / Évaluations'); ?>

<?php $__env->startSection('content'); ?>
<!-- Filtres -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.evaluations.index')); ?>" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <select name="statut" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" <?php echo e(request('statut') == 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                            <option value="publiee" <?php echo e(request('statut') == 'publiee' ? 'selected' : ''); ?>>Publiée</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Liste des évaluations -->
<div class="card">
    <div class="card-body">
        <?php if($evaluations->isEmpty()): ?>
            <div class="text-center py-5">
                <i class="bi bi-star display-1 text-muted"></i>
                <h4 class="mt-3">Aucune évaluation</h4>
                <p class="text-muted">Il n'y a pas d'évaluations à modérer pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Apprenant</th>
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
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar-sm me-2">
                                        <?php echo e(strtoupper(substr($evaluation->user->nom, 0, 2))); ?>

                                    </div>
                                    <?php echo e($evaluation->user->nom); ?>

                                </div>
                            </td>
                            <td><?php echo e($evaluation->formation->titre); ?></td>
                            <td>
                                <span class="text-warning">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $evaluation->note): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php else: ?>
                                            <i class="bi bi-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
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
                                <div class="btn-group">
                                    <a href="<?php echo e(route('admin.evaluations.show', $evaluation)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if(!$evaluation->est_publiee): ?>
                                        <form action="<?php echo e(route('admin.evaluations.approuver', $evaluation)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Approuver">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo e($evaluation->id); ?>">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
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
                <?php echo e($evaluations->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modals de rejet -->
<?php $__currentLoopData = $evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!$evaluation->est_publiee): ?>
<div class="modal fade" id="rejectModal<?php echo e($evaluation->id); ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('admin.evaluations.rejeter', $evaluation)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Rejeter l'évaluation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir rejeter cette évaluation ?</p>
                    <div class="mb-3">
                        <label for="motif" class="form-label">Motif du rejet</label>
                        <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Rejeter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/admin/evaluations/index.blade.php ENDPATH**/ ?>