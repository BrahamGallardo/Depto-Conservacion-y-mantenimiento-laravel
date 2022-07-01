@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Nuevo trabajador</h3>
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
{!!Form::open(array('url'=>'administracion/trabajadores','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" required value="{{old('nombre')}}" name="nombre" class="form-control" placeholder="Nombre">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" value="{{old('telefono')}}" name="telefono" class="form-control" placeholder="Teléfono">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Tipo de trabajador</label>
			<select required name="idtipoTrabajador" class="form-control">
				<option value="">Elija una opción</option>
				@foreach($tipos as $tip)
				<option value="{{$tip->idtipo_trabajador}}">{{$tip->tipo_trabajador}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Rol del trabajador</label>
			<select required name="rol" class="form-control">
				<option value="">Elija una opción</option>
				@foreach($roles as $rol)
				<option value="{{$rol->idrol}}">{{$rol->nombre_rol}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Horario del trabajador</label>
			<select required name="horario" class="form-control">
				<option value="">Elija un horario</option>
				@foreach($horarios as $hor)
				<option value="{{$hor->idhorario}}">{{$hor->hora_entrada}} - {{$hor->hora_salida}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<button class="btn btn-primary" type="submit">Guardar</button>
			<a href="{{url('administracion/trabajadores')}}"><button class="btn btn-danger" type="reset">Borrar cambios</button></a>
		</div>
	</div>
</div>



{!!Form::close()!!}
@endsection