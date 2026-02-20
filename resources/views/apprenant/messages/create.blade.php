{{-- resources/views/apprenant/messages/create.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Nouveau message')
@section('page-subtitle', 'Envoyer un message à un formateur')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>
                        Rédiger un message
                    </h5>
                    <a href="{{ route('apprenant.messages.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('apprenant.messages.store') }}" method="POST">
                        @csrf
                        
                        <!-- Destinataire -->
                        <div class="mb-3">
                            <label for="receiver_id" class="form-label">Destinataire <span class="text-danger">*</span></label>
                            <select class="form-select @error('receiver_id') is-invalid @enderror" 
                                    id="receiver_id" name="receiver_id" required>
                                <option value="">Sélectionner un formateur</option>
                                @foreach($formateurs as $formateur)
                                    <option value="{{ $formateur->id }}" {{ old('receiver_id', $selectedFormateur) == $formateur->id ? 'selected' : '' }}>
                                        {{ $formateur->nom }} ({{ $formateur->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('receiver_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Formation concernée (optionnel) -->
                        <div class="mb-3">
                            <label for="formation_id" class="form-label">Formation concernée (optionnel)</label>
                            <select class="form-select @error('formation_id') is-invalid @enderror" 
                                    id="formation_id" name="formation_id">
                                <option value="">Sélectionner une formation</option>
                                @foreach($formations as $formation)
                                    <option value="{{ $formation->id }}" {{ old('formation_id', $selectedFormation) == $formation->id ? 'selected' : '' }}>
                                        {{ $formation->titre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('formation_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sujet -->
                        <div class="mb-3">
                            <label for="sujet" class="form-label">Sujet <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('sujet') is-invalid @enderror" 
                                   id="sujet" name="sujet" value="{{ old('sujet') }}" 
                                   placeholder="Ex: Question sur le module 2" required>
                            @error('sujet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Message -->
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('contenu') is-invalid @enderror" 
                                      id="contenu" name="contenu" rows="6" 
                                      placeholder="Écrivez votre message ici..." required>{{ old('contenu') }}</textarea>
                            @error('contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Boutons -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-eraser me-2"></i>Effacer
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Conseils -->
            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i>
                        Conseils pour bien rédiger vos messages
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Soyez clair et précis dans votre sujet
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Mentionnez la formation concernée si nécessaire
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Restez courtois et professionnel
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Vérifiez l'orthographe avant d'envoyer
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.7rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 150px;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.6rem 1.8rem;
        font-weight: 600;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }
</style>
@endsection