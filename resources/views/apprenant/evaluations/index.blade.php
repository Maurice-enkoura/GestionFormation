{{-- resources/views/apprenant/evaluations/index.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Mes évaluations')
@section('page-subtitle', 'Toutes vos notes et commentaires')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-star me-2 text-primary"></i>
                        Mes évaluations
                    </h5>
                </div>
                <div class="card-body">
                    @if($evaluations->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-star display-1 text-muted"></i>
                            <h4 class="mt-3">Aucune évaluation</h4>
                            <p class="text-muted">Vous n'avez pas encore évalué de formation.</p>
                            <a href="{{ route('apprenant.formations') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-book"></i> Voir mes formations
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Formation</th>
                                        <th>Note</th>
                                        <th>Commentaire</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluations as $evaluation)
                                    <tr>
                                        <td>
                                            <strong>{{ $evaluation->formation->titre }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $evaluation->formation->formateur->nom ?? 'Formateur' }}</small>
                                        </td>
                                        <td>
                                            <span class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $evaluation->note)
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                @endfor
                                                <span class="ms-2 fw-bold">{{ $evaluation->note }}/5</span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                                {{ $evaluation->commentaire ?? 'Aucun commentaire' }}
                                            </span>
                                        </td>
                                        <td>{{ $evaluation->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($evaluation->est_publiee)
                                                <span class="badge bg-success">Publiée</span>
                                            @else
                                                <span class="badge bg-warning">En attente</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('apprenant.formation.show', $evaluation->formation_id) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Voir la formation">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if(!$evaluation->est_publiee)
                                                <a href="{{ route('apprenant.evaluations.edit', $evaluation) }}" 
                                                   class="btn btn-sm btn-outline-warning" title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $evaluations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
    
    .table th {
        font-weight: 600;
        color: #475569;
    }
    
    .btn-outline-primary:hover i,
    .btn-outline-warning:hover i {
        color: white;
    }
</style>
@endsection