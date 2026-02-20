


<?php $__env->startSection('title', 'Messages - Espace Formateur'); ?>
<?php $__env->startSection('page-title', 'Boîte de réception'); ?>
<?php $__env->startSection('page-subtitle', 'Formateur / Messages'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Liste des contacts -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-people me-2 text-primary"></i>
                        Conversations
                        <?php if(isset($nonLus) && $nonLus > 0): ?>
                            <span class="badge bg-danger ms-2"><?php echo e($nonLus); ?> non lu(s)</span>
                        <?php endif; ?>
                    </h5>
                    <a href="<?php echo e(route('formateur.messages.create')); ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle"></i> Nouveau
                    </a>
                </div>
                <div class="list-group list-group-flush" style="max-height: 500px; overflow-y: auto;">
                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            // Utiliser le chemin complet avec App\Models\Message
                            $lastMessage = \App\Models\Message::where(function($q) use ($contact) {
                                $formateurId = auth()->id();
                                $q->where('sender_id', $contact->id)->where('receiver_id', $formateurId)
                                  ->orWhere('sender_id', $formateurId)->where('receiver_id', $contact->id);
                            })->latest()->first();
                            
                            $nonLuCount = \App\Models\Message::where('sender_id', $contact->id)
                                ->where('receiver_id', auth()->id())
                                ->where('lu', false)
                                ->count();
                        ?>
                        <a href="<?php echo e(route('formateur.messages.index', ['contact_id' => $contact->id])); ?>" 
                           class="list-group-item list-group-item-action <?php echo e(request('contact_id') == $contact->id ? 'active' : ''); ?>">
                            <div class="d-flex align-items-center">
                                <div class="contact-avatar me-2">
                                    <?php echo e(strtoupper(substr($contact->nom, 0, 2))); ?>

                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong><?php echo e($contact->nom); ?></strong>
                                        <?php if($nonLuCount > 0): ?>
                                            <span class="badge bg-danger rounded-pill"><?php echo e($nonLuCount); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <small class="text-muted"><?php echo e(ucfirst($contact->role)); ?></small>
                                    <?php if($lastMessage): ?>
                                        <small class="d-block text-truncate text-muted">
                                            <?php echo e(Str::limit($lastMessage->message, 30)); ?>

                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="list-group-item text-center py-4">
                            <i class="bi bi-chat display-4 text-muted"></i>
                            <p class="mt-2 text-muted">Aucune conversation</p>
                            <a href="<?php echo e(route('formateur.messages.create')); ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle"></i> Commencer une conversation
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Zone des messages -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-chat-dots me-2 text-primary"></i>
                        <?php if(request('contact_id')): ?>
                            <?php
                                $contact = \App\Models\User::find(request('contact_id'));
                            ?>
                            Conversation avec <strong><?php echo e($contact->nom ?? 'Contact'); ?></strong>
                        <?php else: ?>
                            Messages
                        <?php endif; ?>
                    </h5>
                </div>
                
                <div class="card-body" style="height: 400px; overflow-y: auto;" id="messageContainer">
                    <?php if(request('contact_id')): ?>
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="message-item <?php echo e($message->sender_id == auth()->id() ? 'sent' : 'received'); ?> mb-3">
                                <div class="message-bubble p-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong><?php echo e($message->sender->nom); ?></strong>
                                        <small class="text-muted"><?php echo e($message->created_at->format('d/m/Y H:i')); ?></small>
                                    </div>
                                    <p class="mb-0"><?php echo e($message->message); ?></p>
                                    <?php if($message->formation): ?>
                                        <small class="text-muted mt-2 d-block">
                                            <i class="bi bi-book"></i> Formation: <?php echo e($message->formation->titre); ?>

                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-5">
                                <i class="bi bi-chat display-1 text-muted"></i>
                                <h5 class="mt-3">Aucun message</h5>
                                <p class="text-muted">Commencez la conversation en envoyant un message</p>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            <?php echo e($messages->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="bi bi-chat display-1 text-muted"></i>
                            <h5 class="mt-3">Sélectionnez une conversation</h5>
                            <p class="text-muted">Choisissez un contact pour voir les messages</p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(request('contact_id')): ?>
                <div class="card-footer">
                    <form action="<?php echo e(route('formateur.messages.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="receiver_id" value="<?php echo e(request('contact_id')); ?>">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" 
                                   placeholder="Votre message..." required autocomplete="off">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .contact-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .message-item {
        display: flex;
        flex-direction: column;
    }
    
    .message-item.sent {
        align-items: flex-end;
    }
    
    .message-item.received {
        align-items: flex-start;
    }
    
    .message-bubble {
        max-width: 80%;
        border-radius: 18px;
        background: <?php echo e(isset($message) && $message->sender_id == auth()->id() ? '#e3f2fd' : '#f8fafc'); ?>;
        border: 1px solid #eef2f6;
    }
    
    .list-group-item.active {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-color: transparent;
    }
    
    .list-group-item.active .text-muted {
        color: rgba(255,255,255,0.8) !important;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        border-radius: 0 50px 50px 0;
    }
    
    .form-control {
        border-radius: 50px 0 0 50px;
        border: 2px solid #eef2f6;
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: none;
    }
    
    #messageContainer {
        scroll-behavior: smooth;
    }
</style>

<?php $__env->startPush('scripts'); ?>
<script>
    // Auto-scroll vers le bas
    const container = document.getElementById('messageContainer');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
    
    // Rafraîchir automatiquement toutes les 10 secondes (optionnel)
    setInterval(function() {
        if (document.querySelector('.message-item')) {
            // Recharger la page pour voir les nouveaux messages
            // Vous pouvez améliorer avec AJAX
        }
    }, 10000);
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.formateur', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/formateur/messages/index.blade.php ENDPATH**/ ?>