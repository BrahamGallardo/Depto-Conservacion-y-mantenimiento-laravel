@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Editar seguimiento: {{$detalle->iddetalle_solicitud}}</h3>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
{!!Form::model($detalle,['method'=>'PATCH','route'=>['administracion.seguimiento.update',$detalle->iddetalle_solicitud]])!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="solicitud">Solicitud</label>
            <select name="solicitud" class="form-control selectpicker" data-live-search="true">
                @foreach($solicitudes as $sol)
                @if($sol->idsolicitud == $detalle->solicitud)
                <option value="{{$detalle->solicitud}}" selected>{{$detalle->solicitud}}</option>
                @else
                <option value="{{$sol->idsolicitud}}">{{$sol->idsolicitud}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            <label for="egreso">Con la salida de materiales</label>
            <select name="egreso" class="form-control selectpicker" data-live-search="true">
                @foreach($egresos as $e)
                @if($e->idegreso == $detalle->egreso)
                <option value="{{$detalle->egreso}}" selected>{{$e->egreso}}</option>
                @else
                <option value="{{$e->idegreso}}">{{$e->egreso}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            <label for="trabajador">Trabajador</label>
            <select name="trabajador" class="form-control selectpicker" data-live-search="true">
                @foreach($trabajadores as $tra)
                @if($detalle->trabajador == $tra->idtrabajador)
                <option value="{{$detalle->trabajador}}">{{$tra->trabajador}}</option>
                @else
                <option value="{{$tra->idtrabajador}}">{{$tra->trabajador}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="Fecha">Fecha</label>
            <input type="date" value="{{$detalle->fecha}}" name="fecha" class="form-control" placeholder="Fecha">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="total">Total</label>
            <input type="num" value="{{$detalle->total}}" name="total" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="folio">Folio</label>
            <input type="text" value="{{$detalle->folio}}" name="folio" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="Documento">Documento</label>
            <input type="text" value="{{$detalle->documento}}" name="documento" class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary">Aceptar</button>
            <button class="btn btn-danger" type="reset">Borrar cambios</button>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection