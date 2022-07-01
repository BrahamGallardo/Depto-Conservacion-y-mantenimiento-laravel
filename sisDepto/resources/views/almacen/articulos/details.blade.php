@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalles Articulo: {{$articulos->codigo}}</h3>
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
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label for="codigo">Codigo</label>
			<p>{{$articulos->codigo}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<p>{{$articulos->nombre_articulo}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Tipo de articulo</label>
			<p>{{$articulos->tipo_articulo}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<p>{{$articulos->cantidad}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Tipo de unidad</label>
			<p>{{$articulos->nombre_unidad}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="ubicacion">Ubicación</label>
			<p>{{$articulos->ubicacion}}</p>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
		<label for="observaciones">Observaciones</label>
			<p>{{$articulos->observaciones}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<a href="{{url('almacen/articulos')}}"><button class="btn btn-primary">Aceptar</button></a>
			@if(Auth::user()->rol != 1 && Auth::user()->rol != 3 && Auth::user()->rol != 5)
			<a href="{{URL::action('ArticuloController@edit',$articulos->codigo)}}"><button class="btn btn-warning">Editar</button></a>
			@endif
		</div>
	</div>
</div>

@endsection