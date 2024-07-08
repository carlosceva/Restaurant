@extends('dashboard')

@section('title', 'G. Privilegio')

@section('content')
    <div class="card-header">
        <h1 class="card-title">
            <i class="fas fa-clock mr-1"></i>
            <b>GESTIONAR PRIVILEGIO   </b> 
        </h1>
        <div class="float-right d-sm-block"> 
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="#" data-toggle="modal" data-target="#agregarHorarioModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
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
        <table class="table table-hover" id="privilegios">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>ROL</th>
                    <th>FUNCIONALIDAD</th>
                    <th>AGREGAR</th>
                    <th>BORRAR</th>
                    <th>MODIFICAR</th>
                    <th>LEER</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($privilegios as $privilegio)
                <tr>
                    <td>{{ $privilegio->id }}</td>
                    <td>{{ $privilegio->rol->nombre }}</td>
                    <td>{{ $privilegio->funcion }}</td>
                    <td>
                        @if($privilegio->agregar)
                            <i class="fa fa-check text-success"></i> <!-- Icono de ok en verde -->
                        @else
                            <i class="fa fa-times text-danger"></i> <!-- Icono de cruz en rojo -->
                        @endif
                    </td>
                    <td>
                        @if($privilegio->borrar)
                            <i class="fa fa-check text-success"></i> <!-- Icono de ok en verde -->
                        @else
                            <i class="fa fa-times text-danger"></i> <!-- Icono de cruz en rojo -->
                        @endif
                    </td>
                    <td>
                        @if($privilegio->modificar)
                            <i class="fa fa-check text-success"></i> <!-- Icono de ok en verde -->
                        @else
                            <i class="fa fa-times text-danger"></i> <!-- Icono de cruz en rojo -->
                        @endif
                    </td>
                    <td>
                        @if($privilegio->leer)
                            <i class="fa fa-check text-success"></i> <!-- Icono de ok en verde -->
                        @else
                            <i class="fa fa-times text-danger"></i> <!-- Icono de cruz en rojo -->
                        @endif
                    </td>
                    <td>{{ $privilegio->estado == 'a' ? 'Activo' : 'Inactivo' }} </td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal{{ $privilegio->id }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $privilegio->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @include('Privilegio.modificar', ['privilegio' => $privilegio])
                @include('Privilegio.eliminar', ['privilegio' => $privilegio]) 
                @endforeach
            </tbody>
        </table>
    </div>    
</div>
@include('Privilegio.agregar')   
@endsection