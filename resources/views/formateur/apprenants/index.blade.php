@extends('layouts.formateur')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Apprenants</h1>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un apprenant..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Apprenant</th>
                            <th>Email</th>
                            <th>Inscriptions</th>
                            <th>Date inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apprenants as $apprenant)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($apprenant->nom, 0, 2)) }}
                                    </div>
                                    {{ $apprenant->nom }}
                                </div>
                            </td>
                            <td>{{ $apprenant->email }}</td>
                            <td>
                                <span class="badge bg-info">{{ $apprenant->inscriptions_count }} formation(s)</span>
                            </td>
                            <td>{{ $apprenant->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('formateur.apprenants.show', $apprenant) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Aucun apprenant trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $apprenants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection