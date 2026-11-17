<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStock - Gestion du Parc</title>
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-app: #f8fafc;          /* Fond gris-bleu ultra doux */
            --primary: #4f46e5;         /* Indigo moderne et chic */
            --primary-hover: #4338ca;
            --success: #10b981;         /* Vert émeraude classe */
            --success-hover: #059669;
            --info: #0ea5e9;            /* Bleu ciel électrique */
            --info-hover: #0284c7;
            --danger: #f43f5e;          /* Rose-rouge moderne */
            --text-main: #1e293b;       /* Ardoise foncé pour la lisibilité */
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Animation d'entrée douce */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            margin: 0;
            padding-bottom: 4rem;
        }

        /* Navbar Uniforme Premium */
        .navbar-custom {
            background-color: #0f172a;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
        }

        .navbar-brand-custom {
            font-weight: 800;
            color: #ffffff !important;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link-custom {
            color: #94a3b8 !important;
            font-weight: 600;
            margin-left: 1.5rem;
            font-size: 0.95rem;
            transition: var(--transition);
            position: relative;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -6px;
            left: 0;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .nav-link-custom:hover::after, .nav-link-custom.active::after {
            width: 100%;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            color: #ffffff !important;
        }

        /* LE DESIGN UNIFORME DES CARTES (Card-Wow) */
        .card-wow {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: var(--transition);
            animation: fadeInUp 0.5s ease forwards;
            position: relative;
            overflow: hidden;
        }

        /* Barre d'accent de couleur sur chaque carte pour l'effet premium */
        .card-wow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary);
            opacity: 0.8;
        }

        .card-wow-success::before {
            background-color: var(--success);
        }

        /* Effet Wow de survol sur toutes les cartes de l'application */
        .card-wow:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #cbd5e1;
        }

        .card-title-wow {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Champs de formulaire modernes */
        .form-label {
            font-weight: 700;
            color: #475569;
            font-size: 0.88rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control, .form-select {
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: #f8fafc;
            color: var(--text-main);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
            transform: translateY(-1px);
        }

        /* Boutons Premium Interactifs */
        .btn-wow {
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .btn-wow-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
        }

        .btn-wow-primary:hover {
            background-color: var(--primary-hover);
            transform: scale(1.03) translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
            color: white;
        }

        .btn-wow-success {
            background-color: var(--success);
            color: white;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
        }

        .btn-wow-success:hover {
            background-color: var(--success-hover);
            transform: scale(1.03) translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.45);
            color: white;
        }

        .btn-wow-outline {
            background-color: transparent;
            color: var(--info);
            border: 2px solid var(--info);
        }

        .btn-wow-outline:hover {
            background-color: var(--info);
            color: white;
            transform: scale(1.03) translateY(-2px);
            box-shadow: 0 6px 15px rgba(14, 165, 233, 0.3);
        }

        .btn-wow-danger {
            background-color: transparent;
            color: var(--danger);
            border: 2px solid var(--danger);
        }

        .btn-wow-danger:hover {
            background-color: var(--danger);
            color: white;
            transform: scale(1.03) translateY(-2px);
            box-shadow: 0 6px 15px rgba(244, 63, 94, 0.3);
        }

        /* Lignes de tableaux interactives */
        .table-custom tbody tr {
            transition: var(--transition);
        }

        .table-custom tbody tr:hover {
            background-color: rgba(79, 70, 229, 0.03) !important;
            transform: scale(1.01);
        }

        /* Badges */
        .badge-wow {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom mb-5">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="{{ route('devices.index') }}">
                <span>💻</span> TechStock
            </a>
            <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link nav-link-custom {{ Request::is('devices*') ? 'active' : '' }}" href="{{ route('devices.index') }}">Équipements</a>
                    <a class="nav-link nav-link-custom {{ Request::is('rooms*') ? 'active' : '' }}" href="{{ route('rooms.index') }}">Salles</a>
                    <a class="nav-link nav-link-custom {{ Request::is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Catégories</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 1200px;">
        @if(session('success'))
            <div class="alert alert-success border-0 py-3 px-4 mb-4 shadow-lg" style="background-color: #ecfdf5; color: #047857; border-radius: 12px; font-weight: 700; font-size: 0.95rem; animation: fadeInUp 0.4s ease;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>