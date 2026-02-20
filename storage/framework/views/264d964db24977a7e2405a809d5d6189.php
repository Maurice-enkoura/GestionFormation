


<?php $__env->startSection('page-title', 'Mes messages'); ?>
<?php $__env->startSection('page-subtitle', 'Boîte de réception'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-envelope me-2 text-primary"></i>
                        Messages
                        <?php if($nonLus > 0): ?>
                            <span class="badge bg-danger ms-2"><?php echo e($nonLus); ?> non lu(s)</span>
                        <?php endif; ?>
                    </h5>
                    <a href="<?php echo e(route('apprenant.messages.create')); ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Nouveau message
                    </a>
                </div>
                <div class="card-body p-0">
                    <?php if($messages->isEmpty()): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-envelope-open display-1 text-muted"></i>
                            <h4 class="mt-3">Aucun message</h4>
                            <p class="text-muted">Votre boîte de réception est vide.</p>
                            <a href="<?php echo e(route('apprenant.messages.create')); ?>" class="btn btn-primary mt-3">
                                <i class="bi bi-pencil"></i> Écrire un message
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('apprenant.messages.show', $message)); ?>" 
                               class="list-group-item list-group-item-action <?php echo e(!$message->lu && $message->receiver_id == Auth::id() ? 'bg-light fw-bold' : ''); ?>">
                                <div class="d-flex align-items-center">
                                    <div class="message-avatar me-3">
                                        <?php echo e(strtoupper(substr($message->sender->nom, 0, 2))); ?>

                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">
                                                <?php echo e($message->sender->nom); ?>

                                                <?php if($message->sender->role == 'formateur'): ?>
                                                    <span class="badge bg-success bg-opacity-10 text-success ms-2">Formateur</span>
                                                <?php endif; ?>
                                            </h6>
                                            <small class="text-muted"><?php echo e($message->created_at->diffForHumans()); ?></small>
                                        </div>
                                        <p class="mb-1"><strong><?php echo e($message->sujet); ?></strong></p>
                                        <p class="mb-0 text-truncate"><?php echo e($message->contenu); ?></p>
                                        <?php if($message->formation): ?>
                                            <small class="text-muted">
                                                <i class="bi bi-book"></i> <?php echo e($message->formation->titre); ?>

                                            </small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Contacts</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('apprenant.messages.index', ['contact_id' => $contact->id])); ?>" 
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <div class="contact-avatar me-2">
                                <?php echo e(strtoupper(substr($contact->nom, 0, 2))); ?>

                            </div>
                            <div>
                                <h6 class="mb-0"><?php echo e($contact->nom); ?></h6>
                                <small class="text-muted"><?php echo e(ucfirst($contact->role)); ?></small>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="list-group-item text-center py-4">
                            <p class="text-muted mb-0">Aucun contact</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message-avatar, .contact-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 1rem 1.2rem;
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover {
        transform: translateX(5px);
        background-color: #f8fafc;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.apprenant', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/messages/index.blade.php ENDPATH**/ ?>