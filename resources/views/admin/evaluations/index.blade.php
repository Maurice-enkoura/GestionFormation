{{-- resources/views/admin/evaluations/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modération des évaluations - Administration')
@section('page-title', 'Modération des évaluations')
@section('page-subtitle', 'Admin / Évaluations')

@section('content')
<!-- Filtres -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.evaluations.index') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <select name="statut" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="publiee" {{ request('statut') == 'publiee' ? 'selected' : '' }}>Publiée</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Liste des évaluations -->
<div class="card">
    <div class="card-body">
        @if($evaluations->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-star display-1 text-muted"></i>
                <h4 class="mt-3">Aucune évaluation</h4>
                <p class="text-muted">Il n'y a pas d'évaluations à modérer pour le moment.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Apprenant</th>
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
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar-sm me-2">
                                        {{ strtoupper(substr($evaluation->user->nom, 0, 2)) }}
                                    </div>
                                    {{ $evaluation->user->nom }}
                                </div>
                            </td>
                            <td>{{ $evaluation->formation->titre }}</td>
                            <td>
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $evaluation->note)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
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
                                <div class="btn-group">
                                    <a href="{{ route('admin.evaluations.show', $evaluation) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if(!$evaluation->est_publiee)
                                        <form action="{{ route('admin.evaluations.approuver', $evaluation) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Approuver">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $evaluation->id }}">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    @endif
                                </div>
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

<!-- Modals de rejet -->
@foreach($evaluations as $evaluation)
@if(!$evaluation->est_publiee)
<div class="modal fade" id="rejectModal{{ $evaluation->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.evaluations.rejeter', $evaluation) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Rejeter l'évaluation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir rejeter cette évaluation ?</p>
                    <div class="mb-3">
                        <label for="motif" class="form-label">Motif du rejet</label>
                        <textarea class="form-control" id="motif" name="motif" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Rejeter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach

<style>
    .user-avatar-sm {
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
    }
</style>
@endsection