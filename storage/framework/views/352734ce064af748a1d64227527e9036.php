


<?php $__env->startSection('page-title', $formation->titre); ?>
<?php $__env->startSection('page-subtitle', 'Détails de la formation'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- Informations principales -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Description</h4>
                    <p><?php echo e($formation->description ?? 'Aucune description disponible.'); ?></p>

                   <div class="row mt-4">
    <div class="col-md-6">
        <p>
            <i class="bi bi-calendar"></i> Début : 
            <?php echo e($formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : 'Non renseigné'); ?>

        </p>
    </div>
    <div class="col-md-6">
        <p>
            <i class="bi bi-calendar-check"></i> Fin : 
            <?php echo e($formation->date_fin ? \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') : 'Non renseigné'); ?>

        </p>
    </div>
</div>

                </div>
            </div>

            <!-- Modules et contenus -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Contenu de la formation</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="modulesAccordion">
                        <?php $__currentLoopData = $formation->modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#module<?php echo e($module->id); ?>">
                                    <?php echo e($module->titre); ?>

                                </button>
                            </h2>
                            <div id="module<?php echo e($module->id); ?>" class="accordion-collapse collapse <?php echo e($index == 0 ? 'show' : ''); ?>" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p><?php echo e($module->description ?? 'Aucune description'); ?></p>

                                    <?php if($module->contenus->count() > 0): ?>
                                    <h6 class="mt-3">Contenus :</h6>
                                    <ul class="list-group">
                                        <?php $__currentLoopData = $module->contenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-<?php echo e($contenu->type == 'video' ? 'play-circle' : 'file-text'); ?> me-2"></i>
                                                <?php echo e($contenu->description ?? 'Contenu'); ?>

                                            </div>
                                            <a href="<?php echo e($contenu->url); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-box-arrow-up-right"></i> Voir
                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Informations sur le formateur -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Formateur</h5>
                </div>
                <div class="card-body text-center">
                    <div class="user-avatar mx-auto mb-3" style="width: 80px; height: 80px;">
                        <?php echo e(strtoupper(substr($formation->formateur->nom ?? 'F', 0, 2))); ?>

                    </div>
                    <h5><?php echo e($formation->formateur->nom ?? 'Non assigné'); ?></h5>
                    <p class="text-muted small"><?php echo e($formation->formateur->email ?? ''); ?></p>
                </div>
            </div>

            <!-- Progression -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ma progression</h5>
                </div>
                <div class="card-body">
                    <h2 class="text-center text-primary"><?php echo e(rand(10, 90)); ?>%</h2>
                    <div class="progress mt-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: <?php echo e(rand(10, 90)); ?>%"></div>
                    </div>
                    <p class="text-center text-muted small mt-2">
                        <?php echo e($totalContenus ?? 0); ?> contenus au total
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <a href="#" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-play-circle"></i> Continuer
                    </a>
                    <a href="<?php echo e(route('apprenant.ressources')); ?>" class="btn btn-outline-primary w-100">
                        <i class="bi bi-download"></i> Voir les ressources
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.apprenant', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/formations/show.blade.php ENDPATH**/ ?>