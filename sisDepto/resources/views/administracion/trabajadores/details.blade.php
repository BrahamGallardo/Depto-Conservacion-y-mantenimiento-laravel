@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalles trabajador: {{$trabajadores->nombre_trabajador}}</h3>
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
			<label for="nombre">Nombre</label>
			<p>{{$trabajadores->nombre_trabajador}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Email</label>
			<p>{{$trabajadores->email}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<p>{{$trabajadores->telefono}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Tipo de trabajador</label>
			<p>{{$trabajadores->tipo_trabajador}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Rol del trabajador</label>
			<p>{{$trabajadores->nombre_rol}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Horario del trabajador</label>
			<p>{{$trabajadores->hora_entrada}} - {{$trabajadores->hora_salida}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<a href="{{url('administracion/trabajadores')}}"><button class="btn btn-primary">Aceptar</button></a>
			@if(Auth::user()->rol != 2 && Auth::user()->rol != 4)
			<a href="{{URL::action('TrabajadorController@edit',$trabajadores->idtrabajador)}}"><button class="btn btn-warning">Editar</button></a>
			@endif
		</div>
	</div>
</div>

@endsection