@extends('dashboard')

@section('content')
<div class="container">
    <h2>Editar Menú</h2>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $menu->descripcion }}" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="a" {{ $menu->estado == 'a' ? 'selected' : '' }}>Activo</option>
                <option value="i" {{ $menu->estado == 'i' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
