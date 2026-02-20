{{-- resources/views/admin/messages/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Messages - Administration')
@section('page-title', 'Gestion des messages')
@section('page-subtitle', 'Admin / Messages')

@section('content')
<!-- Filtres -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.messages.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher dans les messages..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="user_id" class="form-select">
                            <option value="">Tous les utilisateurs</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->nom }} ({{ ucfirst($user->role) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filtrer
                        </button>
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10">
                <i class="bi bi-chat text-primary"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['total'] }}</h4>
                <p>Messages totaux</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10">
                <i class="bi bi-calendar-day text-success"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['aujourd_hui'] }}</h4>
                <p>Messages aujourd'hui</p>
            </div>
        </div>
    </div>
</div>

<!-- Liste des messages -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="bi bi-envelope me-2 text-primary"></i>
            Tous les messages
        </h5>
    </div>
    <div class="card-body p-0">
        @if($messages->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-envelope-open display-1 text-muted"></i>
                <h4 class="mt-3">Aucun message</h4>
                <p class="text-muted">Il n'y a pas encore de messages sur la plateforme.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>De / À</th>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <small>
                                        <i class="bi bi-arrow-right-circle-fill text-success me-1"></i>
                                        <strong>De:</strong> {{ $message->sender->nom }}
                                        <span class="badge bg-{{ $message->sender->role === 'apprenant' ? 'primary' : ($message->sender->role === 'formateur' ? 'success' : 'danger') }} bg-opacity-10">
                                            {{ ucfirst($message->sender->role) }}
                                        </span>
                                    </small>
                                    <small>
                                        <i class="bi bi-arrow-left-circle-fill text-warning me-1"></i>
                                        <strong>À:</strong> {{ $message->receiver->nom }}
                                        <span class="badge bg-{{ $message->receiver->role === 'apprenant' ? 'primary' : ($message->receiver->role === 'formateur' ? 'success' : 'danger') }} bg-opacity-10">
                                            {{ ucfirst($message->receiver->role) }}
                                        </span>
                                    </small>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $message->sujet }}</strong>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                    {{ $message->contenu }}
                                </span>
                            </td>
                            <td>
                                <small>
                                    <i class="bi bi-calendar"></i> {{ $message->created_at->format('d/m/Y') }}
                                    <br>
                                    <i class="bi bi-clock"></i> {{ $message->created_at->format('H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Supprimer ce message ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center p-3">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.1);
        border-color: var(--primary);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
    
    .stat-info h4 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
        color: #0f172a;
    }
    
    .stat-info p {
        margin: 0;
        font-size: 0.9rem;
        color: #64748b;
    }
</style>
@endsection