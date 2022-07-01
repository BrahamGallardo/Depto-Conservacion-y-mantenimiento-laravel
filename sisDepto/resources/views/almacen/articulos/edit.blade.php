@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Editar Articulo: {{$articulos->codigo}}</h3>
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
{!!Form::model($articulos,['method'=>'PATCH','route'=>['almacen.articulos.update',$articulos->codigo]])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" required value="{{$articulos->nombre_articulo}}" name="nombre" class="form-control" placeholder="Nombre">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label>Tipo de articulo</label>
			<select required name="idtipoArticulo" id="ptipo_articulo" class="form-control">
				@foreach($tipos as $tip)
				@if($tip->idtipo_articulo==$articulos->tipo)
				<option value="{{$tip->idtipo_articulo}}" selected>{{$tip->tipo_articulo}}</option>
				@else
				<option value="{{$tip->idtipo_articulo}}">{{$tip->tipo_articulo}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label>Tipo de unidad</label>
			<select required name="idtipoUnidad" id="ptipo_unidad" class="form-control">
				@foreach($unidad as $uni)
				@if($uni->idunidad==$articulos->unidad)
				<option value="{{$uni->idunidad}}" selected>{{$uni->unidad}}</option>
				@else
				<option value="{{$uni->idunidad}}">{{$uni->unidad}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label for="ubicacion">Ubicación</label>
			<input type="text" value="{{$articulos->ubicacion}}" name="ubicacion" class="form-control" placeholder="Ubicación">
		</div>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
		<div class="form-group">
			<!--<input type="text" value="{{$articulos->observaciones}}" name="observaciones" class="form-control" placeholder="Observaciones">-->
			<textarea class="form-control" value="" name="observaciones" rows="6" placeholder="Observaciones">{{$articulos->observaciones}}</textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<button class="btn btn-danger" type="reset">Borrar cambios</button>
		</div>
	</div>

</div>

{!!Form::close()!!}

@endsection