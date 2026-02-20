{{-- resources/views/apprenant/messages/show.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Détail du message')
@section('page-subtitle', 'Conversation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-envelope me-2 text-primary"></i>
                        {{ $sujet }}
                    </h5>
                    <div>
                        <a href="{{ route('apprenant.messages.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                        <form action="{{ route('apprenant.messages.destroy', $message) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" 
                                    onclick="return confirm('Supprimer ce message ?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <!-- En-tête du message -->
                    <div class="message-header mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="message-avatar me-3">
                                {{ strtoupper(substr($message->sender->nom, 0, 2)) }}
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $message->sender->nom }}</h5>
                                <small class="text-muted">
                                    <i class="bi bi-envelope me-1"></i> {{ $message->sender->email }}
                                </small>
                                @if($message->sender->role == 'formateur')
                                    <span class="badge bg-success ms-2">Formateur</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row g-3 text-muted small">
                            <div class="col-md-4">
                                <i class="bi bi-calendar me-1"></i>
                                <strong>Date:</strong> {{ $message->created_at->format('d/m/Y H:i') }}
                            </div>
                            @if($message->formation)
                            <div class="col-md-4">
                                <i class="bi bi-book me-1"></i>
                                <strong>Formation:</strong> {{ $message->formation->titre }}
                            </div>
                            @endif
                            <div class="col-md-4">
                                <i class="bi bi-envelope me-1"></i>
                                <strong>Statut:</strong> 
                                @if($message->lu)
                                    <span class="text-success">Lu</span>
                                @else
                                    <span class="text-warning">Non lu</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contenu du message -->
                    <div class="message-content p-4 bg-light rounded mb-4">
                        <p class="mb-0 fs-5">{{ $contenu }}</p>
                    </div>
                    
                    <!-- Bouton répondre -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('apprenant.messages.create', ['formateur_id' => $message->sender_id]) }}" 
                           class="btn btn-primary">
                            <i class="bi bi-reply me-2"></i>Répondre
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Messages précédents de la conversation -->
            @if($conversation->isNotEmpty())
            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">
                        <i class="bi bi-chat-dots me-2 text-primary"></i>
                        Conversation précédente
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($conversation as $oldMessage)
                        @php
                            $oldParts = explode("\n\n", $oldMessage->message, 2);
                            $oldSujet = $oldParts[0] ?? '';
                            $oldContenu = $oldParts[1] ?? $oldMessage->message;
                        @endphp
                        <div class="message-item {{ $oldMessage->sender_id == auth()->id() ? 'sent' : 'received' }} mb-3">
                            <div class="message-bubble p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong>{{ $oldMessage->sender->nom }}</strong>
                                    <small class="text-muted">{{ $oldMessage->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-0">{{ $oldContenu }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .message-avatar {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
    }
    
    .message-header {
        border-bottom: 2px solid #eef2f6;
        padding-bottom: 1rem;
    }
    
    .message-content {
        border-left: 4px solid var(--primary);
        font-size: 1.1rem;
        line-height: 1.6;
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
        background: {{ isset($oldMessage) && $oldMessage->sender_id == auth()->id() ? '#e3f2fd' : '#f8fafc' }};
        border: 1px solid #eef2f6;
    }
    
    .btn {
        border-radius: 50px;
    }
</style>
@endsection