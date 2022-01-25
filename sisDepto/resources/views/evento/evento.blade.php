@extends('layouts.admin')
@section('contenido')

<div class="container">
    <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalle de mantenimiento</h3>
    <hr>
    <div class="row header-calendar">

        <div class="col-md-6">

            <div class="form-group">
                <label>Titulo</label>
                {{ $event->titulo }}
            </div>
            <div class="form-group">
                <label>Descripcion del Evento</label>
                {{ $event->descripcion }}
            </div>
            <div class="form-group">
                <label>Fecha</label>
                {{ $event->fecha }}
            </div>
            <br>
            <a href="javascript:history.back()"><button class="btn btn-primary">Aceptar</button></a>
        </div>

    </div> <!-- /container -->
    @endsection