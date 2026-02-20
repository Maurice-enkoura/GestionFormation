{{-- resources/views/admin/modules/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modules - Administration')
@section('page-title', 'Modules de la formation')
@section('page-subtitle', 'Admin / Formations / Modules')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-collection me-2 text-primary"></i>
                    {{ $formation->titre }} - Modules et contenus
                </h5>
                <a href="{{ route('admin.formations.show', $formation) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Retour à la formation
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Vous êtes en mode lecture seule. Seuls les formateurs peuvent modifier les modules et contenus.
                </div>
                
                @if($modules->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-collection display-1 text-muted"></i>
                        <h4 class="mt-3">Aucun module</h4>
                        <p class="text-muted">Cette formation n'a pas encore de modules.</p>
                    </div>
                @else
                    @foreach($modules as $index => $module)
                    <div class="module-card card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                Module {{ $index + 1 }} : {{ $module->titre }}
                            </h5>
                            @if($module->description)
                                <small class="text-muted">{{ $module->description }}</small>
                            @endif
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Contenus du module :</h6>
                            
                            @if($module->contenus->isEmpty())
                                <p class="text-muted">Aucun contenu dans ce module</p>
                            @else
                                <div class="list-group">
                                    @foreach($module->contenus as $contenu)
                                    <div class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            @if($contenu->type === 'video')
                                                <i class="bi bi-camera-video text-primary me-3 fs-4"></i>
                                            @else
                                                <i class="bi bi-file-text text-success me-3 fs-4"></i>
                                            @endif
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between">
                                                    <strong>{{ ucfirst($contenu->type) }}</strong>
                                                    <small class="text-muted">{{ $contenu->created_at->format('d/m/Y') }}</small>
                                                </div>
                                                @if($contenu->description)
                                                    <p class="mb-1">{{ $contenu->description }}</p>
                                                @endif
                                                <a href="{{ $contenu->url }}" target="_blank" class="btn btn-sm btn-link p-0">
                                                    <i class="bi bi-box-arrow-up-right"></i> Voir le contenu
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                            
                            <!-- Lien pour voir tous les contenus -->
                            @if($module->contenus->isNotEmpty())
                                <div class="mt-3 text-end">
                                    <a href="{{ route('admin.modules.contenus.index', $module) }}" class="btn btn-sm btn-outline-primary">
                                        Voir tous les contenus
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection