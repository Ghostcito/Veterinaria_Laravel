<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'VetCare - Sistema Veterinario')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --vet-primary: #2d5a4a;
            --vet-secondary: #4a7c59;
            --vet-accent: #f39c12;
            --vet-light: #e8f5e8;
            --vet-dark: #1a3d2e;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(135deg, var(--vet-primary) 0%, var(--vet-secondary) 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--vet-primary) 0%, var(--vet-secondary) 100%);
            color: white;
            padding: 3rem 0;
        }

        .btn-vet-primary {
            background-color: var(--vet-secondary);
            border-color: var(--vet-secondary);
            color: white;
        }

        .btn-vet-primary:hover {
            background-color: var(--vet-primary);
            border-color: var(--vet-primary);
            color: white;
        }

        .btn-vet-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-vet-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .card-custom {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .badge-especie {
            font-size: 0.8em;
            padding: 0.4em 0.8em;
        }

        .search-section {
            background-color: var(--vet-dark);
            padding: 2rem 0;
        }

        .paw-icon {
            color: var(--vet-accent);
        }

        /* Estilos mejorados para validación */
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-control.is-valid {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .character-counter {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            color: white;
            font-size: 2rem;
        }

        .alert.position-fixed {
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('pacientes.index') }}">
                <i class="bi bi-heart-pulse paw-icon me-2"></i>VetCare
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pacientes.*') ? 'active' : '' }}"
                            href="{{ route('pacientes.index') }}">
                            <i class="bi bi-house me-1"></i>Pacientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tratamientos.*') ? 'active' : '' }}"
                            href="{{ route('tratamientos.todos') }}">
                            <i class="bi bi-clipboard-pulse me-1"></i>Tratamientos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Archivo JavaScript personalizado -->
    <script src="{{ asset('js/veterinaria.js') }}"></script>

    @yield('scripts')
</body>

</html>