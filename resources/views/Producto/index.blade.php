@extends('dashboard')

@section('title', 'G. Producto')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR PRODUCTO   </b> 
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

        <table class="table table-hover" id="usuarios">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>CATEGORIA</th>
                    <th>PRECIO</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->idp }}</td>
                    <td>{{ $producto->producto }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>
                        <?php if ($producto->estado === 'a'): ?>
                            Activo
                        <?php elseif ($producto->estado === 'i'): ?>
                            Inactivo
                        <?php endif; ?>
                    </td>
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