@extends('dashboard')

@section('title', 'G. Promocion')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR PROMOCION   </b> 
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
        <table class="table table-hover" id="promociones">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>DESCUENTO</th>
                    <th>INICIO</th>
                    <th>FIN</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($promociones as $promocion)
                <tr>
                    <td>{{ $promocion->id }}</td>
                    <td>{{ $promocion->descuento }}</td>
                    <td>{{ $promocion-> fecha_i}}</td>
                    <td>{{ $promocion-> fecha_f}}</td>
                    <td>
                        <?php if ($promocion->estado === 'a'): ?>
                            Activo
                        <?php elseif ($promocion->estado === 'i'): ?>
                            Inactivo
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal{{ $promocion->id }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $promocion->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @include('Promocion.modificar', ['promocion' => $promocion])
                @include('Promocion.eliminar', ['promocion' => $promocion])                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        @include('Promocion.agregar')     
@endsection