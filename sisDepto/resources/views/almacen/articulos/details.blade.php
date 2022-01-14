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
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="codigo">Codigo</label>
			<input type="text" required value="{{$articulos->codigo}}" readonly name="codigo" id="pcodigo" class="form-control" placeholder="Codigo">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" readonly value="{{$articulos->nombre_articulo}}" name="nombre" class="form-control" placeholder="Nombre">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label>Tipo de articulo</label>
			<input type="text" readonly value="{{$articulos->tipo_articulo}}" name="idtipoArticulo" class="form-control" placeholder="Tipo">
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<input type="number" readonly value="{{$articulos->cantidad}}" name="cantidad" id="pcantidad" class="form-control" placeholder="Cantidad" min="1" step="1">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label>Tipo de unidad</label>
			<input type="text" readonly value="{{$articulos->nombre_unidad}}" name="idtipoUnidad" class="form-control" placeholder="Unidad">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label for="ubicacion">Ubicación</label>
			<input type="text" readonly value="{{$articulos->ubicacion}}" name="ubicacion" class="form-control" placeholder="Ubicación">
		</div>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="form-group">
			<!--<input type="textarea" readonly value="{{$articulos->observaciones}}" name="observaciones" class="form-control" placeholder="Observaciones">-->
			<textarea class="form-control" readonly name="observaciones" rows="10" cols="12" placeholder="Sin observaciones">{{$articulos->observaciones}}</textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<a href="{{url('almacen/articulos')}}"><button class="btn btn-primary">Aceptar</button></a>
			<a href="{{URL::action('ArticuloController@edit',$articulos->codigo)}}"><button class="btn btn-warning">Editar</button></a>
		</div>
	</div>
</div>

@endsection