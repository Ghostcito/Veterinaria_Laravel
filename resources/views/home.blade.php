<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetCare - Gestión de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-paw me-2"></i>VetCare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html"><i class="fas fa-dog me-1"></i>Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{url('tratamiento') }}><i
                                class="fas fa-prescription-bottle-medical me-1"></i>Tratamientos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold text-white mb-3">
                        <i class="fas fa-paw text-warning me-3"></i>Gestión de Pacientes
                    </h1>
                    <p class="lead text-white-50">Administra la información de tus pacientes de forma eficiente y
                        profesional</p>
                </div>
                <div class="col-lg-4 text-end">
                    <button class="btn btn-success btn-lg shadow-lg" onclick="mostrarFormularioNuevoPaciente()">
                        <i class="fas fa-plus me-2"></i>Nuevo Paciente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Search and Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="buscarPaciente"
                                placeholder="Buscar paciente...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filtroEspecie">
                            <option value="">Todas las especies</option>
                            <option value="Perro">Perro</option>
                            <option value="Gato">Gato</option>
                            <option value="Ave">Ave</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-primary w-100" onclick="limpiarFiltros()">
                            <i class="fas fa-refresh me-1"></i>Limpiar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patients Table -->
        <div class="card shadow">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Lista de Pacientes</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-id-card me-1"></i>ID</th>
                                <th><i class="fas fa-paw me-1"></i>Nombre</th>
                                <th><i class="fas fa-dog me-1"></i>Especie</th>
                                <th><i class="fas fa-palette me-1"></i>Raza</th>
                                <th><i class="fas fa-user me-1"></i>Dueño</th>
                                <th><i class="fas fa-phone me-1"></i>Teléfono</th>
                                <th><i class="fas fa-cogs me-1"></i>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaPacientes">
                            @foreach ($pacientes as $paciente)
                                <td><span class="badge bg-primary">${paciente.id}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <i class="fas fa-paw text-primary"></i>
                                        </div>
                                        <div>
                                            <strong>${paciente.nombre}</strong>
                                            <br><small class="text-muted">${paciente.edad} años</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">${paciente.especie}</span>
                                </td>
                                <td>${paciente.raza}</td>
                                <td>
                                    <div>
                                        <strong>${paciente.dueno}</strong>
                                        <br><small class="text-muted">${paciente.email}</small>
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-phone me-1"></i>${paciente.telefono}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm" title="Ver tratamientos">
                                            <i class="fas fa-stethoscope"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/pacientes.js"></script>
</body>

</html>