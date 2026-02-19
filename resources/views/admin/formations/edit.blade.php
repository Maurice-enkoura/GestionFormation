{{-- resources/views/admin/formations/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier la formation')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Modifier la formation</h1>
        <a href="{{ route('admin.formations.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.formations.update', $formation) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre de la formation</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" name="titre" value="{{ old('titre', $formation->titre) }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="formateur_id" class="form-label">Formateur</label>
                            <select class="form-select @error('formateur_id') is-invalid @enderror" 
                                    id="formateur_id" name="formateur_id" required>
                                <option value="">Sélectionner un formateur</option>
                                @foreach($formateurs as $formateur)
                                    <option value="{{ $formateur->id }}" {{ (old('formateur_id', $formation->formateur_id) == $formateur->id) ? 'selected' : '' }}>
                                        {{ $formateur->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('formateur_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5">{{ old('description', $formation->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                                   id="date_debut" name="date_debut" value="{{ old('date_debut', $formation->date_debut) }}" required>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de fin</label>
                            <input type="date" class="form-control @error('date_fin') is-invalid @enderror" 
                                   id="date_fin" name="date_fin" value="{{ old('date_fin', $formation->date_fin) }}" required>
                            @error('date_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.formations.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section des modules (si vous voulez les gérer ici) -->
    @if($formation->modules->count() > 0)
    <div class="card mt-4">
        <div class="card-header">
            <h5>Modules de la formation</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Contenus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formation->modules as $module)
                        <tr>
                            <td>{{ $module->titre }}</td>
                            <td>{{ Str::limit($module->description, 50) }}</td>
                            <td>{{ $module->contenus->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection