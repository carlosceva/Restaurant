<!-- editar-categoria -->
<div class="modal fade" id="editModal{{ $promocion->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $promocion->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $promocion->id }}">Editar promocion</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarForm" action="{{ route('promocion.update', $promocion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="descuento" class="form-label">Nombre</label>
                    <input type="number" class="form-control" id="descuento" name="descuento" value="{{ $promocion->descuento }}" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_i" class="form-label">Fecha de inicio</label>
                    <input type="date" class="form-control" id="fecha_i" name="fecha_i" value="{{ $promocion->fecha_i }}" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_f" class="form-label">Fecha fin</label>
                    <input type="date" class="form-control" id="fecha_f" name="fecha_f" value="{{ $promocion->fecha_f }}" required>
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