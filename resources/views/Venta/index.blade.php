@extends('dashboard')

@section('title', 'G. Venta')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR VENTA</b> 
                </h1>
                @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Venta']) && $v['estado'] === 'a' && $v['agregar'] ;}, ARRAY_FILTER_USE_BOTH))
                <div class="float-right d-sm-block"> 
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="" data-toggle="modal" data-target="#agregarModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
                    </div> 
                </div>
                @endif
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
        <table class="table table-hover" id="ventas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Empleado</th>
                    <th>Promoción</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->cliente->nombre }}</td> 
                        <td>{{ $venta->empleado->nombre }}</td> 
                        <td>{{ $venta->promocion->descuento ?? 0 }}</td> 
                        <td>{{ $venta->servicio->descripcion }}</td> 
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->total }}</td>
                        <td>{{ $venta->estado }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detalleVentaModal" data-venta-id="{{ $venta->id }}">
                                Ver Detalles
                            </button>
                            &nbsp;
                            @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Venta'])&& $v['estado'] === 'a' && $v['borrar'];}, ARRAY_FILTER_USE_BOTH))
                                <a href="#" data-toggle="modal" data-target="#deleteModal{{ $venta->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                            @endif
                        </td>
                    </tr>
                    @include('Venta.eliminar', ['venta' => $venta])
                @endforeach
            </tbody>
        </table>

        

        <div class="modal fade" id="detalleVentaModal" tabindex="-1" aria-labelledby="detalleVentaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detalleVentaModalLabel">Detalles de Venta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="detalleVentaModalBody">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var detalleVentaModal = document.getElementById('detalleVentaModal');
        detalleVentaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ventaId = button.getAttribute('data-venta-id');
            var detallesUrl = "{{ route('ventas.detalles', ':id') }}".replace(':id', ventaId);

            // Realiza una petición AJAX para obtener los detalles de la venta
            fetch(detallesUrl) // Ajusta la ruta según tu configuración
                .then(response => response.text())
                .then(html => {
                    document.getElementById('detalleVentaModalBody').innerHTML = html;
                });
        });

    </script>
     @include('Venta.agregar')
@endsection



