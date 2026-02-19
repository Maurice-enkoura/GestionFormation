{{-- resources/views/admin/utilisateurs/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Détails de l\'utilisateur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Détails de l'utilisateur</h1>
        <div>
            <a href="{{ route('admin.utilisateurs.edit', $user->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                        {{ strtoupper(substr($user->nom, 0, 2)) }}
                    </div>
                    <h4>{{ $user->nom }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'formateur' ? 'info' : 'success') }}">
                        {{ ucfirst($user->role) }}
                    </span>
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
                            <td>{{ $user->nom }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rôle</th>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                        <tr>
                            <th>Date d'inscription</th>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($user->role == 'formateur' && $user->formations->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Formations créées</h5>
                </div>
                <div class="card-body">
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
                                @foreach($user->formations as $formation)
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
                </div>
            </div>
            @endif

            @if($user->role == 'apprenant' && $user->inscriptions->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Inscriptions aux formations</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Formation</th>
                                    <th>Date d'inscription</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->inscriptions as $inscription)
                                <tr>
                                    <td>{{ $inscription->formation->titre }}</td>
                                    <td>{{ \Carbon\Carbon::parse($inscription->date_inscription)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $inscription->statut == 'valide' ? 'success' : ($inscription->statut == 'en_cours' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($inscription->statut) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection