<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="modalPacienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Encabezado -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalPacienteLabel"><i class="fas fa-edit text-warning me-2"></i>Editar
                    Paciente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>

            <!-- Cuerpo con el formulario -->
            <form id="formPaciente" method="POST" action="{{ route('pacientes.update', $paciente->id_paciente) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre del paciente</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $paciente->nombre }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Edad (años)</label>
                        <input type="number" class="form-control" name="edad" value="{{ $paciente->edad }}" min="0"
                            required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Especie</label>
                        <select class="form-select" name="especie" required>
                            <option value="Perro" {{ $paciente->especie === 'Perro' ? 'selected' : '' }}>Perro</option>
                            <option value="Gato" {{ $paciente->especie === 'Gato' ? 'selected' : '' }}>Gato</option>
                            <option value="Ave" {{ $paciente->especie === 'Ave' ? 'selected' : '' }}>Ave</option>
                            <option value="Conejo" {{ $paciente->especie === 'Conejo' ? 'selected' : '' }}>Conejo</option>
                            <option value="Otro" {{ $paciente->especie === 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Raza</label>
                        <input type="text" class="form-control" name="raza" value="{{ $paciente->raza }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Nombre del dueño</label>
                        <input type="text" class="form-control" name="nombre_duenio"
                            value="{{ $paciente->nombre_duenio }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono_duenio"
                            value="{{ $paciente->telefono_duenio }}">
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar cambios
                    </button>
                </div>
            </form>




        </div>
    </div>
</div>