@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Seguimiento</h3>
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
{!!Form::open(array('url'=>'administracion/seguimiento','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="solicitud">Solicitud</label>
            <select name="solicitud" class="form-control selectpicker" data-live-search="true">
                @foreach($solicitudes as $sol)
                <option value="{{$sol->idsolicitud}}">{{$sol->idsolicitud}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            <label for="egreso">Con la salida de materiales</label>
            <select name="egreso" class="form-control selectpicker" data-live-search="true">
                @foreach($egresos as $e)
                <option value="{{$e->idegreso}}">{{$e->egreso}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            <label for="trabajador">Trabajador</label>
            <select name="trabajador" class="form-control selectpicker" data-live-search="true">
                @foreach($trabajadores as $tra)
                <option value="{{$tra->idtrabajador}}">{{$tra->trabajador}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="Fecha">Fecha</label>
            <input type="date" value="" name="fecha" class="form-control" placeholder="Fecha">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="total">Total</label>
            <input type="num" value="" name="total" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="total">Folio</label>
            <input type="text" value="" name="folio" class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="Estado">Estado</label>
            <select name="estado" class="form-control">
                <option value="En proceso" selected>En proceso</option>
                <option value="Atendido">Atendido</option>
                <option value="Cumplido">Cumplido</option>
                <option value="No procede">No procede</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="actualizacion">Actualización</label>
            <textarea class="form-control" name="actualizacion" rows="4" placeholder="Actualizaciones"></textarea>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="comentarios">Comentarios</label>
            <textarea class="form-control" name="comentarios" rows="4" placeholder="Comentarios"></textarea>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <a href="{{url('administracion/solicitudes')}}"><button class="btn btn-primary">Aceptar</button></a>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection