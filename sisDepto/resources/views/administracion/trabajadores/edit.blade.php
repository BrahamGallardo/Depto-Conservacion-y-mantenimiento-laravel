@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Editar trabajador: {{$trabajadores->nombre_trabajador}}</h3>
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
{!!Form::model($trabajadores,['method'=>'PATCH','route'=>['administracion.trabajadores.update',$trabajadores->idtrabajador]])!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" required value="{{$trabajadores->nombre_trabajador}}" name="nombre" class="form-control" placeholder="Nombre">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" value="{{$trabajadores->email}}" name="email" class="form-control" placeholder="Email">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" value="{{$trabajadores->telefono}}" name="telefono" class="form-control" placeholder="Teléfono">
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Tipo de trabajador</label>
			<select required name="idtipoTrabajador" class="form-control">
				@foreach($tipos as $tip)
				@if($tip->idtipo_trabajador==$trabajadores->idtipo_trabajador)
				<option value="{{$tip->idtipo_trabajador}}" selected>{{$tip->tipo_trabajador}}</option>
				@else
				<option value="{{$tip->idtipo_trabajador}}">{{$tip->tipo_trabajador}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Rol del trabajador</label>
			<select required name="rol" class="form-control">
				@foreach($roles as $rol)
				@if($rol->idrol==$trabajadores->idrol)
				<option value="{{$rol->idrol}}" selected>{{$rol->nombre_rol}}</option>
				else
				<option value="{{$rol->idrol}}">{{$rol->nombre_rol}}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<label>Horario del trabajador</label>
			<select required name="horario" class="form-control">
				@foreach($horarios as $hor)
				@if($hor->idhorario==$trabajadores->idhorario)
				<option value="{{$hor->idhorario}}" selected>{{$hor->hora_entrada}} - {{$hor->hora_salida}}</option>
				@else
				<option value="{{$hor->idhorario}}">{{$hor->hora_entrada}} - {{$hor->hora_salida}}</option>
				@endif
				@endforeach
			</select>
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