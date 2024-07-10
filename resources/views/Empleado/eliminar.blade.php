<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $empleado->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $empleado->id }}">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar al usuario? <b>{{$empleado->nombre}}</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('empleado.destroy', $empleado->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Modal -->