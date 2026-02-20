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
                    <form action="{{ route('apprenant.evaluations.store', $formation) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Votre note</label>
                            <div class="rating-input">
                                @for($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="note" id="star{{ $i }}" value="{{ $i }}" required>
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
                        </div>

                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Votre commentaire (optionnel)</label>
                            <textarea class="form-control" id="commentaire" name="commentaire" rows="5" placeholder="Partagez votre expérience...">{{ old('commentaire') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('apprenant.formation.show', $formation) }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Envoyer mon évaluation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rating-input .form-check {
        padding-left: 0;
        margin-right: 1rem;
    }
    
    .rating-input .form-check-input {
        margin-right: 0.5rem;
        cursor: pointer;
    }
    
    .rating-input .form-check-label {
        cursor: pointer;
    }
    
    .rating-input .form-check-input:checked ~ .form-check-label {
        font-weight: bold;
    }
</style>
@endsection