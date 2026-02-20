{{-- resources/views/apprenant/evaluations/create.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Évaluer la formation')
@section('page-subtitle', $formation->titre)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Donnez votre avis</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <form action="{{ route('apprenant.evaluations.store', $formation) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">Votre note <span class="text-danger">*</span></label>
                            <div class="rating-input">
                                @for($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="note" id="star{{ $i }}" value="{{ $i }}" {{ old('note') == $i ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="star{{ $i }}">
                                        @for($j = 1; $j <= $i; $j++)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @endfor
                                        @for($j = $i+1; $j <= 5; $j++)
                                            <i class="bi bi-star text-warning"></i>
                                        @endfor
                                    </label>
                                </div>
                                @endfor
                            </div>
                            @error('note')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="commentaire" class="form-label fw-bold">Votre commentaire (optionnel)</label>
                            <textarea class="form-control @error('commentaire') is-invalid @enderror" 
                                      id="commentaire" name="commentaire" rows="5" 
                                      placeholder="Partagez votre expérience...">{{ old('commentaire') }}</textarea>
                            @error('commentaire')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">500 caractères maximum</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('apprenant.formation.show', $formation) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Retour à la formation
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Envoyer mon évaluation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Rappel des règles de modération -->
            <div class="card mt-4">
                <div class="card-body bg-light">
                    <h6 class="mb-3"><i class="bi bi-shield-check text-primary me-2"></i>Règles de modération</h6>
                    <ul class="small text-muted mb-0">
                        <li>Les évaluations sont modérées avant publication</li>
                        <li>Restez courtois et respectueux</li>
                        <li>Les commentaires inappropriés seront supprimés</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rating-input .form-check {
        padding-left: 0;
        margin-right: 1.5rem;
    }
    
    .rating-input .form-check-input {
        margin-right: 0.5rem;
        cursor: pointer;
        width: 1.2rem;
        height: 1.2rem;
    }
    
    .rating-input .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .rating-input .form-check-label {
        cursor: pointer;
        font-size: 1.2rem;
    }
    
    .rating-input .form-check-input:checked ~ .form-check-label {
        font-weight: bold;
    }
    
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        border-radius: 20px;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.6rem 2rem;
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