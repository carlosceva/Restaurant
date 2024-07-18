@extends('dashboard')

@section('title', 'Dashboard')

@section('content')
@if(auth()->user()->rol->id === 1)
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $cantidadVentas }}</h3>

                <p>Nro Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $cantidadVendida}}<sup style="font-size: 20px">Bs</sup></h3>

                <p>Ingresos por ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $cantidadClientes}}</h3>

                <p>Clientes registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$cantidadVisitas}}</h3>

                <p>Visitas a la pagina</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card bg-gradient">
              <div class="card-body d-flex flex-column align-items-center" >
                    <h3 class="">VENTAS POR MES</h3>
                    <canvas id="graficoTorta"></canvas>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              
              <div class="card-body d-flex flex-column align-items-center" >
                    <h3 class="">PRODUCTOS TOP</h3>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Unidades</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach ($productosTop as $producto)
                  <tr>
                    <td>{{ $producto->producto }}</td>
                    <td>{{ $producto->total_vendido }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
          </div>
            <!--/.direct-chat -->

            
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
            
            <!-- solid sales graph -->
            <div class="card bg-gradient">
              <div class="card-body d-flex flex-column align-items-center" >
                    <h3 class="">VENTAS POR DIA</h3>
                    <canvas id="graficoTorta2"></canvas>
              </div>
            </div>
            <!-- /.card -->
            
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('graficoTorta').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: [' {{ $mes[0] }}', '{{ $mes[1] }}'],
          datasets: [{
            data: [{{ $cantidad[0] }}, {{ $cantidad[1] }}],
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
            type: 'line', // Puedes cambiar el tipo de gráfico si lo prefieres
            data: {
                labels: @json($dias),
                datasets: [{
                    label: 'Ventas por Día',
                    data: @json($cantidadDias),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color del fondo
                    borderColor: 'rgba(75, 192, 192, 1)', // Color del borde
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Muestra números enteros
                        }
                    }
                }
            }
        });
    });
</script>
@endif
@endsection