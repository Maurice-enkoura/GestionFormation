


<?php $__env->startSection('title', 'Toutes les formations - EduForm'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold mb-3">Nos formations</h1>
            <p class="lead text-muted">Découvrez toutes nos formations disponibles</p>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="row mb-5">
        <div class="col-md-8 mx-auto">
            <form action="<?php echo e(route('formations.search')); ?>" method="GET" class="d-flex gap-2">
                <input type="text" 
                       name="search" 
                       class="form-control form-control-lg rounded-pill" 
                       placeholder="Rechercher une formation..."
                       value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Liste des formations -->
    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 hover-effect">
                <?php if($formation->image_url): ?>
                    <img src="<?php echo e($formation->image_url); ?>" 
                         class="card-img-top rounded-top-4" 
                         alt="<?php echo e($formation->titre); ?>"
                         style="height: 200px; object-fit: cover;">
                <?php else: ?>
                    <div class="card-img-top bg-primary bg-opacity-10 d-flex align-items-center justify-content-center rounded-top-4" 
                         style="height: 200px;">
                        <i class="bi bi-image text-primary" style="font-size: 3rem;"></i>
                    </div>
                <?php endif; ?>
                
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3"><?php echo e($formation->titre); ?></h5>
                    
                    <p class="card-text text-muted mb-3">
                        <?php echo e(Str::limit($formation->description ?? 'Aucune description', 100)); ?>

                    </p>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="bi bi-person-circle text-primary"></i>
                        </div>
                        <small class="text-muted"><?php echo e($formation->formateur->nom ?? 'Formateur'); ?></small>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <?php if($formation->date_debut): ?>
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                <i class="bi bi-calendar me-1"></i>
                                <?php echo e(\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')); ?>

                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary rounded-pill px-3 py-2">
                                Date flexible
                            </span>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('formations.show', $formation->id)); ?>" class="btn btn-outline-primary rounded-pill px-4">
                            Voir plus <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-emoji-frown display-1 text-muted"></i>
                <h3 class="mt-4">Aucune formation disponible</h3>
                <p class="text-muted">Revenez plus tard pour découvrir nos formations</p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        <?php echo e($formations->links()); ?>

    </div>
</div>

<style>
.hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-effect:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15) !important;
}
.pagination {
    gap: 5px;
}
.page-link {
    border-radius: 50px;
    border: none;
    padding: 0.5rem 1rem;
    color: #64748b;
}
.page-item.active .page-link {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formations/index.blade.php ENDPATH**/ ?>