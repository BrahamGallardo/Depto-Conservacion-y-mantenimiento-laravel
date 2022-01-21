@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Nuevo articulo</h3>
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
<!-- <form action="/download" method="GET"> -->
{!!Form::open(array('url'=>'almacen/articulos','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">

	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="codigo">Codigo</label>
			<input type="text" required value="" readonly name="codigo" id="pcodigo" class="form-control" placeholder="Codigo">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" required value="{{old('nombre')}}" name="nombre" class="form-control" placeholder="Nombre">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label>Tipo de articulo</label>
			<select name="idtipoArticulo" id="ptipo_articulo" class="form-control">
				@foreach($tipos as $tip)
				<option value="{{$tip->idtipo_articulo}}">{{$tip->tipo_articulo}}</option>
				@endforeach
			</select>
			<input type="hidden" value="" name="number" id="number">
			@foreach($electricos as $e)
			<input type="hidden" value="{{$e->num}}" name="electricos" id="electricos">
			@endforeach
			@foreach($plomeria as $p)
			<input type="hidden" value="{{$p->num}}" name="plomeria" id="plomeria">
			@endforeach
			@foreach($varios as $v)
			<input type="hidden" value="{{$v->num}}" name="varios" id="varios">
			@endforeach
			@foreach($dentales as $d)
			<input type="hidden" value="{{$d->num}}" name="dentales" id="dentales">
			@endforeach
			@foreach($limpieza as $l)
			<input type="hidden" value="{{$l->num}}" name="limpieza" id="limpieza">
			@endforeach
			@foreach($papeleria as $pa)
			<input type="hidden" value="{{$pa->num}}" name="papeleria" id="papeleria">
			@endforeach
			@foreach($refris as $r)
			<input type="hidden" value="{{$r->num}}" name="refris" id="refris">
			@endforeach
			@foreach($herra as $h)
			<input type="hidden" value="{{$h->num}}" name="herra" id="herra">
			@endforeach
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<input type="number" name="cantidad" id="pcantidad" class="form-control" placeholder="Cantidad" min="1" step="1">
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label>Tipo de unidad</label>
			<select name="idtipoUnidad" class="form-control">
				@foreach($unidad as $uni)
				<option value="{{$uni->idunidad}}">{{$uni->unidad}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
			<label for="ubicacion">Ubicación</label>
			<input type="text" value="" name="ubicacion" class="form-control" placeholder="Ubicación">
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<!--<input type="text" value="" name="observaciones" class="form-control" placeholder="Observaciones"> -->
			<textarea class="form-control" value="" name="observaciones" rows="6" placeholder="Observaciones"></textarea>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
			<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
			<button class="btn btn-primary" type="submit">Guardar</button>
			<a href="#"><button class="btn btn-danger" type="reset">Borrar cambios</button></a>
		</div>
	</div>

</div>
{!!Form::close()!!}
@push ('scripts')
<script>
	var aux = 0;
	$("#ptipo_articulo").change(mostrarValores);

	function mostrarValores() {
		var tipo = $("#ptipo_articulo").val();
		if (tipo == 1) {
			aux = document.getElementById('electricos').value;
			aux++;
			$("#pcodigo").val("ME" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 2) {
			aux = document.getElementById('plomeria').value;
			aux++;
			$("#pcodigo").val("P" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 3) {
			aux = document.getElementById('varios').value;
			aux++;
			$("#pcodigo").val("V" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 4) {
			aux = document.getElementById('dentales').value;
			aux++;
			$("#pcodigo").val("D" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 5) {
			aux = document.getElementById('limpieza').value;
			aux++;
			$("#pcodigo").val("ML" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 6) {
			aux = document.getElementById('papeleria').value;
			aux++;
			$("#pcodigo").val("MP" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 7) {
			aux = document.getElementById('refris').value;
			aux++;
			$("#pcodigo").val("R" + aux);
			document.getElementById("number").value = aux;
		}
		if (tipo == 8) {
			aux = document.getElementById('herra').value;
			aux++;
			$("#pcodigo").val("H" + aux);
			document.getElementById("number").value = aux;
		}
	}
</script>
@endpush
@endsection