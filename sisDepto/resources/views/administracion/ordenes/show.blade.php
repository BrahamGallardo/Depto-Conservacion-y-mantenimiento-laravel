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
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="Fecha">Fecha</label>
				<p>{{$ordenes->fecha}}</p>
				<input type="hidden" value="{{$ordenes->fecha}}" name="fecha">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="programa">Programa</label>
				<p>{{$ordenes->programa}}</p>
				<input type="hidden" value="{{$ordenes->programa}}" name="programa">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Unidad</label>
				<p>{{$ordenes->nombre_corto}}</p>
				<input type="hidden" value="{{$ordenes->nombre_corto}}" name="nombre_unidad">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="partida">Partida</label>
				<p>{{$ordenes->partida}}</p>
				<input type="hidden" value="{{$ordenes->partida}}" name="partida">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="Unidad">Clave de la unidad</label>
				<p>{{$ordenes->num_oficina}}</p>
				<input type="hidden" value="{{$ordenes->num_oficina}}" name="unidad">
			</div>
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="proveedor">Proveedor</label>
				<p>{{$ordenes->proveedor}}</p>
				<input type="hidden" value="{{$ordenes->proveedor}}" name="proveedor">
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="domicilio">Domicilio</label>
				<p>{{$ordenes->domicilio}}</p>
				<input type="hidden" value="{{$ordenes->domicilio}}" name="domicilio">
			</div>
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="concepto">Concepto</label>
				<p>{{$ordenes->concepto}}</p>
				<input type="hidden" value="{{$ordenes->concepto}}" name="concepto">
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<p>{{$ordenes->descripcion}}</p>
				<input type="hidden" value="{{$ordenes->descripcion}}" name="descripcion">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<a href="{{url('administracion/ordenes')}}"><button type="button" class="btn btn-primary">Aceptar</button></a>
				<a href="{{URL::action('OrdenesController@edit',$ordenes->num_orden)}}"><button type="button" class="btn btn-warning">Editar</button></a>
				<button class="btn btn-link" id="btnsolicitar" type="submit">Descargar</button>
			</div>
		</div>
	</div>
</form>
@endsection