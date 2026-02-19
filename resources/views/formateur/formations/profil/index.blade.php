
@extends('layouts.formateur')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Mon profil</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="user-avatar mx-auto mb-3" style="width: 120px; height: 120px; font-size: 2.5rem;">
                        {{ strtoupper(substr($user->nom, 0, 2)) }}
                    </div>
                    <h4>{{ $user->nom }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p class="text-muted small">Membre depuis {{ $user->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5>Statistiques</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Formations créées:</span>
                        <strong>{{ $stats['formations'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Apprenants:</span>
                        <strong>{{ $stats['apprenants'] }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Modifier le profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('formateur.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom complet</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                            @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone', $user->telephone ?? '') }}">
                            @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="specialite" class="form-label">Spécialité</label>
                            <input type="text" class="form-control @error('specialite') is-invalid @enderror" 
                                   id="specialite" name="specialite" value="{{ old('specialite', $user->specialite ?? '') }}">
                            @error('specialite')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      id="bio" name="bio" rows="3">{{ old('bio', $user->bio ?? '') }}</textarea>
                            @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection