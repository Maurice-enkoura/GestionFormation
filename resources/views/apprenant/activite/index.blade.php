{{-- resources/views/apprenant/activite/index.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Mon activité')
@section('page-subtitle', 'Historique de vos actions sur la plateforme')

@section('content')
<div class="container-fluid">
    <!-- En-tête avec statistiques -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total inscriptions</h5>
                    <h2>{{ $stats['total_inscriptions'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Ressources consultées</h5>
                    <h2>{{ $stats['total_contenus'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Dernière activité</h5>
                    <h6>{{ $stats['derniere_activite'] ? $stats['derniere_activite']->diffForHumans() : 'Aucune' }}</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('apprenant.activite') }}" class="row g-3">
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="tout" {{ request('type') == 'tout' ? 'selected' : '' }}>Toutes les activités</option>
                        <option value="inscription" {{ request('type') == 'inscription' ? 'selected' : '' }}>Inscriptions</option>
                        <option value="ressource" {{ request('type') == 'ressource' ? 'selected' : '' }}>Ressources</option>
                        <option value="progression" {{ request('type') == 'progression' ? 'selected' : '' }}>Progressions</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des activités -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Historique des activités</h5>
        </div>
        <div class="card-body">
            @forelse($activites as $activite)
            <div class="activity-item d-flex align-items-start mb-4 pb-3 border-bottom">
                <div class="activity-icon me-3" style="background: rgba(99, 102, 241, 0.1); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-{{ $activite->icone }} fs-4" style="color: var(--primary);"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-1">{{ $activite->titre }}</h5>
                        <small class="text-muted">{{ $activite->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $activite->description }}</p>
                    @if(isset($activite->formation))
                    <small class="text-muted">
                        <i class="bi bi-book"></i> {{ $activite->formation->titre }}
                    </small>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-activity display-1 text-muted"></i>
                <h4 class="mt-3">Aucune activité</h4>
                <p class="text-muted">Commencez à apprendre pour voir votre activité</p>
                <a href="{{ route('formations') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-search"></i> Explorer les formations
                </a>
            </div>
            @endforelse

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $activites->links() }}
            </div>
        </div>
    </div>
</div>
@endsection