
@extends('layouts.formateur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Mes formations</h1>
        <a href="{{ route('formateur.formations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouvelle formation
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        @forelse($formations as $formation)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top bg-light" style="height: 140px; background-image: url('{{ $formation->image_url ?? 'https://via.placeholder.com/300x140' }}'); background-size: cover; background-position: center;"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $formation->titre }}</h5>
                    <p class="card-text text-muted small">
                        <i class="bi bi-calendar"></i> {{ $formation->date_debut->format('d/m/Y') }} - {{ $formation->date_fin->format('d/m/Y') }}
                    </p>
                    <div class="d-flex justify-content-between mb-2">
                        <span><i class="bi bi-files"></i> {{ $formation->modules_count }} modules</span>
                        <span><i class="bi bi-people"></i> {{ $formation->inscriptions_count }} apprenants</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('formateur.formations.show', $formation) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Voir
                        </a>
                        <a href="{{ route('formateur.formations.edit', $formation) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted"></i>
                <h4 class="mt-3">Aucune formation</h4>
                <p class="text-muted">Commencez par créer votre première formation.</p>
                <a href="{{ route('formateur.formations.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Créer une formation
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $formations->links() }}
    </div>
</div>
@endsection