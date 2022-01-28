@extends('layouts.admin')
@section('contenido')

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Tablero
            <a href="/buscar"><button class="btn btn-success">Busqueda especial</button></a>
        </h3>
    </div>
</div>
<input type="hidden" value="{{$atendidos->atendidos}}" id="aten">
<input type="hidden" value="{{$proceso->proceso}}" id="proceso">
<input type="hidden" value="{{$cumplido->cumplidos}}" id="cumplido">
<input type="hidden" value="{{$detalleat->atendidos}}" id="daten">
<input type="hidden" value="{{$detallepro->proceso}}" id="dproceso">
<input type="hidden" value="{{$detallecum->cumplidos}}" id="dcumplido">

<div class="row">
    <div class="col-xl-6 col-lg-6">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myPieChart" height="280"></canvas>
                </div>
                <hr>
                Relación de solicitudes por estado
                <a href="administracion/solicitudes"><code>ver solicitudes</code></a>
            </div>
        </div>
        <br>
        <br>
    </div>

    <div class="col-xl-6 col-lg-6">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart" width="500" height="280"></canvas>
                </div>
                <hr>
                Numero de seguimientos por estado
                <a href="administracion/seguimiento"><code>ver seguimientos</code></a>
            </div>
        </div>
    </div>

</div>
@push ('scripts')
<!-- Startboostrap-->
<!-- Page level plugins -->
<script src="{{asset('js/Chart.min.js')}}"></script>
<!-- Page level custom scripts -->
<script>
    var ctx = document.getElementById("myPieChart");
    aten = $("#aten").val();
    proceso = $("#proceso").val();
    cumplido = $("#cumplido").val();
    arreglo = [aten, proceso, cumplido];
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Atendidos", "En proceso", "Cumplido"],
            datasets: [{
                data: arreglo,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            }
        },
    });
</script>
<script>
    var ctx = document.getElementById("myBarChart");
    aten = $("#daten").val();
    proceso = $("#dproceso").val();
    cumplido = $("#dcumplido").val();
    arreglo = [aten, proceso, cumplido];
    var myPieChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Atendidos", "En proceso", "Cumplido"],
            datasets: [{
                data: arreglo,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 1,
                        padding: 10,
                    },

                }],
            },
            legend: {
                display: true
            },

        }
    });
</script>
@endpush
@endsection