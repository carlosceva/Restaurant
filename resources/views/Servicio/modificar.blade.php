<!-- editar-servicio -->
<div class="modal fade" id="editModal{{ $servicio->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $servicio->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $servicio->id }}">Editar Servicio</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarForm" action="{{ route('servicio.update', $servicio->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $servicio->descripcion }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                    <option value="">Seleccionar Estado</option>
                        <option value="a">Activo</option>
                        <option value="i">Inactivo</option>
                    </select>
                </div>
                
                <!-- ... Código posterior ... -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>