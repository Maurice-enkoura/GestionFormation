{{-- resources/views/admin/formateurs/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Détails du formateur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Détails du formateur</h1>
        <div>
            <a href="{{ route('admin.formateurs.edit', $formateur) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <a href="{{ route('admin.formateurs.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="user-avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                        {{ strtoupper(substr($formateur->nom, 0, 2)) }}
                    </div>
                    <h4>{{ $formateur->nom }}</h4>
                    <p class="text-muted">{{ $formateur->email }}</p>
                    <span class="badge bg-info">Formateur</span>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Total formations</label>
                        <h3>{{ $stats['total_formations'] }}</h3>
                    </div>
                    <div class="mb-3">
                        <label>Total inscriptions</label>
                        <h3>{{ $stats['total_inscriptions'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Informations personnelles</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Nom</th>
                            <td>{{ $formateur->nom }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $formateur->email }}</td>
                        </tr>
                        <tr>
                            <th>Date d'inscription</th>
                            <td>{{ $formateur->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Formations créées</h5>
                </div>
                <div class="card-body">
                    @if($formateur->formations->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Inscriptions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formateur->formations as $formation)
                                    <tr>
                                        <td>{{ $formation->titre }}</td>
                                        <td>{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}</td>
                                        <td>{{ $formation->inscriptions_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">Aucune formation créée</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection