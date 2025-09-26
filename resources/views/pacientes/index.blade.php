@extends('layouts.app')

@section('title', 'Gestión de Pacientes - VetCare')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-heart-pulse paw-icon me-3"></i>Gestión de Pacientes
                </h1>
                <p class="lead mb-0">Administra la información de tus pacientes de forma eficiente y profesional</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-vet-success btn-lg" data-bs-toggle="modal" data-bs-target="#pacienteModal">
                    <i class="bi bi-plus-circle me-2"></i>Nuevo Paciente
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="container">
        <form method="GET" action="{{ route('pacientes.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" name="search" 
                           placeholder="Buscar paciente..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="especie">
                    <option value="todas">Todas las especies</option>
                    @foreach($especies as $especie)
                        <option value="{{ $especie }}" {{ request('especie') == $especie ? 'selected' : '' }}>
                            {{ ucfirst($especie) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-vet-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filtrar
                </button>
            </div>
        </form>
        
        @if(request()->hasAny(['search', 'especie']))
            <div class="mt-3">
                <a href="{{ route('pacientes.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-clockwise me-1"></i>Limpiar filtros
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Patients List -->
<div class="container my-5">
    <div class="card card-custom">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-list-ul me-2"></i>Lista de Pacientes
                <span class="badge bg-secondary ms-2">{{ $pacientes->total() }}</span>
            </h5>
        </div>
        <div class="card-body p-0">
            @if($pacientes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Especie</th>
                                <th>Raza</th>
                                <th>Dueño</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pacientes as $paciente)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary rounded-pill">#{{ $paciente->id_paciente }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-heart-pulse text-success me-2"></i>
                                            <div>
                                                <strong>{{ $paciente->nombre }}</strong>
                                                @if($paciente->edad)
                                                    <small class="text-muted d-block">{{ $paciente->edad }} años</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-especie 
                                            @if($paciente->especie == 'perro') bg-warning
                                            @elseif($paciente->especie == 'gato') bg-info
                                            @elseif($paciente->especie == 'ave') bg-success
                                            @else bg-secondary
                                            @endif">
                                            {{ ucfirst($paciente->especie) }}
                                        </span>
                                    </td>
                                    <td>{{ $paciente->raza ?: 'No especificada' }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $paciente->nombre_duenio }}</strong>
                                            @if($paciente->email_duenio)
                                                <small class="text-muted d-block">{{ $paciente->email_duenio }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($paciente->telefono_duenio)
                                            <a href="tel:{{ $paciente->telefono_duenio }}" class="text-decoration-none">
                                                <i class="bi bi-telephone me-1"></i>{{ $paciente->telefono_duenio }}
                                            </a>
                                        @else
                                            <span class="text-muted">No disponible</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pacientes.tratamientos', $paciente) }}" 
                                               class="btn btn-sm btn-outline-info" title="Ver tratamientos">
                                                <i class="bi bi-clipboard-pulse"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-warning edit-paciente" 
                                                    data-id="{{ $paciente->id_paciente }}" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger delete-paciente" 
                                                    data-id="{{ $paciente->id_paciente }}" 
                                                    data-name="{{ $paciente->nombre }}" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="card-footer bg-white">
                    {{ $pacientes->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="text-muted mt-3">No se encontraron pacientes</h4>
                    <p class="text-muted">Comienza agregando tu primer paciente</p>
                    <button class="btn btn-vet-success" data-bs-toggle="modal" data-bs-target="#pacienteModal">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Paciente
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para Crear/Editar Paciente -->
<div class="modal fade" id="pacienteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-heart-pulse me-2"></i>
                    <span id="modal-title">Nuevo Paciente</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="pacienteForm">
                @csrf
                <input type="hidden" id="paciente_id" name="paciente_id">
                <input type="hidden" id="form_method" name="_method" value="POST">
                
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre de la mascota *</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Especie *</label>
                            <select class="form-select" name="especie" id="especie" required>
                                <option value="">Seleccionar especie</option>
                                <option value="perro">Perro</option>
                                <option value="gato">Gato</option>
                                <option value="ave">Ave</option>
                                <option value="conejo">Conejo</option>
                                <option value="hamster">Hámster</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Raza</label>
                            <input type="text" class="form-control" name="raza" id="raza">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Edad (años)</label>
                            <input type="number" class="form-control" name="edad" id="edad" min="0">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Nombre del dueño *</label>
                            <input type="text" class="form-control" name="nombre_duenio" id="nombre_duenio" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono_duenio" id="telefono_duenio">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email del dueño</label>
                            <input type="email" class="form-control" name="email_duenio" id="email_duenio">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-vet-success">
                        <i class="bi bi-check-circle me-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Configurar CSRF token para AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Abrir modal para nuevo paciente
    $('#pacienteModal').on('show.bs.modal', function() {
        if (!$(this).data('editing')) {
            $('#pacienteForm')[0].reset();
            $('#modal-title').text('Nuevo Paciente');
            $('#form_method').val('POST');
            $('#paciente_id').val('');
        }
    });

    // Limpiar flag de edición al cerrar modal
    $('#pacienteModal').on('hidden.bs.modal', function() {
        $(this).removeData('editing');
    });

    // Editar paciente
    $('.edit-paciente').click(function() {
        const id = $(this).data('id');
        
        $.get(`/pacientes/${id}/edit`, function(data) {
            $('#modal-title').text('Editar Paciente');
            $('#form_method').val('PUT');
            $('#paciente_id').val(data.id_paciente);
            $('#nombre').val(data.nombre);
            $('#especie').val(data.especie);
            $('#raza').val(data.raza);
            $('#edad').val(data.edad);
            $('#nombre_duenio').val(data.nombre_duenio);
            $('#telefono_duenio').val(data.telefono_duenio);
            $('#email_duenio').val(data.email_duenio);
            
            $('#pacienteModal').data('editing', true).modal('show');
        });
    });

    // Enviar formulario
    $('#pacienteForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const id = $('#paciente_id').val();
        const method = $('#form_method').val();
        const url = method === 'POST' ? '/pacientes' : `/pacientes/${id}`;
        
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#pacienteModal').modal('hide');
                    showAlert('success', response.message);
                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                let errorMessage = 'Error al procesar la solicitud:\n';
                
                for (let field in errors) {
                    errorMessage += `• ${errors[field][0]}\n`;
                }
                
                showAlert('danger', errorMessage);
            }
        });
    });

    // Eliminar paciente
    $('.delete-paciente').click(function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        
        if (confirm(`¿Estás seguro de que deseas eliminar al paciente "${name}"?\n\nEsta acción también eliminará todos sus tratamientos asociados.`)) {
            $.ajax({
                url: `/pacientes/${id}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        setTimeout(() => location.reload(), 1500);
                    }
                },
                error: function() {
                    showAlert('danger', 'Error al eliminar el paciente');
                }
            });
        }
    });

    // Función para mostrar alertas
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('body').append(alertHtml);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
});
</script>
@endsection
