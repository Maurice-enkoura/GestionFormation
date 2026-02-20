<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduForm - Plateforme de Formation Professionnelle</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Font Awesome for WhatsApp icon (alternative) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --whatsapp: #25D366;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }

        /* WhatsApp Float Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: var(--whatsapp);
            color: white;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: pulse-whatsapp 2s infinite;
        }

        .whatsapp-float:hover {
            transform: scale(1.1) rotate(5deg);
            background-color: #20ba5c;
            color: white;
            box-shadow: 0 15px 40px rgba(37, 211, 102, 0.6);
        }

        @keyframes pulse-whatsapp {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 20px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* WhatsApp Chat Button */
        .btn-whatsapp {
            background-color: var(--whatsapp);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-whatsapp:hover {
            background-color: #20ba5c;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);
        }

        /* WhatsApp Group Badge */
        .whatsapp-group-badge {
            background: rgba(37, 211, 102, 0.1);
            color: var(--whatsapp);
            padding: 0.5rem 1rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(37, 211, 102, 0.2);
            backdrop-filter: blur(10px);
            margin-bottom: 1rem;
        }

        .whatsapp-group-badge i {
            color: var(--whatsapp);
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        }

        .navbar.scrolled {
            padding: 0.7rem 0;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
            position: relative;
        }

        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover::after {
            transform: scaleX(1);
        }

        .nav-link {
            font-weight: 600;
            color: var(--dark) !important;
            margin: 0 0.8rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 80%;
            height: 2px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: transform 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover::before {
            transform: translateX(-50%) scaleX(1);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white !important;
            padding: 0.7rem 1.8rem !important;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease !important;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            transition: left 0.3s ease;
            z-index: 0;
        }

        .btn-login:hover::before {
            left: 0;
        }

        .btn-login i, .btn-login span {
            position: relative;
            z-index: 1;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
        }

        /* Hero Section */
        .hero-section {
            padding: 140px 0 100px;
            background: radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.05) 0%, transparent 30%),
                        radial-gradient(circle at 90% 80%, rgba(139, 92, 246, 0.05) 0%, transparent 30%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 70%;
            height: 140%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 10px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(236, 72, 153, 0.2));
            border-radius: 10px;
            z-index: -1;
            animation: underlineWidth 3s ease-in-out infinite;
        }

        @keyframes underlineWidth {
            0%, 100% { width: 100%; left: 0; }
            50% { width: 70%; left: 15%; }
        }

        .hero-text {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 2.5rem;
            line-height: 1.8;
        }

        .hero-stats {
            display: flex;
            gap: 4rem;
            margin-top: 3rem;
        }

        .stat-item {
            position: relative;
        }

        .stat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: -2rem;
            top: 50%;
            transform: translateY(-50%);
            width: 2px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), transparent);
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.2rem;
        }

        .stat-item p {
            color: var(--gray);
            font-weight: 500;
            font-size: 1.1rem;
        }

        .hero-image {
            position: relative;
            z-index: 1;
        }

        .hero-image img {
            border-radius: 30px;
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.2);
            animation: float3d 6s ease-in-out infinite;
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.5s ease;
        }

        .hero-image img:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        @keyframes float3d {
            0%, 100% { transform: perspective(1000px) rotateY(-5deg) translateY(0); }
            50% { transform: perspective(1000px) rotateY(-5deg) translateY(-20px); }
        }

        /* Search Section */
        .search-section {
            padding: 40px 0;
            margin-top: -60px;
            z-index: 10;
            position: relative;
        }

        .search-card {
            background: white;
            border-radius: 30px;
            padding: 2.5rem;
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.1);
            backdrop-filter: blur(10px);
        }

        .search-input-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-input-group input {
            flex: 1;
            padding: 1.2rem 2rem;
            border: 2px solid #eef2f6;
            border-radius: 60px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            min-width: 250px;
        }

        .search-input-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 6px rgba(99, 102, 241, 0.1);
        }

        .search-btn {
            padding: 1.2rem 3.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 60px;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .search-btn::before {
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

        .search-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
        }

        /* Section titres */
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .section-title p {
            color: var(--gray);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .section-title .badge {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            padding: 0.7rem 1.5rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            border: 1px solid rgba(99, 102, 241, 0.2);
            backdrop-filter: blur(10px);
        }

        /* Cartes formation */
        .formation-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid rgba(99, 102, 241, 0.1);
            position: relative;
        }

        .formation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
        }

        .formation-card:hover::before {
            transform: scaleX(1);
        }

        .formation-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 40px 60px rgba(99, 102, 241, 0.15);
            border-color: transparent;
        }

        .card-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .formation-card:hover .card-image img {
            transform: scale(1.15);
        }

        .card-category {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.5rem;
            border-radius: 60px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary);
            border: 1px solid rgba(99, 102, 241, 0.2);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            z-index: 2;
        }

        .card-content {
            padding: 2rem;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: var(--dark);
            line-height: 1.4;
        }

        .card-description {
            color: var(--gray);
            font-size: 1rem;
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            background: #f8fafc;
            padding: 1rem;
            border-radius: 15px;
        }

        .card-level, .card-duration {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .card-level i, .card-duration i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 2px dashed #eef2f6;
        }

        .btn-details {
            padding: 0.8rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 60px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-details::before {
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

        .btn-details:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-details:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        /* Section Formateurs */
        .formateur-card {
            background: white;
            padding: 2rem;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
            text-align: center;
        }

        .formateur-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.1);
        }

        .formateur-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 2rem;
            margin: 0 auto 1rem;
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.2);
        }

        /* Section Témoignages */
        .temoignage-card {
            background: white;
            padding: 2rem;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(99, 102, 241, 0.1);
            transition: all 0.3s ease;
        }

        .temoignage-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.1);
        }

        .temoignage-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .temoignage-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .temoignage-info h5 {
            margin-bottom: 0.2rem;
            font-weight: 700;
        }

        .temoignage-info p {
            color: var(--gray);
            font-size: 0.9rem;
            margin: 0;
        }

        .temoignage-rating {
            margin-bottom: 1rem;
        }

        .temoignage-text {
            color: var(--gray);
            font-style: italic;
            line-height: 1.7;
        }

        /* Section Newsletter */
        .newsletter-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 4rem;
            border-radius: 50px;
            box-shadow: 0 40px 80px rgba(99, 102, 241, 0.3);
            position: relative;
            overflow: hidden;
        }

        .newsletter-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 70%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        .newsletter-form .input-group {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .newsletter-form .form-control {
            border-radius: 60px 0 0 60px;
            border: none;
            padding: 1.2rem 1.5rem;
            font-size: 1.1rem;
        }

        .newsletter-form .btn-light {
            border-radius: 0 60px 60px 0;
            padding: 1.2rem 2.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .newsletter-form .btn-light:hover {
            transform: translateX(5px);
            box-shadow: -5px 0 20px rgba(255, 255, 255, 0.3);
        }

        /* Section À propos */
        .about-section {
            padding: 100px 0;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 70%;
            height: 200%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .about-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
            margin-top: 4rem;
        }

        .feature-item {
            text-align: center;
            padding: 2.5rem 2rem;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
            transition: all 0.4s ease;
            border: 1px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
        }

        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: translateY(-100%);
            transition: transform 0.4s ease;
        }

        .feature-item:hover::before {
            transform: translateY(0);
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 40px 60px rgba(99, 102, 241, 0.1);
            border-color: transparent;
        }

        .feature-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            transition: all 0.4s ease;
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.1) rotate(10deg);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .feature-icon i {
            font-size: 2.5rem;
            color: var(--primary);
            transition: all 0.4s ease;
        }

        .feature-item:hover .feature-icon i {
            color: white;
        }

        .feature-item h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-item p {
            color: var(--gray);
            font-size: 1rem;
            line-height: 1.7;
        }

        /* Section Contact */
        .contact-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
        }

        .contact-info {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 3.5rem;
            border-radius: 40px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .contact-info::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -20%;
            width: 70%;
            height: 140%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 8s ease-in-out infinite;
        }

        .contact-info h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .contact-info p {
            margin-bottom: 2.5rem;
            opacity: 0.9;
            font-size: 1.1rem;
            line-height: 1.8;
            position: relative;
        }

        .contact-detail {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2rem;
            position: relative;
            transition: transform 0.3s ease;
        }

        .contact-detail:hover {
            transform: translateX(10px);
        }

        .contact-detail i {
            font-size: 1.8rem;
            width: 40px;
        }

        .contact-detail div {
            flex: 1;
        }

        .contact-detail strong {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .contact-detail p {
            margin-bottom: 0;
            opacity: 0.8;
            font-size: 1rem;
        }

        .contact-form {
            padding: 3rem;
            background: white;
            border-radius: 40px;
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.1);
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

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.2rem 2rem;
            border: none;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
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

        .btn-submit:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 70px 0 30px;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: -30%;
            left: -10%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: rotate 30s linear infinite;
        }

        .footer h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .footer h4::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 0;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 10px;
        }

        .footer-links a::before {
            content: '→';
            position: absolute;
            left: -20px;
            opacity: 0;
            transition: all 0.3s ease;
            color: var(--primary);
        }

        .footer-links a:hover::before {
            left: -5px;
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 1.2rem;
        }

        .social-links a:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: translateY(-5px) rotate(360deg);
            border-color: transparent;
        }

        /* WhatsApp Social Link */
        .social-links a.whatsapp-social:hover {
            background: var(--whatsapp);
        }

        .copyright {
            text-align: center;
            padding-top: 3rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            position: relative;
        }

        /* Boutons */
        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
            color: white;
        }

        .btn-outline-primary-modern {
            background: transparent;
            color: var(--primary);
            padding: 1rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            border: 2px solid var(--primary);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-primary-modern:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.2);
        }

        /* Pagination */
        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            border: none;
            padding: 0.8rem 1.2rem;
            border-radius: 15px !important;
            color: var(--dark);
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
        }

        .page-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
        }

        /* Badges */
        .badge-modern {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        /* Empty State */
        .empty-state {
            padding: 4rem;
            background: white;
            border-radius: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
        }

        .empty-state i {
            font-size: 5rem;
            color: var(--primary);
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-stats {
                flex-direction: column;
                gap: 2rem;
            }
            
            .stat-item:not(:last-child)::after {
                display: none;
            }
            
            .about-features {
                grid-template-columns: 1fr;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .search-input-group {
                flex-direction: column;
            }
            
            .search-btn {
                width: 100%;
            }

            .whatsapp-float {
                width: 50px;
                height: 50px;
                font-size: 25px;
                bottom: 15px;
                right: 15px;
            }
        }
    </style>
</head>
<body>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/33123456789?text=Bonjour%20EduForm%2C%20j'aimerais%20avoir%20des%20informations%20sur%20vos%20formations." 
   class="whatsapp-float" 
   target="_blank"
   data-aos="fade-up"
   data-aos-delay="500">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-mortarboard-fill me-2"></i>EduForm
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#formations">Formations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#apropos">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#formateurs">Formateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>

                @guest
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn-login" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            <span>Connexion</span>
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn-login" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ auth()->user()->nom }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                    </a>
                                </li>
                            @elseif(auth()->user()->role === 'formateur')
                                <li>
                                    <a class="dropdown-item" href="{{ route('formateur.dashboard') }}">
                                        <i class="bi bi-easel me-2"></i>Dashboard Formateur
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('apprenant.dashboard') }}">
                                        <i class="bi bi-person-workspace me-2"></i>Mon espace
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    <!-- Hero Section -->
    <section id="accueil" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="hero-title">
                        Développez vos <span>compétences</span> avec les meilleurs experts
                    </h1>
                    <p class="hero-text">
                        Accédez à des formations de qualité dispensées par des professionnels reconnus. Apprenez à votre rythme et propulsez votre carrière vers de nouveaux sommets.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#formations" class="btn-primary-modern">
                            <i class="bi bi-play-circle me-2"></i>Explorer les formations
                        </a>
                        <a href="{{ route('register') }}" class="btn-outline-primary-modern">
                            <i class="bi bi-person-plus me-2"></i>S'inscrire gratuitement
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3>{{ $stats['total_apprenants'] ?? 0 }}+</h3>
                            <p>Apprenants</p>
                        </div>
                        <div class="stat-item">
                            <h3>{{ $stats['total_formations'] ?? 0 }}+</h3>
                            <p>Formations</p>
                        </div>
                        <div class="stat-item">
                            <h3>{{ $stats['total_formateurs'] ?? 0 }}+</h3>
                            <p>Experts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="hero-image">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Formation" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section (sans catégories) -->
    <section class="search-section">
        <div class="container">
            <div class="search-card" data-aos="fade-up">
                <form action="{{ route('formations.search') }}" method="GET" class="search-input-group">
                    <input type="text" name="search" placeholder="Rechercher une formation..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                        <i class="bi bi-search me-2"></i>Rechercher
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Formations Section -->
    <section id="formations" class="py-5">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge">
                    <i class="bi bi-stars me-2"></i>Notre catalogue
                </span>
                <h2>Formations disponibles</h2>
                <p>Découvrez les formations proposées par nos formateurs experts</p>
            </div>

            <div class="row g-4">
                @forelse($formations ?? [] as $formation)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="formation-card">
                            <div class="card-image">
                                <img src="{{ $formation->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                                     alt="{{ $formation->titre }}">
                                <span class="card-category">
                                    <i class="bi bi-tag me-1"></i>Formation
                                </span>
                            </div>

                            <div class="card-content">
                                <h5 class="card-title">{{ $formation->titre }}</h5>
                                <p class="card-description">{{ Str::limit($formation->description ?? '', 100) }}</p>

                                <div class="card-meta">
                                    <span class="card-level">
                                        <i class="bi bi-person-badge"></i>
                                        {{ $formation->formateur->nom ?? 'Formateur' }}
                                    </span>
                                    <span class="card-duration">
                                        <i class="bi bi-calendar-check"></i>
                                        {{ $formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : 'Date à définir' }}
                                    </span>
                                </div>

                                <div class="card-footer">
                                    <a href="{{ route('formations.show', $formation->id) }}" class="btn-details">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty-state">
                            <i class="bi bi-emoji-frown display-1 text-primary"></i>
                            <h3 class="mt-4">Aucune formation disponible</h3>
                            <p class="text-muted">Revenez plus tard pour découvrir nos nouvelles formations</p>
                        </div>
                    </div>
                @endforelse
            </div>

           
        </div>
    </section>

    <!-- Formations Populaires -->
    @if(isset($formationsPopulaires) && $formationsPopulaires->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge">
                    <i class="bi bi-fire me-2"></i>Populaires
                </span>
                <h2>Formations les plus demandées</h2>
                <p>Découvrez les formations qui rencontrent le plus de succès</p>
            </div>

            <div class="row g-4">
                @foreach($formationsPopulaires as $formation)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="formation-card">
                        <div class="card-image">
                            <img src="{{ $formation->image_url ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                                 alt="{{ $formation->titre }}">
                        </div>
                        <div class="card-content">
                            <h5 class="card-title">{{ $formation->titre }}</h5>
                            <p class="card-description">{{ Str::limit($formation->description ?? '', 80) }}</p>
                            
                            <div class="card-meta">
                                <span class="card-level">
                                    <i class="bi bi-person-badge"></i>
                                    {{ $formation->formateur->nom ?? 'Formateur' }}
                                </span>
                                <span class="card-duration">
                                    <i class="bi bi-people"></i>
                                    {{ $formation->inscriptions_count ?? 0 }} inscrits
                                </span>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('formations.show', $formation->id) }}" class="btn-details">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Top Formateurs -->
    @if(isset($topFormateurs) && $topFormateurs->count() > 0)
    <section id="formateurs" class="py-5">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge">
                    <i class="bi bi-star me-2"></i>Experts
                </span>
                <h2>Nos formateurs vedettes</h2>
                <p>Apprenez avec les meilleurs experts du domaine</p>
            </div>

            <div class="row g-4">
                @foreach($topFormateurs as $formateur)
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="formateur-card">
                        <div class="formateur-avatar">
                            {{ strtoupper(substr($formateur->nom, 0, 2)) }}
                        </div>
                        <h5 class="mt-3">{{ $formateur->nom }}</h5>
                        <p class="text-muted small">{{ $formateur->formations_count ?? 0 }} formations</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Témoignages -->
    @if(isset($temoignages) && $temoignages->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge">
                    <i class="bi bi-chat-quote me-2"></i>Témoignages
                </span>
                <h2>Ce que disent nos apprenants</h2>
                <p>Découvrez les retours d'expérience de nos apprenants</p>
            </div>

            <div class="row g-4">
                @foreach($temoignages as $avis)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="temoignage-card">
                        <div class="temoignage-header">
                            <div class="temoignage-avatar">
                                {{ strtoupper(substr($avis->user->nom ?? 'A', 0, 2)) }}
                            </div>
                            <div class="temoignage-info">
                                <h5>{{ $avis->user->nom ?? 'Apprenant' }}</h5>
                                <p>{{ $avis->formation->titre ?? 'Formation' }}</p>
                            </div>
                        </div>
                        <div class="temoignage-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= ($avis->note ?? 0) ? '-fill text-warning' : '' }}"></i>
                            @endfor
                        </div>
                        <p class="temoignage-text">"{{ $avis->commentaire ?? 'Super formation !' }}"</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- À propos Section -->
    <section id="apropos" class="about-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge">
                    <i class="bi bi-star me-2"></i>Pourquoi nous choisir
                </span>
                <h2>Une plateforme dédiée à votre réussite</h2>
                <p>Nous mettons tout en œuvre pour vous offrir la meilleure expérience d'apprentissage</p>
            </div>

            <div class="about-features">
                <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="bi bi-camera-video"></i>
                    </div>
                    <h3>Vidéos HD</h3>
                    <p>Des cours en vidéo haute définition pour un apprentissage optimal et immersif</p>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <h3>Ressources téléchargeables</h3>
                    <p>Exercices, corrigés et supports de cours à télécharger pour réviser</p>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>Support personnalisé</h3>
                    <p>Un formateur dédié pour répondre à toutes vos questions</p>
                </div>
            </div>

            <div class="row mt-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Équipe" 
                         class="img-fluid rounded-4 shadow-lg">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h3 class="h2 fw-bold mb-4">Une équipe d'experts passionnés</h3>
                    <p class="text-secondary mb-4 fs-5">Nos formateurs sont des professionnels en activité, sélectionnés pour leur expertise et leur pédagogie. Ils vous accompagnent tout au long de votre parcours pour garantir votre réussite.</p>
                    <ul class="list-unstyled">
                        <li class="mb-4">
                            <i class="bi bi-check-circle-fill text-primary me-3 fs-4"></i>
                            <span class="fs-5">Plus de 10 ans d'expérience en moyenne</span>
                        </li>
                        <li class="mb-4">
                            <i class="bi bi-check-circle-fill text-primary me-3 fs-4"></i>
                            <span class="fs-5">Certifiés par les plus grandes institutions</span>
                        </li>
                        <li class="mb-4">
                            <i class="bi bi-check-circle-fill text-primary me-3 fs-4"></i>
                            <span class="fs-5">Disponibles 7j/7 pour vous aider</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5">
        <div class="container">
            <div class="newsletter-card" data-aos="zoom-in">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="text-white mb-3">Ne manquez aucune opportunité !</h3>
                        <p class="text-white-50 mb-4 fs-5">Inscrivez-vous à notre newsletter et recevez nos dernières actualités et offres exclusives.</p>
                    </div>
                    <div class="col-lg-6">
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Votre adresse email">
                                <button class="btn btn-light" type="submit">
                                    <i class="bi bi-send me-2"></i>S'abonner
                                </button>
                            </div>
                            <small class="text-white-50 mt-2 d-block">
                                <i class="bi bi-shield-check me-1"></i>
                                Nous ne spammons pas ! 1 email par mois maximum.
                            </small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span class="badge">
                    <i class="bi bi-envelope me-2"></i>Contactez-nous
                </span>
                <h2>Une question ? N'hésitez pas</h2>
                <p>Notre équipe est là pour vous aider dans votre parcours d'apprentissage</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="contact-info">
                        <h3>Parlons de votre projet</h3>
                        <p>Que vous soyez un apprenant ou un formateur, nous sommes là pour échanger avec vous.</p>
                        
                        <!-- WhatsApp dans les coordonnées -->
                        <div class="contact-detail">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <strong>WhatsApp</strong>
                                <p class="mb-0">
                                    <a href="https://wa.me/33123456789" target="_blank" class="text-white text-decoration-none">
                                        +33 1 23 45 67 89
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-geo-alt"></i>
                            <div>
                                <strong>Adresse</strong>
                                <p class="mb-0">123 Rue de la Formation, 75001 Paris</p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-telephone"></i>
                            <div>
                                <strong>Téléphone</strong>
                                <p class="mb-0">+33 1 23 45 67 89</p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <p class="mb-0">contact@eduform.fr</p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-clock"></i>
                            <div>
                                <strong>Horaires</strong>
                                <p class="mb-0">Lun-Ven: 9h-18h</p>
                            </div>
                        </div>

                        
                    </div>
                </div>
                
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-form">
                        <form>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Votre nom" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Votre email" required>
                                </div>
                                <div class="col-12">
                                    <select class="form-select">
                                        <option>Sujet de votre message</option>
                                        <option>Question sur une formation</option>
                                        <option>Devenir formateur</option>
                                        <option>Support technique</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="6" placeholder="Votre message" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-submit">
                                        <i class="bi bi-send me-2"></i>Envoyer le message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a class="navbar-brand text-white mb-3 d-inline-block" href="#">
                    <i class="bi bi-mortarboard-fill me-2"></i>EduForm
                </a>
                <p class="text-white-50 mb-4 fs-5">La plateforme de formation professionnelle qui vous accompagne vers la réussite.</p>
                <div class="social-links">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="https://wa.me/33123456789" class="whatsapp-social" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h4>Liens rapides</h4>
                <ul class="footer-links">
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#formations">Formations</a></li>
                    <li><a href="#apropos">À propos</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h4>Formations</h4>
                <ul class="footer-links">
                    <li><a href="#">Développement</a></li>
                    <li><a href="#">Design</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Business</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <h4>Newsletter</h4>
                <p class="text-white-50 mb-4">Recevez nos dernières actualités et offres exclusives</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Votre email">
                    <button class="btn btn-primary" type="button">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
                <!-- WhatsApp Group Link -->
                <div class="mt-3">
                    <a href="https://chat.whatsapp.com/your-group-link" class="text-white-50 text-decoration-none small" target="_blank">
                        <i class="fab fa-whatsapp me-1"></i> Rejoindre notre groupe WhatsApp
                    </a>
                </div>
            </div>
        </div>
        
        <div class="copyright">
            <p class="mb-0">&copy; 2024 EduForm - Tous droits réservés. Créé avec <i class="bi bi-heart-fill text-danger"></i></p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNav');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // WhatsApp button click tracking
    document.querySelectorAll('.whatsapp-float, .btn-whatsapp, .whatsapp-social').forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('WhatsApp button clicked');
        });
    });
</script>
</body>
</html>