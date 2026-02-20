{{-- resources/views/admin/messages/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Détail du message - Administration')
@section('page-title', 'Détail du message')
@section('page-subtitle', 'Admin / Messages / Détail')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-envelope me-2 text-primary"></i>
                    Message
                </h5>
                <div>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="message-avatar me-3">
                                    {{ strtoupper(substr($message->sender->nom, 0, 2)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1">De : {{ $message->sender->nom }}</h6>
                                    <small class="text-muted">{{ $message->sender->email }}</small>
                                    <span class="badge bg-{{ $message->sender->role === 'apprenant' ? 'primary' : ($message->sender->role === 'formateur' ? 'success' : 'danger') }} ms-2">
                                        {{ ucfirst($message->sender->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="message-avatar me-3 bg-secondary">
                                    {{ strtoupper(substr($message->receiver->nom, 0, 2)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1">À : {{ $message->receiver->nom }}</h6>
                                    <small class="text-muted">{{ $message->receiver->email }}</small>
                                    <span class="badge bg-{{ $message->receiver->role === 'apprenant' ? 'primary' : ($message->receiver->role === 'formateur' ? 'success' : 'danger') }} ms-2">
                                        {{ ucfirst($message->receiver->role) }}
                                    </span>
                                </div>
                            </div>
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
                
                <!-- Sujet -->
                <div class="mb-3">
                    <h6 class="text-muted mb-2">Sujet</h6>
                    <div class="p-3 bg-light rounded">
                        <strong>{{ $sujet }}</strong>
                    </div>
                </div>
                
                <!-- Contenu -->
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Message</h6>
                    <div class="message-content p-4 bg-light rounded">
                        <p class="mb-0">{{ $contenu }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .message-avatar.bg-secondary {
        background: linear-gradient(135deg, #64748b, #475569);
    }
    
    .message-header {
        border-bottom: 2px solid #eef2f6;
        padding-bottom: 1rem;
    }
    
    .message-content {
        border-left: 4px solid var(--primary);
        font-size: 1rem;
        line-height: 1.6;
        white-space: pre-line;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
</style>
@endsection