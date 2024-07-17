@extends('dashboard')

@section('title', 'Usuario')

@section('content')

<div class="card-header">
    <h3 class="card-title">
    <i class="fas fa-user mr-1"></i>
    GESTIONAR USUARIO    
    </h3>
    <div class="float-right d-sm-block"> 
        
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
    
    <div class="card table-responsive">
        <div class="card-body">
            <table class="table table-hover" id="usuarios">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->user }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td>{{ $usuario->rol }}</td>
                        <td>{{ $usuario->empresa }}</td>
                        <td>{{ $usuario->estado == 'a' ? 'Activo' : 'Inactivo' }} </td>
                        
                    </tr>
                    @include('Usuario.modificar', ['usuario' => $usuario])
                    @include('Usuario.eliminar', ['usuario' => $usuario]) 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('Usuario.agregar')
@endsection