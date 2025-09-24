@extends('home')
@section('table-content')

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
                    <!-- Los datos se cargarán con JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

@endsection