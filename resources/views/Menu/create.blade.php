@extends('dashboard')

@section('content')
<div class="container">
    <h2>Crear Menú</h2>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
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
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
