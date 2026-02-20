


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
                    <?php
                        // Simuler une progression (à remplacer par votre logique réelle)
                        $progression = rand(10, 90);
                        $estTermine = $progression >= 100;
                    ?>
                    <h2 class="text-center text-primary"><?php echo e($progression); ?>%</h2>
                    <div class="progress mt-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: <?php echo e($progression); ?>%"></div>
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
                    <a href="<?php echo e(route('apprenant.ressources')); ?>" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-download"></i> Voir les ressources
                    </a>
                    
                    <?php if($progression >= 100 || $inscription->statut == 'termine'): ?>
                        <?php
                            $dejaEvalue = \App\Models\Evaluation::where('user_id', auth()->id())
                                ->where('formation_id', $formation->id)
                                ->exists();
                        ?>
                        
                        <?php if($dejaEvalue): ?>
                            <button class="btn btn-success w-100" disabled>
                                <i class="bi bi-check-circle"></i> Déjà évalué
                            </button>
                        <?php else: ?>
                            <a href="<?php echo e(route('apprenant.evaluations.create', $formation->id)); ?>" class="btn btn-warning w-100">
                                <i class="bi bi-star"></i> Évaluer cette formation
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .user-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 2rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        border-radius: 20px;
    }
    
    .card-header {
        background: white;
        border-bottom: 1px solid #eef2f6;
        padding: 1.2rem 1.5rem;
        border-radius: 20px 20px 0 0 !important;
        font-weight: 600;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.7rem 1rem;
        font-weight: 500;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }
    
    .btn-warning {
        background: #f59e0b;
        border: none;
        color: white;
    }
    
    .btn-warning:hover {
        background: #d97706;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
    }
    
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
        color: var(--primary);
    }
    
    .list-group-item {
        border: 1px solid #eef2f6;
        border-radius: 12px !important;
        margin-bottom: 0.5rem;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.apprenant', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/formations/show.blade.php ENDPATH**/ ?>