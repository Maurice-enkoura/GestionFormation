{{-- resources/views/formateur/messages/create.blade.php --}}
@extends('layouts.formateur')

@section('title', 'Nouveau message - Espace Formateur')
@section('page-title', 'Nouveau message')
@section('page-subtitle', 'Formateur / Messages / Nouveau')

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
                    <a href="{{ route('formateur.messages.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('formateur.messages.store') }}" method="POST">
                        @csrf
                        
                        <!-- Destinataire -->
                        <div class="mb-3">
                            <label for="receiver_id" class="form-label">Destinataire <span class="text-danger">*</span></label>
                            <select class="form-select @error('receiver_id') is-invalid @enderror" 
                                    id="receiver_id" name="receiver_id" required>
                                <option value="">Sélectionner un apprenant</option>
                                @foreach($apprenants as $apprenant)
                                    <option value="{{ $apprenant->id }}" {{ old('receiver_id', $selectedApprenant) == $apprenant->id ? 'selected' : '' }}>
                                        {{ $apprenant->nom }} ({{ $apprenant->email }})
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
                        
                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="5" 
                                      placeholder="Écrivez votre message ici..." required>{{ old('message') }}</textarea>
                            @error('message')
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
        min-height: 120px;
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