
@extends('layouts.apprenant')

@section('page-title', $formation->titre)
@section('page-subtitle', 'Détails de la formation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- Informations principales -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Description</h4>
                    <p>{{ $formation->description ?? 'Aucune description disponible.' }}</p>

                   <div class="row mt-4">
    <div class="col-md-6">
        <p>
            <i class="bi bi-calendar"></i> Début : 
            {{ $formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : 'Non renseigné' }}
        </p>
    </div>
    <div class="col-md-6">
        <p>
            <i class="bi bi-calendar-check"></i> Fin : 
            {{ $formation->date_fin ? \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') : 'Non renseigné' }}
        </p>
    </div>
</div>

                </div>
            </div>

            <!-- Modules et contenus -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Contenu de la formation</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="modulesAccordion">
                        @foreach($formation->modules as $index => $module)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $module->id }}">
                                    {{ $module->titre }}
                                </button>
                            </h2>
                            <div id="module{{ $module->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent="#modulesAccordion">
                                <div class="accordion-body">
                                    <p>{{ $module->description ?? 'Aucune description' }}</p>

                                    @if($module->contenus->count() > 0)
                                    <h6 class="mt-3">Contenus :</h6>
                                    <ul class="list-group">
                                        @foreach($module->contenus as $contenu)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-{{ $contenu->type == 'video' ? 'play-circle' : 'file-text' }} me-2"></i>
                                                {{ $contenu->description ?? 'Contenu' }}
                                            </div>
                                            <a href="{{ $contenu->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-box-arrow-up-right"></i> Voir
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Informations sur le formateur -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Formateur</h5>
                </div>
                <div class="card-body text-center">
                    <div class="user-avatar mx-auto mb-3" style="width: 80px; height: 80px;">
                        {{ strtoupper(substr($formation->formateur->nom ?? 'F', 0, 2)) }}
                    </div>
                    <h5>{{ $formation->formateur->nom ?? 'Non assigné' }}</h5>
                    <p class="text-muted small">{{ $formation->formateur->email ?? '' }}</p>
                </div>
            </div>

            <!-- Progression -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ma progression</h5>
                </div>
                <div class="card-body">
                    <h2 class="text-center text-primary">{{ rand(10, 90) }}%</h2>
                    <div class="progress mt-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ rand(10, 90) }}%"></div>
                    </div>
                    <p class="text-center text-muted small mt-2">
                        {{ $totalContenus ?? 0 }} contenus au total
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <a href="#" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-play-circle"></i> Continuer
                    </a>
                    <a href="{{ route('apprenant.ressources') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-download"></i> Voir les ressources
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection