<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EduForm</title>
    
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

        .login-container {
            max-width: 450px;
            width: 100%;
        }

        .login-card {
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

        .form-control {
            padding: 1.2rem 1.5rem;
            border: 2px solid #eef2f6;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
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

        .input-group .form-control {
            border-left: none;
            border-radius: 0 20px 20px 0;
        }

        .btn-login {
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

        .btn-login::before {
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

        .btn-login:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
        }

        .form-check {
            margin: 1rem 0;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
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
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <a href="<?php echo e(route('home')); ?>">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>EduForm</span>
                </a>
            </div>

            <h1 class="text-center">Connexion</h1>
            <p class="subtitle text-center">Accédez à votre espace personnel</p>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="mb-0"><i class="bi bi-exclamation-circle me-2"></i><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" 
                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="email" 
                           placeholder="Adresse email"
                           value="<?php echo e(old('email')); ?>"
                           required>
                </div>

                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" 
                           class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="password" 
                           placeholder="Mot de passe"
                           required>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Se souvenir de moi
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>

                <div class="divider">ou</div>

                <div class="links">
                    <p class="mb-2">
                        <a href="#">Mot de passe oublié ?</a>
                    </p>
                    <p class="mb-0">
                        Pas encore de compte ? 
                        <a href="<?php echo e(route('register')); ?>">S'inscrire</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="back-home">
            <a href="<?php echo e(route('home')); ?>">
                <i class="bi bi-arrow-left"></i>Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/auth/login.blade.php ENDPATH**/ ?>