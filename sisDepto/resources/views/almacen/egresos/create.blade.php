@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Salida de articulos</h3>
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
{!!Form::open(array('url'=>'almacen/egresos','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="panel panel-primary" style="border-color: #A9D0F5">
		<div class="panel-body">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Artículo</label>
					<select name="pidarticulo" id="pidarticulo" class="form-control selectpicker" data-live-search="true">
						<option value="">Elija un artículo</option>
						@foreach($articulos as $articulo)
						<option value="{{$articulo->codigo}}_{{$articulo->unidad}}_{{$articulo->cantidad}}">{{$articulo->articulo}}</option>
						@endforeach
					</select>

				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label for="cantidad">Cantidad</label>
					<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad" min="1" step="1">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="form-group">
					<label>Unidad</label>
					<input type="text" readonly name="punidad" id="punidad" class="form-control" placeholder="Unidad">
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Trabajador que realizó la salida</label>
					<select required name="trabajador" id="pidtrabajador" class="form-control selectpicker" data-live-search="true">
						<option value="">Elija una opción</option>
						@foreach($trabajadores as $tra)
						<option value="{{$tra->idtrabajador}}">{{$tra->trabajador}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label>Justificación</label>
					<input type="text" name="prazon" id="prazon" class="form-control" placeholder="Justificación de la salida de articulos">
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="imagen">Documento</label>
					<input id="imgInp" type="file" name="parchivo" class="form-control">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label>Comentarios</label>
					<textarea class="form-control" name="comentarios" rows="4" placeholder="Comentarios"></textarea>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					<button class="btn btn-primary" type="button" id="bt_add">Agregar</button>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover" name="tabla_art">
					<thead style="background-color: #A9D0F5">
						<th>Opciones</th>
						<th>Artículo</th>
						<th>Cantidad</th>
						<th>Unidad</th>
					</thead>

					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
		<div class="form-group">
			<input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
			<button class="btn btn-primary" id="btnsolicitar" type="submit">Guardar</button>
			<a href="{{url('almacen/egresos')}}"> <button class="btn btn-danger" type="button">Cancelar</button> </a>
		</div>
	</div>
</div>
{!!Form::close()!!}

@push ('scripts')
<script>
	var cont = 0;
	$(document).ready(function() {
		$('#bt_add').click(function() {
			agregar();
		});
	});

	$("#guardar").hide();

	$("#pidarticulo").change(mostrarValores);

	function mostrarValores() {
		datosArticulo = document.getElementById('pidarticulo').value.split('_');
		$("#punidad").val(datosArticulo[1]);
	}

	function agregar() {

		articulo = $("#pidarticulo option:selected").text();
		cantidad = $("#pcantidad").val();
		unidad = $("#punidad").val();
		datosArticulo1 = document.getElementById('pidarticulo').value.split('_');
		codigo = datosArticulo1[0];
		cantidadActual = datosArticulo1[2];
		cantidadposterior = cantidadActual - cantidad;

		if (codigo != "" && cantidad != "" && cantidad > 0)
			if (cantidadposterior >= 0) {
				var fila = '<tr class="selected" id="fila' + cont + '" name="fila' + cont + '"> <td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">x</button></td>  <td><input type="hidden" name="codigo[]" value="' + codigo + '"> ' + articulo + '</td>  <td><input type="hidden" name="cantidad[]" value="' + cantidad + '">' + cantidad + '</td> <td><input type="hidden" name="unidad[]" value="' + unidad + '">' + unidad + 's</td>   </tr>';
				cont++;
				limpiar();
				evaluar();
				$('#detalles').append(fila);
			} else {
				alert("No puede realizar esta salida ya que la cantidad a sacar es mayor al stock actual del articulo");
			}
		else {
			alert("Error al ingresar datos, por favor revise la cantidad a sacar");
		}
	}

	function limpiar() {
		$("#pcantidad").val("");
		$("#punidad").val("");
	}

	function evaluar() {
		if (cont > 0) {
			$("#guardar").show();
		}
		if (cont <= 0) {
			$("#guardar").hide();
		}
	}

	function eliminar(index) {
		$("#fila" + index).remove();
		//cont--;
		evaluar();
	}
</script>
@endpush
@endsection