@extends('dashboard')

@section('content')
<div class="container">
    <h2>Gestión de Menús</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createMenuModal">Crear Menú</button>

    <div class="card table-responsive">
        <div class="card-body">
            <table class="table table-hover" id="menus">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>DESCRIPCION</th>
                        <th>ESTADO</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($menus as $menu)
                <?php $collapseId = "menu-{$menu->id}-details"; ?>
                    <tr data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->descripcion }}</td>
                        <td>{{ $menu->estado == 'a' ? 'Activo' : 'Inactivo' }}</td>
                        <td class="text-end">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editMenuModal" data-menu-id="{{ $menu->id }}" data-menu-descripcion="{{ $menu->descripcion }}" data-menu-estado="{{ $menu->estado }}">Editar</button>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <tr class="accordion-collapse collapse" id="{{ $collapseId }}">
                        <td colspan="4">
                            <div class="accordion-body">
                                <h5>Detalles del Menú</h5>
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createDetailModal" data-menu-id="{{ $menu->id }}">Agregar Detalle</button>
                                <ul>
                                    @foreach($menu->detalleMenus as $detalle)
                                        @if($detalle->producto)
                                        <li>
                                            {{ $detalle->producto->nombre }} - {{ $detalle->producto->descripcion }} - ${{ $detalle->producto->precio }}
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editDetailModal" data-detail-id="{{ $detalle->id }}" data-detail-producto-id="{{ $detalle->producto->id }}" data-detail-estado="{{ $detalle->estado }}">Editar</button>
                                            <form action="{{ route('menus.detalles.destroy', [$menu->id, $detalle->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modales -->

<!-- Modal para Crear Menú -->
<div class="modal fade" id="createMenuModal" tabindex="-1" aria-labelledby="createMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('menus.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createMenuModalLabel">Crear Menú</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="a">Activo</option>
                            <option value="i">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Menú -->
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editMenuForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">Editar Menú</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editDescripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="editDescripcion" name="descripcion" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEstado" class="form-label">Estado</label>
                        <select class="form-control" id="editEstado" name="estado" required>
                            <option value="a">Activo</option>
                            <option value="i">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div

@endsection