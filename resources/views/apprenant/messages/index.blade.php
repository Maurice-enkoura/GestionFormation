{{-- resources/views/apprenant/messages/index.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Mes messages')
@section('page-subtitle', 'Boîte de réception')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-envelope me-2 text-primary"></i>
                        Messages
                        @if($nonLus > 0)
                            <span class="badge bg-danger ms-2">{{ $nonLus }} non lu(s)</span>
                        @endif
                    </h5>
                    <a href="{{ route('apprenant.messages.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Nouveau message
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($messages->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-envelope-open display-1 text-muted"></i>
                            <h4 class="mt-3">Aucun message</h4>
                            <p class="text-muted">Votre boîte de réception est vide.</p>
                            <a href="{{ route('apprenant.messages.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-pencil"></i> Écrire un message
                            </a>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($messages as $message)
                            <a href="{{ route('apprenant.messages.show', $message) }}" 
                               class="list-group-item list-group-item-action {{ !$message->lu && $message->receiver_id == Auth::id() ? 'bg-light fw-bold' : '' }}">
                                <div class="d-flex align-items-center">
                                    <div class="message-avatar me-3">
                                        {{ strtoupper(substr($message->sender->nom, 0, 2)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">
                                                {{ $message->sender->nom }}
                                                @if($message->sender->role == 'formateur')
                                                    <span class="badge bg-success bg-opacity-10 text-success ms-2">Formateur</span>
                                                @endif
                                            </h6>
                                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-1"><strong>{{ $message->sujet }}</strong></p>
                                        <p class="mb-0 text-truncate">{{ $message->contenu }}</p>
                                        @if($message->formation)
                                            <small class="text-muted">
                                                <i class="bi bi-book"></i> {{ $message->formation->titre }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @endif
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
                        @forelse($contacts as $contact)
                        <a href="{{ route('apprenant.messages.index', ['contact_id' => $contact->id]) }}" 
                           class="list-group-item list-group-item-action d-flex align-items-center">
                            <div class="contact-avatar me-2">
                                {{ strtoupper(substr($contact->nom, 0, 2)) }}
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $contact->nom }}</h6>
                                <small class="text-muted">{{ ucfirst($contact->role) }}</small>
                            </div>
                        </a>
                        @empty
                        <div class="list-group-item text-center py-4">
                            <p class="text-muted mb-0">Aucun contact</p>
                        </div>
                        @endforelse
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
@endsection