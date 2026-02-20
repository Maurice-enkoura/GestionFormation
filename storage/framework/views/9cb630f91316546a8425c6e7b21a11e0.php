

<?php $__env->startSection('title', $formation->titre . ' - EduForm'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Fil d'Ariane -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="text-decoration-none">Accueil</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('formations')); ?>" class="text-decoration-none">Formations</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($formation->titre); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Image de la formation -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <img src="<?php echo e($formation->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>" 
                     class="img-fluid w-100" 
                     alt="<?php echo e($formation->titre); ?>"
                     style="height: 400px; object-fit: cover;">
            </div>

            <!-- Titre et description -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 fw-bold mb-3"><?php echo e($formation->titre); ?></h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="bi bi-person-circle text-primary fs-5"></i>
                        </div>
                        <span class="fw-semibold">Par <?php echo e($formation->formateur->nom ?? 'Formateur'); ?></span>
                        
                        <span class="mx-3 text-muted">|</span>
                        
                        <i class="bi bi-calendar-check text-primary me-1"></i>
                        <span><?php echo e(\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')); ?></span>
                    </div>

                    <h5 class="fw-bold mb-3">Description</h5>
                    <p class="text-secondary mb-4" style="line-height: 1.8;"><?php echo e($formation->description ?? 'Aucune description disponible.'); ?></p>

                    <!-- Note moyenne -->
                    <?php if($noteMoyenne > 0): ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-2 px-3">
                            <i class="bi bi-star-fill text-warning me-2"></i>
                            <span class="fw-bold"><?php echo e(number_format($noteMoyenne, 1)); ?>/5</span>
                            <span class="text-muted ms-2">(<?php echo e($formation->evaluations->count()); ?> avis)</span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Modules et contenu -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">Contenu de la formation</h4>
                </div>
                <div class="card-body p-4">
                    <?php if($formation->modules && $formation->modules->count() > 0): ?>
                        <div class="accordion" id="modulesAccordion">
                            <?php $__currentLoopData = $formation->modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo e($index > 0 ? 'collapsed' : ''); ?> bg-light rounded-3" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#module<?php echo e($module->id); ?>">
                                        <i class="bi bi-folder2-open text-primary me-3"></i>
                                        <span class="fw-semibold"><?php echo e($module->titre); ?></span>
                                    </button>
                                </h2>
                                <div id="module<?php echo e($module->id); ?>" 
                                     class="accordion-collapse collapse <?php echo e($index == 0 ? 'show' : ''); ?>" 
                                     data-bs-parent="#modulesAccordion">
                                    <div class="accordion-body p-4">
                                        <?php if($module->description): ?>
                                            <p class="text-muted mb-3"><?php echo e($module->description); ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if($module->contenus && $module->contenus->count() > 0): ?>
                                            <ul class="list-group list-group-flush">
                                                <?php $__currentLoopData = $module->contenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-group-item d-flex align-items-center border-0 ps-0">
                                                    <i class="bi bi-<?php echo e($contenu->type == 'video' ? 'play-circle' : 'file-text'); ?> text-primary me-3 fs-5"></i>
                                                    <span><?php echo e($contenu->description ?? 'Contenu'); ?></span>
                                                    <?php if($contenu->url): ?>
                                                    <a href="<?php echo e($contenu->url); ?>" target="_blank" class="ms-auto btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        <i class="bi bi-box-arrow-up-right me-1"></i>Voir
                                                    </a>
                                                    <?php endif; ?>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            <p class="text-muted fst-italic mb-0">Aucun contenu disponible pour ce module.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted fst-italic mb-0">Aucun module disponible pour cette formation.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Avis des apprenants -->
            <?php if($formation->evaluations && $formation->evaluations->count() > 0): ?>
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">Avis des apprenants</h4>
                </div>
                <div class="card-body p-4">
                    <?php $__currentLoopData = $formation->evaluations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="bi bi-person text-primary"></i>
                            </div>
                            <span class="fw-semibold"><?php echo e($evaluation->user->nom ?? 'Apprenant'); ?></span>
                            <span class="mx-2 text-muted">•</span>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="bi bi-star<?php echo e($i <= $evaluation->note ? '-fill text-warning' : ''); ?> me-1"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-secondary ms-4 ps-2">"<?php echo e($evaluation->commentaire); ?>"</p>
                        <small class="text-muted ms-4 ps-2"><?php echo e($evaluation->created_at->diffForHumans()); ?></small>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Colonne latérale -->
       <!-- Colonne latérale -->
<div class="col-lg-4">
    <div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 100px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Informations</h5>
            
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                    <i class="bi bi-calendar-week text-primary"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Date de début</small>
                    <span class="fw-semibold"><?php echo e(\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')); ?></span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                    <i class="bi bi-calendar-check text-primary"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Date de fin</small>
                    <span class="fw-semibold"><?php echo e(\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')); ?></span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                    <i class="bi bi-files text-primary"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Modules</small>
                    <span class="fw-semibold"><?php echo e($formation->modules->count()); ?> module(s)</span>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">Formateur</h5>
            <div class="d-flex align-items-center mb-4">
                <div class="formateur-avatar me-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.5rem;">
                    <?php echo e(strtoupper(substr($formation->formateur->nom ?? 'F', 0, 2))); ?>

                </div>
                <div>
                    <span class="fw-bold d-block"><?php echo e($formation->formateur->nom ?? 'Non assigné'); ?></span>
                    <small class="text-muted"><?php echo e($formation->formateur->email ?? ''); ?></small>
                </div>
            </div>

           
<?php if(auth()->guard()->guest()): ?>
    
    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary w-100 py-3 rounded-pill mb-2">
        <i class="bi bi-person-plus me-2"></i>S'inscrire à cette formation
    </a>
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
    <?php if(auth()->user()->role === 'apprenant'): ?>
        <?php
            // Vérifier si l'apprenant est déjà inscrit à cette formation
            $estInscrit = $formation->inscriptions
                ->where('user_id', auth()->id())
                ->where('statut', 'en_cours')
                ->isNotEmpty();
        ?>

        <?php if($estInscrit): ?>
            
            <a href="<?php echo e(route('apprenant.dashboard')); ?>" class="btn btn-outline-primary w-100 py-3 rounded-pill mb-2">
                <i class="bi bi-speedometer2 me-2"></i>Voir ma formation
            </a>
        <?php else: ?>
            
            <form action="<?php echo e(route('apprenant.formations.inscrire', $formation->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill mb-2">
                    <i class="bi bi-person-plus me-2"></i>S'inscrire à cette formation
                </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


        </div>
    </div>
</div>

    </div>

    <!-- Formations similaires -->
    <?php if($formationsSimilaires && $formationsSimilaires->count() > 0): ?>
    <section class="mt-5 pt-4">
        <h3 class="fw-bold mb-4">Formations similaires</h3>
        <div class="row g-4">
            <?php $__currentLoopData = $formationsSimilaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <img src="<?php echo e($similaire->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'); ?>" 
                         class="card-img-top rounded-top-4" 
                         alt="<?php echo e($similaire->titre); ?>"
                         style="height: 150px; object-fit: cover;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-2"><?php echo e($similaire->titre); ?></h6>
                        <p class="small text-muted mb-2"><?php echo e(Str::limit($similaire->description, 60)); ?></p>
                        <a href="<?php echo e(route('formations.show', $similaire->id)); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            Voir <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<style>
.formateur-avatar {
    box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
}
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: var(--primary);
}
.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(99, 102, 241, 0.1);
}
</style>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formations/show.blade.php ENDPATH**/ ?>