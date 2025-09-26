<div class="modal fade" id="create" tabindex="-1" aria-labelledby="modalPacienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Encabezado -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalPacienteLabel"><i class="fas fa-paw me-2"></i> Registrar Nuevo Paciente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>

            <!-- Cuerpo con el formulario -->
            <div class="modal-body">
                <form id="formPaciente" method="POST" action="{{ route('pacientes.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre del paciente</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="especie" class="form-label">Especie</label>
                            <input type="text" class="form-control" id="especie" name="especie" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="raza" class="form-label">Raza</label>
                            <input type="text" class="form-control" id="raza" name="raza">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" min="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_duenio" class="form-label">Nombre del Dueño</label>
                            <input type="text" class="form-control" id="nombre_duenio" name="nombre_duenio" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefono_duenio" class="form-label">Teléfono del Dueño</label>
                            <input type="number" class="form-control" id="telefono_duenio" name="telefono_duenio">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="submit" form="formPaciente" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Pie con botones -->


        </div>
    </div>
</div>