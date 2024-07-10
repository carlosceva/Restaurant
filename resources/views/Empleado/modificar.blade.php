<!-- editar-usuario -->
<div class="modal fade" id="editModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $empleado->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $empleado->id }}">Editar Empleado</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm" action="{{ route('empleado.update', ['empleado' => $empleado->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->nombre }}" required>
                </div>
                <div class="mb-3">
                    <label for="ci" class="form-label">Cedula de identidad</label>
                    <input type="text" class="form-control" id="ci" name="ci" value="{{ $empleado->ci }}" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="number" class="form-control" id="telefono" name="telefono" value="{{ $empleado->telefono }}" required>
                </div>
                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <input type="text" class="form-control" id="turno" name="turno" value="{{ $empleado->turno }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->usuario }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" >
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="a" {{ $empleado->estado == 'a' ? 'selected' : '' }}>Activo</option>
                        <option value="i" {{ $empleado->estado == 'i' ? 'selected' : '' }}>Inactivo</option>
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