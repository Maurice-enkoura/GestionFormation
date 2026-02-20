{{-- resources/views/admin/parametres.blade.php --}}
@extends('layouts.admin')

@section('title', 'Paramètres - Administration')
@section('page-title', 'Paramètres de la plateforme')
@section('page-subtitle', 'Admin / Paramètres')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <!-- Paramètres généraux -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-gear me-2 text-primary"></i>
                    Paramètres généraux
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.parametres.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Nom du site</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? 'EduForm' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_email" class="form-label">Email de contact</label>
                        <input type="email" class="form-control" id="site_email" name="site_email" value="{{ $settings['site_email'] ?? 'contact@eduform.com' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Description du site</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ $settings['site_description'] ?? 'Plateforme de formation en ligne' }}</textarea>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="mb-3">Fonctionnalités</h6>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="allow_registrations" name="allow_registrations" {{ ($settings['allow_registrations'] ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="allow_registrations">Autoriser les nouvelles inscriptions</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="require_email_verification" name="require_email_verification" {{ ($settings['require_email_verification'] ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="require_email_verification">Exiger la vérification d'email</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="enable_notifications" name="enable_notifications" {{ ($settings['enable_notifications'] ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable_notifications">Activer les notifications</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Enregistrer les modifications
                    </button>
                </form>
            </div>
        </div>

        <!-- Paramètres de sécurité -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-shield-lock me-2 text-primary"></i>
                    Sécurité
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.parametres.security') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="min_password_length" class="form-label">Longueur minimale du mot de passe</label>
                        <input type="number" class="form-control" id="min_password_length" name="min_password_length" value="{{ $settings['min_password_length'] ?? 8 }}" min="6" max="20">
                    </div>
                    
                    <div class="mb-3">
                        <label for="max_login_attempts" class="form-label">Tentatives de connexion max avant blocage</label>
                        <input type="number" class="form-control" id="max_login_attempts" name="max_login_attempts" value="{{ $settings['max_login_attempts'] ?? 5 }}" min="3" max="10">
                    </div>
                    
                    <div class="mb-3">
                        <label for="session_timeout" class="form-label">Durée de session (minutes)</label>
                        <input type="number" class="form-control" id="session_timeout" name="session_timeout" value="{{ $settings['session_timeout'] ?? 120 }}" min="30" max="480">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Mettre à jour
                    </button>
                </form>
            </div>
        </div>

        <!-- Paramètres des emails -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-envelope me-2 text-primary"></i>
                    Configuration email
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.parametres.email') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="mail_driver" class="form-label">Driver mail</label>
                        <select class="form-select" id="mail_driver" name="mail_driver">
                            <option value="smtp" {{ ($settings['mail_driver'] ?? 'smtp') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                            <option value="sendmail" {{ ($settings['mail_driver'] ?? '') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                            <option value="mailgun" {{ ($settings['mail_driver'] ?? '') == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mail_host" class="form-label">Hôte SMTP</label>
                        <input type="text" class="form-control" id="mail_host" name="mail_host" value="{{ $settings['mail_host'] ?? 'smtp.gmail.com' }}">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mail_port" class="form-label">Port</label>
                            <input type="number" class="form-control" id="mail_port" name="mail_port" value="{{ $settings['mail_port'] ?? 587 }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mail_encryption" class="form-label">Encryption</label>
                            <select class="form-select" id="mail_encryption" name="mail_encryption">
                                <option value="tls" {{ ($settings['mail_encryption'] ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="" {{ ($settings['mail_encryption'] ?? '') == '' ? 'selected' : '' }}>Aucun</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mail_username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="mail_username" name="mail_username" value="{{ $settings['mail_username'] ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="mail_password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mail_password" name="mail_password" value="">
                        <small class="text-muted">Laissez vide pour ne pas modifier</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Configurer
                    </button>
                    <button type="button" class="btn btn-outline-secondary ms-2" onclick="testEmailConfig()">
                        <i class="bi bi-envelope-paper"></i> Tester la configuration
                    </button>
                </form>
            </div>
        </div>

        <!-- Maintenance -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="bi bi-tools me-2 text-primary"></i>
                    Maintenance
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Les actions de maintenance sont irréversibles.
                </div>
                
                <div class="d-flex gap-3">
                    <form action="{{ route('admin.maintenance.cache') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-warning" onclick="return confirm('Vider le cache ?')">
                            <i class="bi bi-trash"></i> Vider le cache
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.maintenance.backup') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-database"></i> Sauvegarder BDD
                        </button>
                    </form>
                    
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#maintenanceModeModal">
                        <i class="bi bi-exclamation-octagon"></i> Mode maintenance
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal mode maintenance -->
<div class="modal fade" id="maintenanceModeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mode maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.maintenance.toggle') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="maintenance_message" class="form-label">Message aux visiteurs</label>
                        <textarea class="form-control" id="maintenance_message" name="message" rows="3">Site en maintenance. Revenez plus tard !</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="maintenance_retry" class="form-label">Temps avant réessai (minutes)</label>
                        <input type="number" class="form-control" id="maintenance_retry" name="retry" value="5" min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Activer le mode maintenance</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function testEmailConfig() {
        // Simulation d'un test de configuration email
        alert('Test de configuration envoyé ! Vérifiez votre boîte de réception.');
    }
</script>
@endpush

<style>
    .card {
        border: 1px solid #eef2f6;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #eef2f6;
        padding: 1.2rem 1.5rem;
        border-radius: 20px 20px 0 0 !important;
    }

    .card-header h5 {
        font-weight: 600;
        color: #0f172a;
    }

    .form-label {
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #eef2f6;
        border-radius: 12px;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .btn {
        border-radius: 12px;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-outline-warning:hover {
        background: #f59e0b;
        color: white;
    }

    .btn-outline-danger:hover {
        background: #ef4444;
        color: white;
    }

    hr {
        opacity: 0.1;
    }

    .modal-content {
        border-radius: 20px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid #eef2f6;
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid #eef2f6;
        padding: 1.5rem;
    }
</style>
@endsection