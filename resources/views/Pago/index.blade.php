@extends('dashboard')

@section('title', 'G. Pago')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR PAGO</b> 
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
        <table class="table table-hover" id="pagos">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th># VENTA</th>
                    <th>METODO PAGO</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->id }}</td>
                    <td>{{ $pago->cliente }}</td>
                    <td>{{ $pago->id_venta }}</td>
                    <td>{{ $pago->metodopago }}</td>
                    <td>{{ $pago->estado == 'a' ? 'Activo' : 'Inactivo' }} </td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal{{ $pago->id }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $pago->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @include('Pago.modificar', ['pago' => $pago])
                @include('Pago.eliminar', ['pago' => $pago])               
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('Pago.agregar')  
@endsection