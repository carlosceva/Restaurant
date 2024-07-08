<!-- editar-usuario -->
<div class="modal fade" id="editModal{{ $usuario->user }}" tabindex="-1" aria-labelledby="editModalLabel{{ $usuario->user }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $usuario->user }}">Editar Usuario</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm" action="{{ route('usuario.update', ['usuario' => $usuario->user]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->correo }}" required>
                </div>
                <!-- ... Código anterior ... -->
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="">Seleccionar Rol</option>
                        <option value="1">Administrador</option>
                        <option value="2">Cajero</option>
                        <option value="3">Cliente</option>
                    </select>
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