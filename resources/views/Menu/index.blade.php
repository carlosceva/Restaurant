@extends('dashboard')

@section('title', 'G. Menú')

@section('content')
<div class="card-header">
    <h1 class="card-title">
        <i class="fas fa-utensils mr-1"></i>
        <b>GESTIONAR MENÚ</b>
    </h1>
    <div class="float-right d-sm-block">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a href="" data-toggle="modal" data-target="#agregarModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card table-responsive">
    <div class="card-body">
        <table class="table table-hover" id="menus">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>{{ $menu->descripcion }}</td>
                        <td>{{ $menu->estado }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detalleMenuModal" data-menu-id="{{ $menu->id }}">
                                Ver Detalles
                            </button>
                            &nbsp;
                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $menu->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @include('Menu.eliminar', ['menu' => $menu])
                @endforeach
            </tbody>
        </table>

        {{ $menus->links() }}

        <div class="modal fade" id="detalleMenuModal" tabindex="-1" aria-labelledby="detalleMenuModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detalleMenuModalLabel">Detalles de Menú</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="detalleMenuModalBody"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var detalleMenuModal = document.getElementById('detalleMenuModal');
    detalleMenuModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var menuId = button.getAttribute('data-menu-id');

        fetch('/menus/' + menuId + '/detalles')
            .then(response => response.text())
            .then(html => {
                document.getElementById('detalleMenuModalBody').innerHTML = html;
            });
    });
</script>

@include('Menu.agregar')
@endsection

