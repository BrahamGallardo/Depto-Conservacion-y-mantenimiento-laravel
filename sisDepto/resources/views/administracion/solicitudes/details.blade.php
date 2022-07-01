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
			<p>{{$solicitud->asunto}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Compromiso</label>
			<p>{{$solicitud->compromiso}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Unidad</label>
			<p>{{$solicitud->unidad}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Jurisd. Sanit.</label>
			<p>{{$solicitud->jurisd_sanit}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Fecha a realizar</label>
			<p>{{$solicitud->fecha_limite}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Estado</label>
			<p>{{$solicitud->estado}}</p>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="nombre">Actualización</label>
			<p>{{$solicitud->actualizacion}}</p>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<label for="nombre">Comentarios</label>
			<p>{{$solicitud->comentarios}}</p>
		</div>
	</div>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<a href="{{url('administracion/solicitudes')}}"><button class="btn btn-primary">Aceptar</button></a>
			@if(Auth::user()->rol != 2 && Auth::user()->rol != 4)
			<a href="{{URL::action('SolicitudController@edit',$solicitud->idsolicitud)}}"><button class="btn btn-warning">Editar</button></a>
			@endif
		</div>
	</div>
</div>

@endsection