@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Fondo revolvente
            @if(Auth::user()->rol != 2 && Auth::user()->rol != 4)
            <a href="{{URL('administración/gastos')}}"><button type="button" class="btn btn-success">Nuevo</button></a>
            @endif
        </h3>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <h4>Total:</h4>
                <h4>Gastado:</h4>
                <h4>Disponible:</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <h4>$ {{$recurso->total}}</h4>
                <input type="hidden" value="{{$recurso->usado}}" id="usado">
                <h4>$ {{$recurso->usado}}</h4>
                <input type="hidden" value="{{$recurso->disponible}}" id="disponible">
                <h4>$ {{$recurso->disponible}}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="card shadow mb-2">
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myPieChart" height="280"></canvas>
                </div>
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
    usado = $("#usado").val();
    disponible = $("#disponible").val();
    arreglo = [usado, disponible];
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Gastado", "Disponible"],
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
@endpush
@endsection