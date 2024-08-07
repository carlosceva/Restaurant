@extends('dashboard')

@section('title', 'G. Rol')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR ROL   </b> 
                </h1>
                <div class="float-right d-sm-block"> 
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="#" data-toggle="modal" data-target="#agregarModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
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
            <table class="table table-hover" id="roles">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($roles as $rol)
                    <tr>
                        <td>{{ $rol->id }}</td>
                        <td>{{ $rol->nombre }}</td>
                        <td>
                            <?php if ($rol->estado === 'a'): ?>
                                Activo
                            <?php elseif ($rol->estado === 'i'): ?>
                                Inactivo
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editModal{{ $rol->id }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            &nbsp;
                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $rol->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @include('Rol.modificar', ['rol' => $rol])
                    @include('Rol.eliminar', ['rol' => $rol])                
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        @include('Rol.agregar')             
@endsection