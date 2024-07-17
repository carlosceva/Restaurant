@extends('dashboard')

@section('title', 'G. Pago')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR PAGO</b> 
                </h1>
                @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Pago']) && $v['estado'] === 'a' && $v['agregar'] ;}, ARRAY_FILTER_USE_BOTH))
                <div class="float-right d-sm-block"> 
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="#" data-toggle="modal" data-target="#agregarModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
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
        <table class="table table-hover" id="pagos">
            <thead class="table-light">
                <tr>
                    <th>CLIENTE</th>
                    <th>TOTAL</th>
                    <th>METODO PAGO</th>
                    <th>FECHA</th>
                    @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Pago']) && $v['estado'] === 'a' && ($v['modificar'] || $v['borrar']);}, ARRAY_FILTER_USE_BOTH))
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    @endif
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->cliente }}</td>
                    <td>{{ $pago->total_venta }}</td>
                    <td>{{ $pago->metodopago }}</td>
                    <td>{{$pago->fecha_venta}}</td>
                    @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Pago'])&& $v['estado'] === 'a' && ($v['modificar'] || $v['borrar']);}, ARRAY_FILTER_USE_BOTH))
                    <td>{{ $pago->estado == 'a' ? 'Activo' : 'Inactivo' }} </td>
                    <td>
                        @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Pago'])&& $v['estado'] === 'a' && $v['modificar'];}, ARRAY_FILTER_USE_BOTH))
                            <a href="#" data-toggle="modal" data-target="#editModal{{ $pago->id }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        @endif
                        &nbsp;
                        @if(array_filter(auth()->user()->rol->privilegios->toArray(), function($v, $k) {return in_array($v['funcionalidad'], ['Pago'])&& $v['estado'] === 'a' && $v['borrar'];}, ARRAY_FILTER_USE_BOTH))
                            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $pago->id }}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                        @endif
                    </td>
                    @endif
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