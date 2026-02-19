
@extends('layouts.formateur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Profil apprenant</h1>
        <a href="{{ route('formateur.apprenants.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="user-avatar mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2rem;">
                        {{ strtoupper(substr($apprenant->nom, 0, 2)) }}
                    </div>
                    <h4>{{ $apprenant->nom }}</h4>
                    <p class="text-muted">{{ $apprenant->email }}</p>
                    <p class="text-muted small">Membre depuis {{ $apprenant->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5>Statistiques</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total formations:</span>
                        <strong>{{ $stats['total_formations'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>En cours:</span>
                        <strong>{{ $stats['formations_en_cours'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Terminées:</span>
                        <strong>{{ $stats['formations_terminees'] }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formations suivies</h5>
                </div>
                <div class="card-body">
                    @forelse($inscriptions as $inscription)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>{{ $inscription->formation->titre }}</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-{{ $inscription->statut == 'termine' ? 'success' : 'warning' }}">
                                    {{ $inscription->statut }}
                                </span>
                                <small class="text-muted ms-2">Inscrit le {{ $inscription->created_at->format('d/m/Y') }}</small>
                            </div>
                            <a href="{{ route('formateur.formations.show', $inscription->formation) }}" class="btn btn-sm btn-outline-primary">
                                Voir la formation
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted py-3">Aucune inscription</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection