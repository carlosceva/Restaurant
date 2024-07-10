@extends('dashboard')

@section('content')

<div class="card-header">
  <h1 class="card-title">
  <i class="fas fa-file mr-1"></i>
  <b>REPORTES</b> 
  </h1>
  <div class="float-right d-sm-block"> 
      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
          
      </div> 
  </div>
</div>
<br>
<div class="container">
    <div class="row mb-5">
      <div class="card col-md-6">
        <h2 class="mb-4">Porcentaje de Aprobados y Reprobados</h2>
        <canvas id="graficoTorta"></canvas>
      </div>
    
      <div class="card col-md-6">
        <h2 class="mb-4">Cantidad de Alumnos por Género</h2>
        <canvas id="graficoTorta2"></canvas>
      </div>
    
      <div class="card col-md-6">
        <h2 class="mb-4">Alumnos Inscritos por Carrera</h2>
        <canvas id="graficoBarras"></canvas>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/chart.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('graficoTorta').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Aprobados {{ $porcentajeAprobados }}%', 'Reprobados {{ $porcentajeReprobados }}%'],
          datasets: [{
            data: [{{ $porcentajeAprobados }}, {{ $porcentajeReprobados }}],
            backgroundColor: [
              'rgba(75, 192, 192, 0.5)', // Aprobados (Color cyan con opacidad)
              'rgba(255, 99, 132, 0.5)', // Reprobados (Color rojo con opacidad)
            ],
            borderWidth: 1,
          }]
        },
      });
    });
  </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('graficoTorta2').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Masculinos', 'Femeninos'],
          datasets: [{
            data: [{{ $cantidadMasculinos }}, {{ $cantidadFemeninos }}],
            backgroundColor: [
              'rgba(75, 192, 192, 0.5)', // Masculinos (Color cyan con opacidad)
              'rgba(255, 99, 132, 0.5)', // Femeninos (Color rojo con opacidad)
            ],
            borderWidth: 1,
          }]
        },
      });
    });
  </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('graficoBarras').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [@foreach($carreras as $carrera) '{{ $carrera->nombre }}', @endforeach],
          datasets: [{
            label: 'Cantidad de Alumnos Inscritos',
            data: [@foreach($carreras as $carrera) {{ $carrera->alumnos_inscritos }}, @endforeach],
            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color cyan con opacidad
            borderWidth: 1,
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>
@endsection