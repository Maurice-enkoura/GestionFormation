


<?php $__env->startSection('title', 'Détails du formateur'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Détails du formateur</h1>
        <div>
            <a href="<?php echo e(route('admin.formateurs.edit', $formateur)); ?>" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <a href="<?php echo e(route('admin.formateurs.index')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="user-avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                        <?php echo e(strtoupper(substr($formateur->nom, 0, 2))); ?>

                    </div>
                    <h4><?php echo e($formateur->nom); ?></h4>
                    <p class="text-muted"><?php echo e($formateur->email); ?></p>
                    <span class="badge bg-info">Formateur</span>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Total formations</label>
                        <h3><?php echo e($stats['total_formations']); ?></h3>
                    </div>
                    <div class="mb-3">
                        <label>Total inscriptions</label>
                        <h3><?php echo e($stats['total_inscriptions']); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informations personnelles</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Nom</th>
                            <td><?php echo e($formateur->nom); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo e($formateur->email); ?></td>
                        </tr>
                        <tr>
                            <th>Date d'inscription</th>
                            <td><?php echo e($formateur->created_at->format('d/m/Y H:i')); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Formations créées</h5>
                </div>
                <div class="card-body">
                    <?php if($formateur->formations->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Inscriptions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $formateur->formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($formation->titre); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')); ?></td>
                                        <td><?php echo e($formation->inscriptions_count); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center">Aucune formation créée</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/admin/formateurs/show.blade.php ENDPATH**/ ?>