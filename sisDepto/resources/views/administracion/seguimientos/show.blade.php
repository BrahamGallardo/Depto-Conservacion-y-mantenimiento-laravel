@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Seguimiento de solicitud <a href="{{URL::action('SolicitudController@show',$detalle->solicitud)}}"> {{$detalle->solicitud}}</a></h3>
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

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="Fecha">Fecha</label>
            <p>{{$detalle->fecha}}</p>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="estado">Estado</label>
            <p>{{$detalle->estado}}</p>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="egreso">Materiales</label>
            <p>{{$detalle->egreso}}</p>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="trabajador">Trabajador</label>
            <p>{{$detalle->nombre_trabajador}}</p>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="total">Total</label>
            <p>{{$detalle->total}}</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="Asunto">Asunto</label>
            <p>{{$detalle->asunto}}</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="Compromiso">Compromiso</label>
            <p>{{$detalle->compromiso}}</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="Actualización">Actualización</label>
            <p>{{$detalle->actualizacion}}</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="Comentarios">Comentarios</label>
            <p>{{$detalle->comentarios}}</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion">Descripción del seguimiento</label>
            <p>{{$detalle->descripcion}}</p>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="Documento">Documento</label>
            <br>
            <iframe src="{{asset('documentos/seguimientos/'.$detalle->documento)}}"  height="220px" width="150px"></iframe>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <a href="{{url('administracion/seguimiento')}}"><button class="btn btn-primary">Aceptar</button></a>
            <a href="{{URL::action('DetalleSolicitudController@edit',$detalle->iddetalle_solicitud)}}"><button class="btn btn-warning">Editar</button></a>
        </div>
    </div>
</div>

@endsection