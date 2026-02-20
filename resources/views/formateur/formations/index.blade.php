{{-- resources/views/formateur/formations/index.blade.php --}}
@extends('layouts.formateur')

@section('title', 'Mes formations - Espace Formateur')

@section('page-title', 'Mes formations')
@section('page-subtitle', 'Formateur / Formations')

@section('content')
<!-- Top Bar -->
<div class="top-bar">
    <div class="page-title">
        <h2>Mes formations</h2>
        <p>{{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</p>
    </div>
    <div class="user-info">
        <div class="notifications" data-tooltip="Notifications">
            <i class="bi bi-bell fs-5"></i>
            <span class="badge-notif">{{ isset($activites) ? $activites->count() : 0 }}</span>
        </div>
        <div class="user-profile" onclick="window.location.href='{{ route('formateur.profil') }}'">
            <div class="user-avatar">
                {{ strtoupper(substr($formateur->nom ?? 'F', 0, 2)) }}
            </div>
            <div>
                <div class="fw-bold">{{ $formateur->nom ?? 'Formateur' }}</div>
                <div class="small text-secondary">
                    <i class="bi bi-patch-check-fill text-success me-1"></i>
                    Formateur
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header avec bouton de création -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Liste de vos formations</h3>
    <a href="{{ route('formateur.formations.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i>Nouvelle formation
    </a>
</div>

<!-- Liste des formations -->
<div class="row g-4">
    @forelse($formations as $formation)
    <div class="col-md-6 col-lg-4">
        <div class="formation-card">
            <div class="formation-image" style="background-image: url('{{ $formation->image_url ?? 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=400' }}')">
                <span class="formation-badge {{ $formation->date_debut && $formation->date_debut->isPast() ? 'badge-active' : 'badge-draft' }}">
                    {{ $formation->date_debut && $formation->date_debut->isPast() ? 'Publiée' : 'Brouillon' }}
                </span>
            </div>
            <div class="formation-content">
                <h4 class="formation-title">{{ $formation->titre }}</h4>
                <div class="formation-stats">
                    <span><i class="bi bi-people"></i> {{ $formation->inscriptions_count ?? 0 }} inscrits</span>
                    <span><i class="bi bi-collection"></i> {{ $formation->modules_count ?? 0 }} modules</span>
                    @if($formation->date_debut)
                        <span><i class="bi bi-calendar"></i> {{ $formation->date_debut->format('d/m/Y') }}</span>
                    @endif
                </div>
                <p class="text-muted small">{{ Str::limit($formation->description, 80) }}</p>
                
                <!-- Progression des apprenants (simulée) -->
                @php
                    $avgProgress = rand(30, 90); // À remplacer par une vraie stats
                @endphp
                <div class="progress-container mb-3">
                    <div class="progress-info">
                        <span>Progression moyenne</span>
                        <span>{{ $avgProgress }}%</span>
                    </div>
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: {{ $avgProgress }}%"></div>
                    </div>
                </div>
                
                <div class="formation-footer">
                    <a href="{{ route('formateur.formations.show', $formation) }}" class="btn-edit">
                        <i class="bi bi-eye me-1"></i> Voir détails
                    </a>
                    <div class="btn-group">
                        <a href="{{ route('formateur.formations.edit', $formation) }}" class="btn-stats" data-tooltip="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <button type="button" class="btn-stats text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $formation->id }}" data-tooltip="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal{{ $formation->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer la formation <strong>"{{ $formation->titre }}"</strong> ?</p>
                    <p class="text-danger"><small>Cette action est irréversible et supprimera également tous les modules et contenus associés.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('formateur.formations.destroy', $formation) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="empty-state text-center py-5">
            <i class="bi bi-folder2-open display-1 text-muted"></i>
            <h4 class="mt-3">Aucune formation</h4>
            <p class="text-muted">Vous n'avez pas encore créé de formation.</p>
            <a href="{{ route('formateur.formations.create') }}" class="btn btn-success mt-3">
                <i class="bi bi-plus-circle me-2"></i>Créer ma première formation
            </a>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if(isset($formations) && method_exists($formations, 'links'))
<div class="d-flex justify-content-center mt-5">
    {{ $formations->links() }}
</div>
@endif

<!-- Scripts pour les tooltips -->
@push('scripts')
<script>
    // Initialiser les tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endpush

<style>
    .formation-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        border: 1px solid #eef2f6;
        height: 100%;
    }

    .formation-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.1);
        border-color: var(--primary);
    }

    .formation-image {
        height: 160px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .formation-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.3rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .badge-active {
        background: #10b981;
        color: white;
    }

    .badge-draft {
        background: #f59e0b;
        color: white;
    }

    .formation-content {
        padding: 1.5rem;
    }

    .formation-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .formation-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
        color: #64748b;
        font-size: 0.9rem;
    }

    .formation-stats span {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .progress-container {
        margin-bottom: 1rem;
    }

    .progress-info {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 0.3rem;
    }

    .progress-bar-custom {
        height: 6px;
        background: #eef2f6;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        border-radius: 10px;
        transition: width 0.8s ease;
    }

    .formation-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 2px dashed #eef2f6;
    }

    .btn-edit {
        background: #10b981;
        color: white;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background: #059669;
        color: white;
        transform: translateX(3px);
    }

    .btn-stats {
        width: 38px;
        height: 38px;
        background: #f8fafc;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.3s ease;
        border: none;
        margin: 0 0.2rem;
    }

    .btn-stats:hover {
        background: #10b981;
        color: white;
        transform: scale(1.1);
    }

    .btn-group {
        display: flex;
        gap: 0.3rem;
    }

    .empty-state {
        background: white;
        border-radius: 30px;
        padding: 4rem;
        border: 2px dashed #e2e8f0;
    }

    /* Pagination */
    .pagination {
        gap: 0.3rem;
    }

    .page-link {
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 10px !important;
        color: #64748b;
        font-weight: 500;
    }

    .page-item.active .page-link {
        background: #10b981;
        color: white;
    }

    /* Tooltips personnalisés */
    [data-tooltip] {
        position: relative;
        cursor: pointer;
    }

    [data-tooltip]:before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 0.4rem 0.8rem;
        background: #1e293b;
        color: white;
        font-size: 0.75rem;
        border-radius: 6px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
    }

    [data-tooltip]:hover:before {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(-8px);
    }
</style>
@endsection