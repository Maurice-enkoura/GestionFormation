<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apprenant - EduForm</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f5fa;
            overflow-x: hidden;
        }

        /* Sidebar moderne */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark) 0%, #1a2639 100%);
            color: white;
            padding: 1.5rem 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .sidebar-logo span,
        .sidebar.collapsed .sidebar-menu a span,
        .sidebar.collapsed .user-details {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 1rem;
        }

        .sidebar.collapsed .sidebar-menu a i {
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar.collapsed .sidebar-logo {
            text-align: center;
            padding-left: 0;
        }

        .sidebar-logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, white, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            display: block;
            margin-bottom: 2.5rem;
            padding-left: 1rem;
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover {
            transform: scale(1.05);
        }

        .sidebar-logo i {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 0.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-menu a:hover::before,
        .sidebar-menu a.active::before {
            transform: scaleY(1);
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu a i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover i {
            transform: scale(1.1);
        }

        .sidebar-menu .logout {
            margin-top: 3rem;
        }

        .sidebar-menu .logout button {
            background: transparent;
            border: none;
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1rem;
            width: 100%;
            border-radius: 14px;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .sidebar-menu .logout button:hover {
            background: rgba(239, 68, 68, 0.1);
            transform: translateX(5px);
        }

        /* Toggle sidebar button */
        .sidebar-toggle {
            position: fixed;
            left: var(--sidebar-width);
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 60px;
            background: white;
            border-radius: 0 30px 30px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            z-index: 1001;
            transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
            border-left: none;
        }

        .sidebar-toggle.collapsed {
            left: var(--sidebar-collapsed-width);
        }

        .sidebar-toggle i {
            color: var(--primary);
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .sidebar-toggle:hover i {
            transform: scale(1.2);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Bar moderne */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .page-title h2 {
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            font-size: 1.8rem;
        }

        .page-title p {
            color: var(--gray);
            margin: 0;
            font-size: 0.95rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .notifications {
            position: relative;
            cursor: pointer;
        }

        .notifications i {
            font-size: 1.5rem;
            color: var(--gray);
            transition: all 0.3s ease;
        }

        .notifications:hover i {
            color: var(--primary);
            transform: rotate(15deg);
        }

        .badge-notif {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 60px;
            transition: all 0.3s ease;
            background: white;
            border: 1px solid #e2e8f0;
        }

        .user-profile:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.1);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .user-name {
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .user-role i {
            color: var(--success);
            font-size: 0.6rem;
        }

        /* Welcome Card moderne */
        .welcome-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 30px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.2);
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .welcome-card::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        .welcome-card h3 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
        }

        .welcome-card p {
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 500px;
            font-size: 1.1rem;
            position: relative;
        }

        .continue-btn {
            background: white;
            color: var(--primary);
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 60px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .continue-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .continue-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .continue-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        }

        /* Stats Cards modernes */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.8rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #eef2f6;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 40px rgba(99, 102, 241, 0.1);
            border-color: transparent;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(10deg);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .stat-icon i {
            font-size: 2rem;
            color: var(--primary);
            transition: all 0.4s ease;
        }

        .stat-card:hover .stat-icon i {
            color: white;
        }

        .stat-info h4 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            line-height: 1.2;
        }

        .stat-info p {
            color: var(--gray);
            margin: 0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Section Title moderne */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
        }

        .section-title h3 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--dark), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            background: rgba(99, 102, 241, 0.05);
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .view-all:hover {
            gap: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: transparent;
        }

        .view-all i {
            transition: transform 0.3s ease;
        }

        .view-all:hover i {
            transform: translateX(5px);
        }

        /* Course Cards modernes */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.8rem;
            margin-bottom: 2.5rem;
        }

        .course-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #eef2f6;
            position: relative;
        }

        .course-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
            z-index: 2;
        }

        .course-card:hover::before {
            transform: scaleX(1);
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 40px 60px rgba(99, 102, 241, 0.1);
            border-color: transparent;
        }

        .course-image {
            height: 160px;
            background-size: cover;
            background-position: center;
            position: relative;
            transition: transform 0.8s ease;
        }

        .course-card:hover .course-image {
            transform: scale(1.05);
        }

        .course-progress-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            border: 1px solid rgba(99, 102, 241, 0.2);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .course-instructor {
            font-size: 0.9rem;
            color: var(--gray);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .course-instructor i {
            color: var(--primary);
            font-size: 1rem;
        }

        .progress-container {
            margin-bottom: 1.2rem;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .progress-bar-custom {
            height: 8px;
            background: #eef2f6;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 10px;
            width: 0%;
            transition: width 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .continue-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .continue-link:hover {
            gap: 1rem;
        }

        /* Activity List moderne */
        .activity-list {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid #eef2f6;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem 0;
            border-bottom: 1px solid #eef2f6;
            transition: all 0.3s ease;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            transform: translateX(10px);
        }

        .activity-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .activity-item:hover .activity-icon {
            transform: scale(1.1) rotate(10deg);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .activity-icon i {
            color: var(--primary);
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }

        .activity-item:hover .activity-icon i {
            color: white;
        }

        .activity-detail {
            flex: 1;
        }

        .activity-detail h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0 0 0.3rem 0;
        }

        .activity-detail p {
            font-size: 0.9rem;
            color: var(--gray);
            margin: 0;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #94a3b8;
            font-weight: 500;
            padding: 0.3rem 1rem;
            background: #f8fafc;
            border-radius: 50px;
        }

        /* Resources Grid moderne */
        .resources-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .resource-item {
            background: white;
            padding: 1rem;
            border-radius: 18px;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            border: 1px solid #eef2f6;
        }

        .resource-item:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02), rgba(139, 92, 246, 0.02));
            transform: translateY(-3px);
            border-color: var(--primary);
        }

        .resource-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .resource-icon i {
            font-size: 1.3rem;
            color: var(--primary);
        }

        .resource-info {
            flex: 1;
        }

        .resource-info h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0 0 0.2rem 0;
        }

        .resource-info p {
            font-size: 0.8rem;
            color: var(--gray);
            margin: 0;
        }

        .resource-download {
            color: var(--primary);
            font-size: 1.3rem;
            transition: all 0.3s ease;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .resource-download:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: scale(1.1);
        }

        /* Responsive amélioré */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .courses-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 992px) {
            :root {
                --sidebar-width: 80px;
            }

            .sidebar-logo span,
            .sidebar-menu a span {
                display: none;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 1rem;
            }

            .sidebar-menu a i {
                margin: 0;
                font-size: 1.5rem;
            }

            .sidebar-toggle {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .stats-grid,
            .courses-grid,
            .resources-grid {
                grid-template-columns: 1fr;
            }

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .user-info {
                width: 100%;
                justify-content: space-between;
            }

            .welcome-card h3 {
                font-size: 1.5rem;
            }
        }

        /* Loading animation */
        .skeleton {
            background: linear-gradient(90deg, #eef2f6 25%, #f8fafc 50%, #eef2f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #eef2f6;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
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
            padding: 0.5rem 1rem;
            background: var(--dark);
            color: white;
            font-size: 0.8rem;
            border-radius: 8px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        [data-tooltip]:hover:before {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-10px);
        }

        /* Badges de statut */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-badge.online {
            background: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        .status-badge.offline {
            background: rgba(100, 116, 139, 0.1);
            color: var(--gray);
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <a href="<?php echo e(route('apprenant.dashboard')); ?>" class="sidebar-logo">
        <i class="bi bi-mortarboard-fill"></i>
        <span>EduForm</span>
    </a>

    <ul class="sidebar-menu">
        <!-- Lien Home -->
        <li>
            <a href="<?php echo e(route('home')); ?>" data-tooltip="Accueil">
                <i class="bi bi-house-door-fill"></i>
                <span>Accueil</span>
            </a>
        </li>

        <li>
            <a href="<?php echo e(route('apprenant.dashboard')); ?>" class="active" data-tooltip="Tableau de bord">
                <i class="bi bi-speedometer2"></i>
                <span>Tableau de bord</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('apprenant.formations')); ?>" data-tooltip="Mes formations">
                <i class="bi bi-book"></i>
                <span>Mes formations</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('apprenant.continuer')); ?>" data-tooltip="Continuer">
                <i class="bi bi-play-circle"></i>
                <span>Continuer</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('apprenant.ressources')); ?>" data-tooltip="Ressources">
                <i class="bi bi-download"></i>
                <span>Ressources</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('apprenant.profil')); ?>" data-tooltip="Mon profil">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
            </a>
        </li>
        <li>
            <a href="<?php echo e(route('apprenant.parametres')); ?>" data-tooltip="Paramètres">
                <i class="bi bi-gear"></i>
                <span>Paramètres</span>
            </a>
        </li>

        <!-- Déconnexion sécurisée -->
        <li class="logout">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" data-tooltip="Déconnexion">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </li>
    </ul>
