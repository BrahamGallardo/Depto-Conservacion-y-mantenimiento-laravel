@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalles solicitud: {{$solicitud->idsolicitud}}</h3>
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
			<textarea class="form-control" readonly name="asunto" rows="8" placeholder="Sin asunto">{{$solicitud->asunto}}</textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Compromiso</label>
			<textarea class="form-control" readonly name="compromiso" rows="8" placeholder="Sin compromiso">{{$solicitud->compromiso}}</textarea>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="email">Unidad</label>
			<input type="text" value="{{$solicitud->unidad}}" name="unidad" class="form-control" readonly placeholder="Sin unidad">
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="telefono">Jurisd. Sanit.</label>
			<input type="text" value="{{$solicitud->jurisd_sanit}}" name="jurisd_sanit" class="form-control" readonly placeholder="Sin jurisdicción sanitaria">
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="telefono">Fecha a realizar</label>
			<input type="date" value="{{$solicitud->fecha_limite}}" name="fecha_limite" class="form-control" readonly>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
			<label for="telefono">Estado</label>
			<input type="text" value="{{$solicitud->estado}}" name="estado" class="form-control" readonly placeholder="Estado">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Actualización</label>
			<textarea class="form-control" readonly name="actualizacion" rows="4" placeholder="Sin actualizaciones">{{$solicitud->actualizacion}}</textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Comentarios</label>
			<textarea class="form-control" readonly name="comentarios" rows="4" placeholder="Sin comentarios">{{$solicitud->comentarios}}</textarea>
		</div>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<a href="{{url('administracion/solicitudes')}}"><button class="btn btn-primary">Aceptar</button></a>
			<a href="{{URL::action('SolicitudController@edit',$solicitud->idsolicitud)}}"><button class="btn btn-warning">Editar</button></a>
		</div>
	</div>
</div>

@endsection