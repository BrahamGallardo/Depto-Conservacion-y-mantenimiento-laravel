@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalles usuario {{$user->name}}</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Nombre</label>
			<p>{{$user->name}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Trabajador al que pertenece la cuenta</label>
			<a href="{{URL::action('TrabajadorController@show',$user->idtrabajador)}}"><p>{{$user->nombre_trabajador}}</p></a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Email</label>
			<p>{{$user->email}}</p>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<a href="{{url('seguridad/usuario')}}"><button class="btn btn-primary">Aceptar</button></a>
			<a href="{{URL::action('UsuarioController@edit',$user->id)}}"><button class="btn btn-warning">Editar</button></a>
		</div>
	</div>
</div>

@endsection