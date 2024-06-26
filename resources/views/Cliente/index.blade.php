@extends('dashboard')

@section('title', 'G. Cliente')

@section('content')
<div class="card-header">
                <h1 class="card-title">
                <i class="fas fa-clock mr-1"></i>
                <b>GESTIONAR CLIENTE   </b> 
                </h1>
                <div class="float-right d-sm-block"> 
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="#" data-toggle="modal" data-target="#agregarHorarioModal" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Agregar</a>
                    </div> 
                </div>
</div>
    

    
        
    
<div class="card table-responsive">
    <div class="card-body">
        <table class="table table-hover" id="horarios">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Turno</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    &nbsp;
                    <a href="#" data-toggle="modal" data-target=""> <i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
            </tr>
            
 

            
            </tbody>
        </table>
    </div>
</div>
             
@endsection