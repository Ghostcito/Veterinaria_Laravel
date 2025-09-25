<!-- Modal Eliminar -->
<div class="modal fade" id="delete{{ $paciente->id_paciente }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-gradient-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirmar eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar al paciente
                    <strong>{{ $paciente->nombre }}</strong>?
                    Esta acción no se puede deshacer.
                </p>
            </div>

            <div class="modal-footer">
                <form action="{{ route('pacientes.destroy', $paciente->id_paciente) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>