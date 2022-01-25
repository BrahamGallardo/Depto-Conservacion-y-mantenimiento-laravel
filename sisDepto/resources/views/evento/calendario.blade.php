@extends('layouts.admin')
@section('contenido')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<style>
    .col {
        flex-basis: 0;
        -webkit-box-flex: 1;
        flex-grow: 1;
        max-width: 100%;
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .container {
        width: auto;
    }

    .row {
        display: -webkit-box;
        margin-right: -15px;
        margin-left: -15px;
    }

    .header-col {
        background: #E3E9E5;
        color: #536170;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    .box-day {
        border: 1px solid #E3E9E5;
        height: 150px;
    }

    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .box-dayoff {
        border: 1px solid #E3E9E5;
        height: 150px;
        background-color: #ccd1ce;
    }
</style>


<div class="container">
    <h3> Calendario - mantenimiento <a class="btn btn-info" href="{{ asset('/evento/create') }}">Programar mantenimiento</a></h3>
    <hr>
    <div class="row header-calendar">

        <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
            <a href="{{ asset('/evento/index/') }}/<?= $data['last']; ?>" style="margin:10px;">
                <i class="fas fa-chevron-circle-left" style="font-size:30px;color:#367fa9;"></i>
            </a>
            <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
            <a href="{{ asset('/evento/index/') }}/<?= $data['next']; ?>" style="margin:10px;">
                <i class="fas fa-chevron-circle-right" style="font-size:30px;color:#367fa9;"></i>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miercoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sabado</div>
        <div class="col header-col">Domingo</div>
    </div>
    <!-- inicio de semana -->
    @foreach ($data['calendar'] as $weekdata)
    <div class="row">
        <!-- ciclo de dia por semana -->
        @foreach ($weekdata['datos'] as $dayweek)

        @if ($dayweek['mes']==$mes)
        <div class="col box-day">
            {{ $dayweek['dia']  }}
            <!-- evento -->
            @foreach ($dayweek['evento'] as $event)
            <a class="badge badge-primary" href="{{ asset('/evento/details/') }}/{{ $event->id }}">
                {{ $event->titulo }}
            </a>
            @endforeach
        </div>
        @else
        <div class="col box-dayoff">
        </div>
        @endif


        @endforeach
    </div>
    @endforeach

</div> <!-- /container -->

@endsection