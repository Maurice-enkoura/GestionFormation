@extends('layouts.formateur')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Évaluations</h1>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <select name="formation_id" class="form-select">
                            <option value="">Toutes les formations</option>
                            @foreach($formations as $formation)
                            <option value="{{ $formation->id }}" {{ request('formation_id') == $formation->id ? 'selected' : '' }}>
                                {{ $formation->titre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Apprenant</th>
                            <th>Formation</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evaluations as $evaluation)
                        <tr>
                            <td>{{ $evaluation->user->nom }}</td>
                            <td>{{ $evaluation->formation->titre }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $evaluation->note ? '-fill text-warning' : '' }}"></i>
                                @endfor
                            </td>
                            <td>{{ Str::limit($evaluation->commentaire, 50) }}</td>
                            <td>{{ $evaluation->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('formateur.evaluations.show', $evaluation) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Détails
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Aucune évaluation</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $evaluations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection