@extends('layouts.app')

@section('title', 'Todos los Tratamientos - VetCare')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="bi bi-clipboard-pulse paw-icon me-3"></i>Todos los Tratamientos
                </h1>
                <p class="lead mb-0">Visualiza y gestiona todos los tratamientos realizados en la veterinaria</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-vet-success btn-lg" data-bs-toggle="modal" data-bs-target="#tratamientoModal">
                    <i class="bi bi-plus-circle me-2"></i>Nuevo Tratamiento
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="container">
        <form method="GET" action="{{ route('tratamientos.todos') }}" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" name="search" 
                           placeholder="Buscar tratamiento..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="fecha_desde" 
                       placeholder="Fecha desde" value="{{ request('fecha_desde') }}">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="fecha_hasta" 
                       placeholder="Fecha hasta" value="{{ request('fecha_hasta') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-vet-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filtrar
                </button>
            </div>
        </form>
        
        @if(request()->hasAny(['search', 'fecha_desde', 'fecha_hasta']))
            <div class="mt-3">
                <a href="{{ route('tratamientos.todos') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-clockwise me-1"></i>Limpiar filtros
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Treatments List -->
<div class="container my-5">
    <div class="card card-custom">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="bi bi-list-ul me-2"></i>Lista de Tratamientos
                        <span class="badge bg-secondary ms-2">{{ $tratamientos->total() }}</span>
                    </h5>
                </div>
                <div class="col-auto">
                    @if($tratamientos->count() > 0)
                        <div class="text-muted small">
                            Total facturado: 
                            <strong class="text-success">
                                ${{ number_format($tratamientos->sum('costo'), 2) }}
                            </strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($tratamientos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Descripción</th>
                                <th>Veterinario</th>
                                <th>Costo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tratamientos as $tratamiento)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-event text-primary me-2"></i>
                                            <div>
                                            <strong>{{ $tratamiento->fecha->format('d/m/Y') }}</strong>
                                                <small class="text-muted d-block">{{ $tratamiento->fecha->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-heart-pulse text-success me-2"></i>
                                            <div>
                                                <strong>{{ $tratamiento->paciente->nombre }}</strong>
                                                <small class="text-muted d-block">
                                                    {{ ucfirst($tratamiento->paciente->especie) }} - 
                                                    {{ $tratamiento->paciente->nombre_duenio }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="treatment-description">
                                            {{ Str::limit($tratamiento->descripcion, 80) }}
                                            @if(strlen($tratamiento->descripcion) > 80)
                                                <button class="btn btn-link btn-sm p-0 ms-1" 
                                                        data-bs-toggle="tooltip" 
                                                        title="{{ $tratamiento->descripcion }}">
                                                    <i class="bi bi-info-circle"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($tratamiento->veterinario)
                                            <i class="bi bi-person-badge text-success me-1"></i>
                                            {{ $tratamiento->veterinario }}
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tratamiento->costo)
                                            <span class="badge bg-success">
                                                ${{ number_format($tratamiento->costo, 2) }}
                                            </span>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pacientes.tratamientos', $tratamiento->paciente) }}" 
                                               class="btn btn-sm btn-outline-info" title="Ver paciente">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-warning edit-tratamiento" 
                                                    data-id="{{ $tratamiento->id_tratamiento }}" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger delete-tratamiento" 
                                                    data-id="{{ $tratamiento->id_tratamiento }}" 
                                                    data-paciente="{{ $tratamiento->paciente->nombre }}"
                                                    data-fecha="{{ $tratamiento->fecha->format('d/m/Y') }}" title="Eliminar">
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
                    {{ $tratamientos->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-clipboard-x display-1 text-muted"></i>
                    <h4 class="text-muted mt-3">No se encontraron tratamientos</h4>
                    <p class="text-muted">Los tratamientos aparecerán aquí una vez que sean registrados</p>
                    <button class="btn btn-vet-success" data-bs-toggle="modal" data-bs-target="#tratamientoModal">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Tratamiento
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para Crear/Editar Tratamiento -->
<div class="modal fade" id="tratamientoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bi bi-clipboard-pulse me-2"></i>
                    <span id="modal-title">Nuevo Tratamiento</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="tratamientoForm">
                @csrf
                <input type="hidden" id="tratamiento_id" name="tratamiento_id">
                <input type="hidden" id="form_method" name="_method" value="POST">
                
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Paciente *</label>
                            <select class="form-select" name="id_paciente" id="id_paciente" required>
                                <option value="">Seleccionar paciente</option>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id_paciente }}">
                                        {{ $paciente->nombre }} - {{ $paciente->nombre_duenio }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha del tratamiento *</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" 
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Veterinario</label>
                            <input type="text" class="form-control" name="veterinario" id="veterinario">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Costo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" name="costo" id="costo" 
                                       step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descripción del tratamiento *</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" 
                                      rows="4" required placeholder="Describe el tratamiento realizado..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-vet-success">
                        <i class="bi bi-check-circle me-2"></i>Guardar Tratamiento
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

    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Abrir modal para nuevo tratamiento
    $('#tratamientoModal').on('show.bs.modal', function() {
        if (!$(this).data('editing')) {
            $('#tratamientoForm')[0].reset();
            $('#fecha').val('{{ date("Y-m-d") }}');
            $('#modal-title').text('Nuevo Tratamiento');
            $('#form_method').val('POST');
            $('#tratamiento_id').val('');
        }
    });

    // Limpiar flag de edición al cerrar modal
    $('#tratamientoModal').on('hidden.bs.modal', function() {
        $(this).removeData('editing');
    });

    // Editar tratamiento
    $('.edit-tratamiento').click(function() {
        const id = $(this).data('id');
        
        $.get(`/tratamientos/${id}/edit`, function(data) {
            $('#modal-title').text('Editar Tratamiento');
            $('#form_method').val('PUT');
            $('#tratamiento_id').val(data.id_tratamiento);
            $('#id_paciente').val(data.id_paciente);
            $('#fecha').val(data.fecha);
            $('#veterinario').val(data.veterinario);
            $('#descripcion').val(data.descripcion);
            $('#costo').val(data.costo);
            
            $('#tratamientoModal').data('editing', true).modal('show');
        });
    });

    // Enviar formulario
    $('#tratamientoForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const id = $('#tratamiento_id').val();
        const method = $('#form_method').val();
        const url = method === 'POST' ? '/tratamientos' : `/tratamientos/${id}`;
        
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#tratamientoModal').modal('hide');
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

    // Eliminar tratamiento
    $('.delete-tratamiento').click(function() {
        const id = $(this).data('id');
        const paciente = $(this).data('paciente');
        const fecha = $(this).data('fecha');
        
        if (confirm(`¿Estás seguro de que deseas eliminar el tratamiento de ${paciente} del ${fecha}?`)) {
            $.ajax({
                url: `/tratamientos/${id}`,
                method: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        setTimeout(() => location.reload(), 1500);
                    }
                },
                error: function() {
                    showAlert('danger', 'Error al eliminar el tratamiento');
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
