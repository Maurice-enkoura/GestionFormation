{{-- resources/views/apprenant/ressources/index.blade.php --}}
@extends('layouts.apprenant')

@section('page-title', 'Mes ressources')
@section('page-subtitle', 'Tous les contenus de vos formations')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        @forelse($contenus as $contenu)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="resource-icon me-3" style="width: 50px; height: 50px; background: rgba(99, 102, 241, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-{{ $contenu->type == 'video' ? 'play' : 'text' }} fs-3" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">{{ Str::limit($contenu->description ?? 'Ressource', 30) }}</h6>
                            <small class="text-muted">{{ $contenu->type ?? 'Document' }}</small>
                        </div>
                    </div>
                    
                    <p class="small text-muted mb-2">
                        <i class="bi bi-book"></i> {{ $contenu->module->formation->titre ?? 'Formation' }}
                    </p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Ajouté {{ $contenu->created_at->diffForHumans() }}</small>
                        <a href="{{ $contenu->url }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-download"></i> Télécharger
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-files display-1 text-muted"></i>
                <h4 class="mt-3">Aucune ressource</h4>
                <p class="text-muted">Aucune ressource n'est disponible pour le moment.</p>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $contenus->links() }}
    </div>
</div>
@endsection