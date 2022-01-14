@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Seguimiento de solicitud {{$detalle->solicitud}}</h3>
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
			<label for="nombre">Asunto</label>
			<textarea class="form-control" readonly name="asunto" rows="4">{{$detalle->asunto}}</textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Compromiso</label>
			<textarea class="form-control" readonly name="compromiso" rows="4">{{$detalle->compromiso}}</textarea>
		</div>
	</div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" value="{{$detalle->estado}}" name="estado" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="egreso">Materiales</label>
            <input type="text" value="{{$detalle->egreso}}" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="Fecha">Fecha</label>
            <input type="date" value="{{$detalle->fecha}}" name="fecha" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="form-group">
            <label for="trabajador">Trabajador</label>
            <input type="text" value="{{$detalle->nombre_trabajador}}" name="trabajador" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="total">Total</label>
            <input type="num" value="{{$detalle->total}}" name="total" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="folio">Folio</label>
            <input type="text" value="{{$detalle->folio}}" name="folio" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="Documento">Documento</label>
            <input type="text" value="{{$detalle->documento}}" name="documento" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Actualización</label>
			<textarea class="form-control" readonly name="actualizacion" rows="4" placeholder="Sin actualizaciones">{{$detalle->actualizacion}}</textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Comentarios</label>
			<textarea class="form-control" readonly name="comentarios" rows="4" placeholder="Sin comentarios">{{$detalle->comentarios}}</textarea>
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