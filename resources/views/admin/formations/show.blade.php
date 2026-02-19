{{-- resources/views/admin/formations/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Détails de la formation')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Détails de la formation</h1>
        <div>
            <a href="{{ route('admin.formations.edit', $formation) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i> Modifier
            </a>
            <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Informations générales</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 200px;">Titre</th>
                            <td>{{ $formation->titre }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $formation->description ?: 'Aucune description' }}</td>
                        </tr>
                        <tr>
                            <th>Formateur</th>
                            <td>
                                @if($formation->formateur)
                                    {{ $formation->formateur->nom }} ({{ $formation->formateur->email }})
                                @else
                                    <span class="text-muted">Non assigné</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date de début</th>
                            <td>{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Date de fin</th>
                            <td>{{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Date de création</th>
                            <td>{{ $formation->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Statistiques</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Modules</label>
                        <h3>{{ $formation->modules->count() }}</h3>
                    </div>
                    <div class="mb-3">
                        <label>Inscriptions</label>
                        <h3>{{ $formation->inscriptions->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modules de la formation -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Modules de la formation</h5>
        </div>
        <div class="card-body">
            @if($formation->modules->count() > 0)
                <div class="accordion" id="modulesAccordion">
                    @foreach($formation->modules as $index => $module)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#module{{ $module->id }}">
                                    <strong>{{ $module->titre }}</strong>
                                </button>
                            </h2>
                            <div id="module{{ $module->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                 data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p>{{ $module->description ?: 'Aucune description' }}</p>
                                    
                                    @if($module->contenus->count() > 0)
                                        <h6>Contenus :</h6>
                                        <ul class="list-group">
                                            @foreach($module->contenus as $contenu)
                                                <li class="list-group-item">
                                                    <i class="bi bi-{{ $contenu->type == 'video' ? 'camera-video' : 'file-text' }} me-2"></i>
                                                    <a href="{{ $contenu->url }}" target="_blank">{{ $contenu->description ?: 'Contenu' }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center">Aucun module pour cette formation</p>
            @endif
        </div>
    </div>
</div>
@endsection