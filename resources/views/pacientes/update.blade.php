<!-- Modal Editar Paciente -->
<div class="modal fade" id="edit{{ $paciente->id_paciente }}" tabindex="-1" aria-labelledby="modalEditarPacienteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title" id="modalEditarPacienteLabel">
                    <i class="fas fa-edit me-2"></i>Editar Paciente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>

            <!-- Formulario -->
            <form id="formEditarPaciente" method="POST"
                action="{{ route('pacientes.update', $paciente->id_paciente ?? 0) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nombre del paciente</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $paciente->nombre ?? '' }}"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Edad (años)</label>
                            <input type="number" name="edad" class="form-control" value="{{ $paciente->edad ?? '' }}"
                                min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Especie</label>
                            <select name="especie" class="form-select" required>
                                <option value="Perro" {{ ($paciente->especie ?? '') == 'Perro' ? 'selected' : '' }}>Perro
                                </option>
                                <option value="Gato" {{ ($paciente->especie ?? '') == 'Gato' ? 'selected' : '' }}>Gato
                                </option>
                                <option value="Ave" {{ ($paciente->especie ?? '') == 'Ave' ? 'selected' : '' }}>Ave
                                </option>
                                <option value="Conejo" {{ ($paciente->especie ?? '') == 'Conejo' ? 'selected' : '' }}>
                                    Conejo</option>
                                <option value="Otro" {{ ($paciente->especie ?? '') == 'Otro' ? 'selected' : '' }}>Otro
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Raza</label>
                            <input type="text" name="raza" class="form-control" value="{{ $paciente->raza ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nombre del dueño</label>
                            <input type="text" name="nombre_duenio" class="form-control"
                                value="{{ $paciente->nombre_duenio ?? '' }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" name="telefono_duenio" class="form-control"
                                value="{{ $paciente->telefono_duenio ?? '' }}">
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>