@extends('dashboard')

@section('title', 'Usuario')

@section('content')
<div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-user mr-1"></i>
                GESTIONAR USUARIO    
                </h3>
                <div class="float-right d-sm-block"> 
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="#" data-toggle="modal" data-target="#addUserModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
                    </div> 
                </div>
</div><!-- /.card-header -->

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

        <table class="table table-hover" id="usuarios">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Empresa</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->user }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>{{ $usuario->empresa }}</td>
                    <td>{{ $usuario->estado }}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target=""><i class="fa fa-edit" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="#" data-toggle="modal" data-target=""> <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

@endsection