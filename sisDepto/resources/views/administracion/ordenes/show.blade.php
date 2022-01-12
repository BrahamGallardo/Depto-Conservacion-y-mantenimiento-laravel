@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalle de orden: {{$ordenes->num_orden}}</h3>
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
<form action="/downloadorden" method="get">
	<div class="row">
		<input type="hidden" value="{{$ordenes->num_orden}}" name="num_orden">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="Fecha">Fecha</label>
				<input type="text" value="{{$ordenes->fecha}}" name="fecha" class="form-control" readonly>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="Unidad">Clave de la unidad</label>
				<input type="text" value="{{$ordenes->num_oficina}}" name="unidad" class="form-control" readonly placeholder="Sin unidad">
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="partida">Partida</label>
				<input type="text" value="{{$ordenes->partida}}" name="partida" class="form-control" readonly placeholder="Sin partida">
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="nombre">Unidad</label>
				<input type="text" value="{{$ordenes->nombre_corto}}" name="nombre_unidad" class="form-control" readonly placeholder="Sin nombre corto">
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<label for="programa">Programa</label>
				<input type="text" value="{{$ordenes->programa}}" name="programa" class="form-control" readonly placeholder="Sin programa">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="concepto">Concepto</label>
				<textarea class="form-control" readonly name="concepto" rows="4" placeholder="Sin concepto">{{$ordenes->concepto}}</textarea>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<textarea class="form-control" readonly name="descripcion" rows="4" placeholder="Sin descripcion">{{$ordenes->descripcion}}</textarea>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Proveedor</label>
				<input type="text" value="{{$ordenes->proveedor}}" name="proveedor" class="form-control" readonly placeholder="Sin proveedor">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="domicilio">Domicilio</label>
				<input type="text" value="{{$ordenes->domicilio}}" name="domicilio" class="form-control" readonly placeholder="Sin domicilio">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<a href="{{URL::action('OrdenesController@edit',$ordenes->num_orden)}}"><button type="button" class="btn btn-primary">Editar</button></a>
				<button class="btn btn-link" id="btnsolicitar" type="submit">Descargar</button>
			</div>
		</div>
	</div>
</form>
@endsection