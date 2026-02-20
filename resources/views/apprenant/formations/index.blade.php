{{-- resources/views/apprenant/formations/index.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Mes formations')
@section('page-subtitle', 'Liste de toutes vos formations')

@section('content')
<div class="container-fluid">
    <div class="row">
        @forelse($inscriptions as $inscription)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-img-top" style="height: 140px; background-image: url('{{ $inscription->formation->image_url ?? 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}'); background-size: cover; background-position: center;"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $inscription->formation->titre }}</h5>
                    <p class="card-text text-muted small">
                        <i class="bi bi-person"></i> {{ $inscription->formation->formateur->nom ?? 'Formateur' }}
                    </p>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Progression</span>
                            <span>{{ rand(10, 90) }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: {{ rand(10, 90) }}%"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-{{ $inscription->statut == 'termine' ? 'success' : 'warning' }}">
                            {{ $inscription->statut }}
                        </span>
                        <div>
                            <a href="{{ route('apprenant.formation.show', $inscription->formation->id) }}" class="btn btn-sm btn-primary">
                                Voir plus
                            </a>
                            @if($inscription->statut == 'termine')
                                <a href="{{ route('apprenant.evaluations.create', $inscription->formation->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-star"></i> Évaluer
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted"></i>
                <h4 class="mt-3">Aucune formation</h4>
                <p class="text-muted">Vous n'êtes inscrit à aucune formation pour le moment.</p>
                <a href="{{ route('formations') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-search"></i> Explorer les formations
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $inscriptions->links() }}
    </div>
</div>
@endsection