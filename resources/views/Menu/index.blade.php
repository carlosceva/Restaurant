@extends('dashboard')

@section('title', 'G. Menu')

@section('content')
    <div class="card-header">
        <h1 class="card-title">
        <i class="fas fa-clock mr-1"></i>
        <b>GESTIONAR MENU   </b> 
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
          <th>DESCRIPCION</th>
          <th>ESTADO</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
      @foreach($menus as $menu)
      <?php $collapseId = "menu-{$menu->id}-details"; ?>
        <tr data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
          <td>{{ $menu->id }}</td>
          <td>{{ $menu->descripcion }}</td>
          <td>{{ $menu->estado == 'a' ? 'Activo' : 'Inactivo' }} </td>
          <td class="text-end"><i class="fa fa-chevron-down"></i></td>
        </tr>
        <tr class="accordion-collapse collapse" id="{{ $collapseId }}">
          <td colspan="4">
              <div class="accordion-body">
                <ul>
                    @foreach($menu->detalleMenus as $detalle)
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