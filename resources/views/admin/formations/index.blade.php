{{-- resources/views/admin/formations/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Gestion des formations')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Gestion des formations</h1>
        <a href="{{ route('admin.formations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle formation
        </a>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total formations</h5>
                    <h2>{{ $stats['total'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Publiées</h5>
                    <h2>{{ $stats['publiees'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Inscriptions</h5>
                    <h2>{{ $stats['inscriptions'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Rechercher une formation..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="formateur_id" class="form-select">
                        <option value="">Tous les formateurs</option>
                        @foreach($formateurs as $formateur)
                            <option value="{{ $formateur->id }}" {{ request('formateur_id') == $formateur->id ? 'selected' : '' }}>
                                {{ $formateur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.formations.index') }}" class="btn btn-secondary w-100">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des formations -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Formateur</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Modules</th>
                            <th>Inscrits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formations as $formation)
                        <tr>
                            <td>
                                <strong>{{ $formation->titre }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($formation->description, 50) }}</small>
                            </td>
                            <td>{{ $formation->formateur->nom ?? 'Non assigné' }}</td>
                            <td>{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-info">{{ $formation->modules->count() }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $formation->inscriptions_count ?? 0 }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.formations.show', $formation) }}" class="btn btn-sm btn-info" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.formations.edit', $formation) }}" class="btn btn-sm btn-primary" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin.formations.statistiques', $formation) }}" class="btn btn-sm btn-warning" title="Statistiques">
                                        <i class="bi bi-graph-up"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="confirmDelete({{ $formation->id }})" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                
                                <form id="delete-form-{{ $formation->id }}" 
                                      action="{{ route('admin.formations.destroy', $formation) }}" 
                                      method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune formation trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $formations->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(formationId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')) {
        document.getElementById('delete-form-' + formationId).submit();
    }
}
</script>
@endpush
@endsection