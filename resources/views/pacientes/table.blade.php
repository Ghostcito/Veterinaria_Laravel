@extends('home')
@section('table')

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
                        <td><span class="badge bg-primary">{{ $paciente->id }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2">
                                    <i class="fas fa-paw text-primary"></i>
                                </div>
                                <div>
                                    <strong>{{ $paciente->nombre }}</strong>
                                    <br><small class="text-muted">{{ $paciente->edad }} años</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $paciente->especie }}</span>
                        </td>
                        <td>{{ $paciente->raza }}</td>
                        <td>
                            <div>
                                <strong>{{ $paciente->nombre_duenio }}</strong>
                                <br><small class="text-muted">{{ $paciente->telefono_duenio }}</small>
                            </div>
                        </td>
                        <td>
                            <i class="fas fa-phone me-1"></i>{{ $paciente->fecha_registro }}
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

@endsection