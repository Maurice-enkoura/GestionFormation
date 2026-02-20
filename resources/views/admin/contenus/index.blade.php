{{-- resources/views/admin/contenus/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Contenus - Administration')
@section('page-title', 'Contenus du module')
@section('page-subtitle', 'Admin / Formations / Modules / Contenus')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-files me-2 text-primary"></i>
                    {{ $module->titre }} - Tous les contenus
                </h5>
                <a href="{{ route('admin.formations.modules.index', $module->formation) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Retour aux modules
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Vous êtes en mode consultation. Les modifications ne sont pas autorisées.
                </div>
                
                @if($contenus->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-files display-1 text-muted"></i>
                        <h4 class="mt-3">Aucun contenu</h4>
                        <p class="text-muted">Ce module n'a pas encore de contenu.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Date d'ajout</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contenus as $contenu)
                                <tr>
                                    <td>
                                        @if($contenu->type === 'video')
                                            <span class="badge bg-primary">Vidéo</span>
                                        @else
                                            <span class="badge bg-success">Document</span>
                                        @endif
                                    </td>
                                    <td>{{ $contenu->description ?? 'Aucune description' }}</td>
                                    <td>
                                        <a href="{{ $contenu->url }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">
                                            {{ $contenu->url }}
                                        </a>
                                    </td>
                                    <td>{{ $contenu->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ $contenu->url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Statistiques des contenus -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Répartition des contenus</h6>
                                    @php
                                        $videos = $contenus->where('type', 'video')->count();
                                        $documents = $contenus->where('type', 'document')->count();
                                    @endphp
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span><i class="bi bi-camera-video text-primary me-2"></i> Vidéos</span>
                                            <span class="badge bg-primary">{{ $videos }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><i class="bi bi-file-text text-success me-2"></i> Documents</span>
                                            <span class="badge bg-success">{{ $documents }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6>Informations</h6>
                                    <p class="mb-1"><strong>Module:</strong> {{ $module->titre }}</p>
                                    <p class="mb-1"><strong>Formation:</strong> {{ $module->formation->titre }}</p>
                                    <p class="mb-0"><strong>Total contenus:</strong> {{ $contenus->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection