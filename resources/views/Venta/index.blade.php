@extends('dashboard')

@section('title', 'G. Venta')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR VENTA   </b> 
                </h1>
                <div class="float-right d-sm-block"> 
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="#" data-toggle="modal" data-target="#agregarHorarioModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
                    </div> 
                </div>
</div>
    
<table class="table table-hover" id="usuarios">
    <thead class="table-light">
    <tr>
        <th>ID</th>
        <th>FECHA</th>
        <th>CLIENTE</th>
        <th>DESCUENTO %</th>
        <th>SERVICIO</th>
        <th>TOTAL</th>
        <th>ESTADO</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="table-group-divider">
    @foreach($ventas as $venta)
    <?php $collapseId = "menu-{$venta->id}-details"; ?>
    <tr data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
        <td>{{ $venta->id }}</td>
        <td>{{ $venta->fecha }}</td>
        <td>{{ $venta->cliente->nombre }}</td>
        <td>{{ $venta->promocion->descuento }}</td>
        <td>{{ $venta->servicio->descripcion }}</td>
        <td>{{ $venta->total }}</td>
        <td>{{ $venta->estado == 'a' ? 'Activo' : 'Inactivo' }} </td>
        <td class="text-end"><i class="fa fa-chevron-down"></i></td>
    </tr>
    <tr class="accordion-collapse collapse" id="{{ $collapseId }}">
        <td colspan="8">
            <div class="accordion-body">
            <ul>
                @foreach($venta->detalleVentas as $detalle)
                    @if($detalle->producto)
                    <li>
                        {{ $detalle->producto->nombre }} - {{ $detalle->producto->descripcion }} - ${{ $detalle->producto->precio }}
                    </li>
                    @endif
                @endforeach
                </ul>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
             
@endsection