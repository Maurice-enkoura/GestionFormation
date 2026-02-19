<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - EduForm</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #0f172a;
            --gray: #64748b;
            --success: #22c55e;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .register-container {
            max-width: 500px;
            width: 100%;
        }

        .register-card {
            background: white;
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo a {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .logo i {
            font-size: 2.5rem;
            color: var(--primary);
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: var(--gray);
            margin-bottom: 2rem;
        }

        .form-control, .form-select {
            padding: 1.2rem 1.5rem;
            border: 2px solid #eef2f6;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 6px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group-text {
            background: white;
            border: 2px solid #eef2f6;
            border-right: none;
            border-radius: 20px 0 0 20px;
            padding: 0 1.5rem;
            color: var(--gray);
        }

        .input-group .form-control,
        .input-group .form-select {
            border-left: none;
            border-radius: 0 20px 20px 0;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.2rem;
            border: none;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-register:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
        }

        .password-hint {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: -1rem;
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }

        .password-hint i {
            color: var(--success);
            font-size: 0.8rem;
        }

        .links {
            text-align: center;
            margin-top: 2rem;
        }

        .links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .links a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
            color: var(--gray);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px dashed #eef2f6;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .alert {
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .role-badge {
            display: inline-block;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .role-badge.apprenant {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .role-badge.formateur {
            background: rgba(236, 72, 153, 0.1);
            color: var(--accent);
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .back-home i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>EduForm</span>
                </a>
            </div>

            <h1 class="text-center">Inscription</h1>
            <p class="subtitle text-center">Rejoignez notre communauté d'apprenants</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0"><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" 
                           class="form-control @error('nom') is-invalid @enderror" 
                           name="nom" 
                           placeholder="Nom complet"
                           value="{{ old('nom') }}"
                           required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           placeholder="Adresse email"
                           value="{{ old('email') }}"
                           required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" 
                           placeholder="Mot de passe"
                           required>
                </div>

                <div class="password-hint">
                    <i class="bi bi-check-circle me-1"></i>
                    Minimum 8 caractères
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" 
                           class="form-control" 
                           name="password_confirmation" 
                           placeholder="Confirmer le mot de passe"
                           required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <select name="role" class="form-select" required>
                        <option value="">Choisissez votre rôle</option>
                        <option value="apprenant" {{ old('role') == 'apprenant' ? 'selected' : '' }}>
                            Apprenant <span class="role-badge apprenant">👨‍🎓</span>
                        </option>
                        <option value="formateur" {{ old('role') == 'formateur' ? 'selected' : '' }}>
                            Formateur <span class="role-badge formateur">👨‍🏫</span>
                        </option>
                    </select>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                    <label class="form-check-label" for="terms">
                        J'accepte les <a href="#" class="text-primary">conditions d'utilisation</a>
                    </label>
                </div>

                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus me-2"></i>S'inscrire
                </button>

                <div class="divider">ou</div>

                <div class="links">
                    <p class="mb-0">
                        Déjà inscrit ? 
                        <a href="{{ route('login') }}">Se connecter</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="back-home">
            <a href="{{ route('home') }}">
                <i class="bi bi-arrow-left"></i>Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html>