</aside>


    <!-- Sidebar Toggle Button -->
    <div class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-chevron-left" id="toggleIcon"></i>
    </div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h2>Tableau de bord</h2>
                <p><i class="bi bi-house-door me-1"></i> Accueil / Dashboard</p>
            </div>

            <div class="user-info">
                <div class="notifications" data-tooltip="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-notif" id="notificationBadge">3</span>
                </div>
                <div class="user-profile" onclick="window.location.href='<?php echo e(route('apprenant.profil')); ?>'">
                    <div class="user-avatar">
                        <?php echo e(strtoupper(substr(auth()->user()->nom, 0, 2))); ?>

                    </div>
                    <div>
                        <div class="user-name"><?php echo e(auth()->user()->nom); ?></div>
                        <div class="user-role">
                            <i class="bi bi-circle-fill"></i>
                            <?php echo e(ucfirst(auth()->user()->role)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="welcome-card" data-aos="fade-up">
            <h3>Bonjour, <?php echo e(auth()->user()->nom); ?> ! 👋</h3>
            <p>
                <?php
                $formationsCount = auth()->user()->formationsSuivies()->count();
                ?>
                Vous avez <?php echo e($formationsCount); ?> formation(s) en cours.
                Continuez votre apprentissage dès maintenant !
            </p>
            <a href="<?php echo e(route('apprenant.continuer')); ?>" class="continue-btn">
                <i class="bi bi-play-circle"></i>
                Reprendre ma dernière formation
            </a>
        </div>

        <!-- Stats -->

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-info">
                    <h4><?php echo e($stats['total_inscriptions']); ?></h4>
                    <p>Formations inscrites</p>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="bi bi-play-circle"></i>
                </div>
                <div class="stat-info">
                    <h4><?php echo e($stats['formations_en_cours']); ?></h4>
                    <p>En cours</p>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h4><?php echo e($stats['formations_terminees']); ?></h4>
                    <p>Terminées</p>
                </div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-icon">
                    <i class="bi bi-download"></i>
                </div>
                <div class="stat-info">
                    <h4><?php echo e($ressourcesCount); ?></h4>
                    <p>Ressources</p>
                </div>
            </div>
        </div>

        <!-- Mes formations en cours -->
        <div class="section-title" data-aos="fade-up">
            <h3><i class="bi bi-play-circle-fill me-2" style="color: var(--primary);"></i>Mes formations en cours</h3>
            <a href="<?php echo e(route('apprenant.formations')); ?>" class="view-all">
                Voir tout <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="courses-grid">
            <?php $__empty_1 = true; $__currentLoopData = $formationsEnCoursList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="course-card" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                <div class="course-image" style="background-image: url('<?php echo e($formation->image_url ?? 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>')">
                    <span class="course-progress-badge"><?php echo e($formation->pivot->progression ?? rand(10, 90)); ?>%</span>
                </div>
                <div class="course-content">
                    <h4 class="course-title"><?php echo e($formation->titre); ?></h4>
                    <p class="course-instructor">
                        <i class="bi bi-person"></i>
                        <?php echo e($formation->formateur->nom ?? 'Formateur'); ?>

                    </p>
                    <div class="progress-container">
                        <div class="progress-info">
                            <span>Progression</span>
                            <span><?php echo e($formation->pivot->progression ?? rand(10, 90)); ?>%</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: <?php echo e($formation->pivot->progression ?? rand(10, 90)); ?>%"></div>
                        </div>
                    </div>
                    <a href="<?php echo e(route('apprenant.formation.show', $formation->id)); ?>" class="continue-link">
                        Continuer <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <i class="bi bi-emoji-frown display-1 text-primary"></i>
                    <h4 class="mt-3">Aucune formation en cours</h4>
                    <p class="text-muted">Commencez une nouvelle formation dès maintenant !</p>
                    <a href="<?php echo e(route('formations')); ?>" class="btn btn-primary-modern mt-3">
                        <i class="bi bi-search me-2"></i>Explorer les formations
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Activité récente -->
        <div class="col-md-7">
            <div class="section-title" data-aos="fade-up">
                <h3><i class="bi bi-clock-history me-2" style="color: var(--primary);"></i>Activité récente</h3>
                <a href="<?php echo e(route('apprenant.activite')); ?>" class="view-all">
                    Voir tout <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="activity-list" data-aos="fade-up" data-aos-delay="100">
                <?php $__empty_1 = true; $__currentLoopData = $activitesRecentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-<?php echo e($activite->icone ?? 'play-circle'); ?>"></i>
                    </div>
                    <div class="activity-detail">
                        <h4><?php echo e($activite->titre); ?></h4>
                        <p><?php echo e($activite->description); ?></p>
                    </div>
                    <div class="activity-time"><?php echo e($activite->created_at->diffForHumans()); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="activity-detail">
                        <h4>Aucune activité récente</h4>
                        <p>Commencez à apprendre pour voir votre activité</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ressources -->
        <div class="col-md-5">
            <div class="section-title" data-aos="fade-up">
                <h3><i class="bi bi-files me-2" style="color: var(--primary);"></i>Ressources récentes</h3>
                <a href="<?php echo e(route('apprenant.ressources')); ?>" class="view-all">
                    Voir tout <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="resources-grid" data-aos="fade-up" data-aos-delay="100">
                <?php
                $apprenant = auth()->user();
                $formationsIds = \App\Models\Inscription::where('user_id', $apprenant->id)->pluck('formation_id');
                $modulesIds = \App\Models\Module::whereIn('formation_id', $formationsIds)->pluck('id');
                $ressourcesRecentes = \App\Models\Contenu::whereIn('module_id', $modulesIds)
                ->with('module.formation')
                ->latest()
                ->take(4)
                ->get();
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $ressourcesRecentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ressource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="resource-item">
                    <div class="resource-icon">
                        <i class="bi bi-file-<?php echo e($ressource->type == 'video' ? 'play' : 'text'); ?>"></i>
                    </div>
                    <div class="resource-info">
                        <h4><?php echo e(Str::limit($ressource->description ?? 'Ressource', 20)); ?></h4>
                        <p><?php echo e($ressource->module->formation->titre ?? 'Formation'); ?></p>
                    </div>
                    <a href="<?php echo e($ressource->url); ?>" target="_blank" class="resource-download">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <p class="text-muted text-center py-3">Aucune ressource disponible</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Calendrier simple -->
        <div class="mt-4" data-aos="fade-up" data-aos-delay="200">
            <div class="section-title">
                <h3><i class="bi bi-calendar-event me-2" style="color: var(--primary);"></i>Prochains événements</h3>
            </div>
            <div class="activity-list">
           
        </div>
        </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialisation AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-in-out'
        });

        // Gestion de la sidebar
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');

        // État initial basé sur le localStorage
        const sidebarState = localStorage.getItem('sidebarCollapsed') === 'true';

        if (sidebarState) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            toggleBtn.classList.add('collapsed');
            toggleIcon.classList.remove('bi-chevron-left');
            toggleIcon.classList.add('bi-chevron-right');
        }

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            toggleBtn.classList.toggle('collapsed');

            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('bi-chevron-left');
                toggleIcon.classList.add('bi-chevron-right');
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        }

        // Gestion du menu actif
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }

                document.querySelectorAll('.sidebar-menu a').forEach(l => {
                    l.classList.remove('active');
                });

                this.classList.add('active');

                // Sur mobile, fermer la sidebar après clic
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('mobile-visible');
                }
            });
        });

        // Simulation de notifications
        let notificationCount = parseInt(document.getElementById('notificationBadge').innerText);

        setInterval(() => {
            if (notificationCount < 9) {
                notificationCount++;
                document.getElementById('notificationBadge').innerText = notificationCount;

                // Animation de la notification
                const notifIcon = document.querySelector('.notifications i');
                notifIcon.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    notifIcon.style.transform = 'scale(1)';
                }, 200);
            }
        }, 30000); // Nouvelle notification toutes les 30 secondes

        // Détection de la connexion (simulation)
        window.addEventListener('online', function() {
            showNotification('Connexion rétablie', 'success');
        });

        window.addEventListener('offline', function() {
            showNotification('Connexion perdue', 'error');
        });

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification-${type}`;
            notification.innerHTML = message;
            notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 2rem;
            background: ${type === 'success' ? 'linear-gradient(135deg, var(--success), #16a34a)' : 'linear-gradient(135deg, var(--danger), #dc2626)'};
            color: white;
            border-radius: 10px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Gestion responsive
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                if (!sidebar.classList.contains('collapsed')) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            } else {
                const savedState = localStorage.getItem('sidebarCollapsed') === 'true';
                if (savedState) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }
        });

        // Lazy loading pour les images
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));

        // Gestion du chargement
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // Animation de la progression des formations
        const progressBars = document.querySelectorAll('.progress-fill');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    </script>

    <!-- Styles additionnels -->
    <style>
        /* Styles pour les animations */
        .notification-success,
        .notification-error {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 2rem;
            color: white;
            border-radius: 10px;
            z-index: 9999;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Bouton primaire moderne */
        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 60px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px rgba(99, 102, 241, 0.3);
            color: white;
        }

        /* État vide */
        .empty-state {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            border: 2px dashed #e2e8f0;
        }

        /* Loading state */
        .loading-skeleton {
            background: linear-gradient(90deg, #eef2f6 25%, #f8fafc 50%, #eef2f6 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        /* Tooltips personnalisés */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.5rem 1rem;
            background: var(--dark);
            color: white;
            font-size: 0.8rem;
            border-radius: 8px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        [data-tooltip]:hover:before {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-10px);
        }
    </style>
</body>

</html><?php /**PATH C:\Users\HP\plateforme-formation\resources\views/apprenant/dashboard.blade.php ENDPATH**/ ?>