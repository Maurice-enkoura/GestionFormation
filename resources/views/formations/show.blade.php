@extends('layouts.app')

@section('title', $formation->titre . ' - EduForm')

@section('content')
<div class="container py-5">
    <!-- Fil d'Ariane -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('formations') }}" class="text-decoration-none">Formations</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $formation->titre }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Image de la formation -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <img src="{{ $formation->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                     class="img-fluid w-100" 
                     alt="{{ $formation->titre }}"
                     style="height: 400px; object-fit: cover;">
            </div>

            <!-- Titre et description -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h1 class="display-5 fw-bold mb-3">{{ $formation->titre }}</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="bi bi-person-circle text-primary fs-5"></i>
                        </div>
                        <span class="fw-semibold">Par {{ $formation->formateur->nom ?? 'Formateur' }}</span>
                        
                        <span class="mx-3 text-muted">|</span>
                        
                        <i class="bi bi-calendar-check text-primary me-1"></i>
                        <span>{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</span>
                    </div>

                    <h5 class="fw-bold mb-3">Description</h5>
                    <p class="text-secondary mb-4" style="line-height: 1.8;">{{ $formation->description ?? 'Aucune description disponible.' }}</p>

                    <!-- Note moyenne -->
                    @if($noteMoyenne > 0)
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-2 px-3">
                            <i class="bi bi-star-fill text-warning me-2"></i>
                            <span class="fw-bold">{{ number_format($noteMoyenne, 1) }}/5</span>
                            <span class="text-muted ms-2">({{ $formation->evaluations->count() }} avis)</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Modules et contenu -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">Contenu de la formation</h4>
                </div>
                <div class="card-body p-4">
                    @if($formation->modules && $formation->modules->count() > 0)
                        <div class="accordion" id="modulesAccordion">
                            @foreach($formation->modules as $index => $module)
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }} bg-light rounded-3" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#module{{ $module->id }}">
                                        <i class="bi bi-folder2-open text-primary me-3"></i>
                                        <span class="fw-semibold">{{ $module->titre }}</span>
                                    </button>
                                </h2>
                                <div id="module{{ $module->id }}" 
                                     class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                     data-bs-parent="#modulesAccordion">
                                    <div class="accordion-body p-4">
                                        @if($module->description)
                                            <p class="text-muted mb-3">{{ $module->description }}</p>
                                        @endif
                                        
                                        @if($module->contenus && $module->contenus->count() > 0)
                                            <ul class="list-group list-group-flush">
                                                @foreach($module->contenus as $contenu)
                                                <li class="list-group-item d-flex align-items-center border-0 ps-0">
                                                    <i class="bi bi-{{ $contenu->type == 'video' ? 'play-circle' : 'file-text' }} text-primary me-3 fs-5"></i>
                                                    <span>{{ $contenu->description ?? 'Contenu' }}</span>
                                                    @if($contenu->url)
                                                    <a href="{{ $contenu->url }}" target="_blank" class="ms-auto btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        <i class="bi bi-box-arrow-up-right me-1"></i>Voir
                                                    </a>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-muted fst-italic mb-0">Aucun contenu disponible pour ce module.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted fst-italic mb-0">Aucun module disponible pour cette formation.</p>
                    @endif
                </div>
            </div>

            <!-- Avis des apprenants -->
            @if($formation->evaluations && $formation->evaluations->count() > 0)
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">Avis des apprenants</h4>
                </div>
                <div class="card-body p-4">
                    @foreach($formation->evaluations as $evaluation)
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="bi bi-person text-primary"></i>
                            </div>
                            <span class="fw-semibold">{{ $evaluation->user->nom ?? 'Apprenant' }}</span>
                            <span class="mx-2 text-muted">•</span>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $evaluation->note ? '-fill text-warning' : '' }} me-1"></i>
                            @endfor
                        </div>
                        <p class="text-secondary ms-4 ps-2">"{{ $evaluation->commentaire }}"</p>
                        <small class="text-muted ms-4 ps-2">{{ $evaluation->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Colonne latérale -->
       <!-- Colonne latérale -->
<div class="col-lg-4">
    <div class="card border-0 shadow-sm rounded-4 mb-4 sticky-top" style="top: 100px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Informations</h5>
            
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                    <i class="bi bi-calendar-week text-primary"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Date de début</small>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                    <i class="bi bi-calendar-check text-primary"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Date de fin</small>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                    <i class="bi bi-files text-primary"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Modules</small>
                    <span class="fw-semibold">{{ $formation->modules->count() }} module(s)</span>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">Formateur</h5>
            <div class="d-flex align-items-center mb-4">
                <div class="formateur-avatar me-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.5rem;">
                    {{ strtoupper(substr($formation->formateur->nom ?? 'F', 0, 2)) }}
                </div>
                <div>
                    <span class="fw-bold d-block">{{ $formation->formateur->nom ?? 'Non assigné' }}</span>
                    <small class="text-muted">{{ $formation->formateur->email ?? '' }}</small>
                </div>
            </div>

           {{-- Bouton d'inscription / accès --}}
@guest
    {{-- Non connecté → vers register --}}
    <a href="{{ route('register') }}" class="btn btn-primary w-100 py-3 rounded-pill mb-2">
        <i class="bi bi-person-plus me-2"></i>S'inscrire à cette formation
    </a>
@endguest

@auth
    @if(auth()->user()->role === 'apprenant')
        @php
            // Vérifier si l'apprenant est déjà inscrit à cette formation
            $estInscrit = $formation->inscriptions
                ->where('user_id', auth()->id())
                ->where('statut', 'en_cours')
                ->isNotEmpty();
        @endphp

        @if($estInscrit)
            {{-- Déjà inscrit → accéder au dashboard --}}
            <a href="{{ route('apprenant.dashboard') }}" class="btn btn-outline-primary w-100 py-3 rounded-pill mb-2">
                <i class="bi bi-speedometer2 me-2"></i>Voir ma formation
            </a>
        @else
            {{-- Pas encore inscrit → formulaire POST --}}
            <form action="{{ route('apprenant.formations.inscrire', $formation->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill mb-2">
                    <i class="bi bi-person-plus me-2"></i>S'inscrire à cette formation
                </button>
            </form>
        @endif
    @endif
@endauth


        </div>
    </div>
</div>

    </div>

    <!-- Formations similaires -->
    @if($formationsSimilaires && $formationsSimilaires->count() > 0)
    <section class="mt-5 pt-4">
        <h3 class="fw-bold mb-4">Formations similaires</h3>
        <div class="row g-4">
            @foreach($formationsSimilaires as $similaire)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <img src="{{ $similaire->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                         class="card-img-top rounded-top-4" 
                         alt="{{ $similaire->titre }}"
                         style="height: 150px; object-fit: cover;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-2">{{ $similaire->titre }}</h6>
                        <p class="small text-muted mb-2">{{ Str::limit($similaire->description, 60) }}</p>
                        <a href="{{ route('formations.show', $similaire->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            Voir <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection

<style>
.formateur-avatar {
    box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
}
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: var(--primary);
}
.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(99, 102, 241, 0.1);
}
</style>