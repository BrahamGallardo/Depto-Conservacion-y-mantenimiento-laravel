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
{!!Form::model($detalle,['method'=>'PATCH','route'=>['administracion.seguimiento.update',$detalle->iddetalle_solicitud],'files'=>'true'])!!}
{{Form::token()}}
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="solicitud">Solicitud</label>
                <select required name="solicitud" class="form-control selectpicker" data-live-search="true">
                    @foreach($solicitudes as $sol)
                    @if($sol->idsolicitud == $detalle->solicitud)
                    <option value="{{$detalle->solicitud}}" selected>{{$detalle->solicitud}} - {{$sol->unidad}}</option>
                    @else
                    <option value="{{$sol->idsolicitud}}">{{$sol->idsolicitud}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                <label for="Fecha">Fecha</label>
                <input required type="date" value="{{$detalle->fecha}}" name="fecha" class="form-control" placeholder="Fecha">
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                <label for="Estado">Estado</label>
                <select name="estado" class="form-control">
                    <option value="{{$estado->estado}}">{{$estado->estado}}</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Atendido">Atendido</option>
                    <option value="Cumplido">Cumplido</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="egreso">Con la salida de materiales</label>
                <select required name="egreso" class="form-control selectpicker" data-live-search="true">
                    @foreach($egresos as $e)
                    @if($e->idegreso == $detalle->egreso)
                    <option value="{{$detalle->egreso}}" selected>{{$e->egreso}}</option>
                    @else
                    <option value="{{$e->idegreso}}">{{$e->egreso}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="trabajador">Trabajador</label>
                <select required name="trabajador" class="form-control selectpicker" data-live-search="true">
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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" value="{{$detalle->total}}" name="total" class="form-control">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4" placeholder="Descripción">{{$detalle->descripcion}}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary">Aceptar</button>
                <a href="/administracion/seguimiento"> <button class="btn btn-danger" type="button">Cancelar</button></a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" id="dunidad">
                <label for="unidad">Unidad</label>
                <p>{{$estado->unidad}}</p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" id="dasunto">
                <label for="asunto">Asunto</label>
                <p>{{$estado->asunto}}</p>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="imagen">Documento</label>
                <input id="imgInp" type="file" name="imagen" class="form-control">
                @if(($detalle->documento)!="")
                <iframe id="blah" src="{{asset('documentos/seguimientos/'.$detalle->documento)}}" height="300px" width="100%"></iframe>
                @endif
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection