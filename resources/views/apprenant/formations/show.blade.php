{{-- resources/views/apprenant/formations/show.blade.php --}}
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
                    @php
                        // Simuler une progression (à remplacer par votre logique réelle)
                        $progression = rand(10, 90);
                        $estTermine = $progression >= 100;
                    @endphp
                    <h2 class="text-center text-primary">{{ $progression }}%</h2>
                    <div class="progress mt-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ $progression }}%"></div>
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
                    <a href="{{ route('apprenant.ressources') }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-download"></i> Voir les ressources
                    </a>
                    
                    @if($progression >= 100 || $inscription->statut == 'termine')
                        @php
                            $dejaEvalue = \App\Models\Evaluation::where('user_id', auth()->id())
                                ->where('formation_id', $formation->id)
                                ->exists();
                        @endphp
                        
                        @if($dejaEvalue)
                            <button class="btn btn-success w-100" disabled>
                                <i class="bi bi-check-circle"></i> Déjà évalué
                            </button>
                        @else
                            <a href="{{ route('apprenant.evaluations.create', $formation->id) }}" class="btn btn-warning w-100">
                                <i class="bi bi-star"></i> Évaluer cette formation
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .user-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 2rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        border-radius: 20px;
    }
    
    .card-header {
        background: white;
        border-bottom: 1px solid #eef2f6;
        padding: 1.2rem 1.5rem;
        border-radius: 20px 20px 0 0 !important;
        font-weight: 600;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.7rem 1rem;
        font-weight: 500;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }
    
    .btn-warning {
        background: #f59e0b;
        border: none;
        color: white;
    }
    
    .btn-warning:hover {
        background: #d97706;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
    }
    
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
        color: var(--primary);
    }
    
    .list-group-item {
        border: 1px solid #eef2f6;
        border-radius: 12px !important;
        margin-bottom: 0.5rem;
    }
</style>
@endsection