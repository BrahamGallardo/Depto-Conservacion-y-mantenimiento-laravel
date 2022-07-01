@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Nueva orden</h3>
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
{!!Form::open(array('url'=>'administracion/ordenes','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input required type="date" value="" name="fecha" class="form-control" placeholder="Fecha">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="unidad">Oficina</label>
            <select required name="unidad" id="unidad" class="form-control selectpicker" data-live-search="true">
                <option value="">Elija una opción</option>
                @foreach($oficinas as $ofice)
                <option value="{{$ofice->num_oficina}}_{{$ofice->nombre_corto}}_{{$ofice->programa}}">{{$ofice->oficinas}}</option>
                @endforeach
            </select>
            <input type="hidden" value="" name="num_unidad" id="num_unidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="partida">Partida</label>
            <select required name="partida" class="form-control selectpicker" data-live-search="true">
                <option value="">Elija una opción</option>
                @foreach($partidas as $par)
                <option value="{{$par->num_partida}}">{{$par->partidas}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="nombre">Unidad</label>
            <input required type="text" value="" name="nombre_unidad" id="nombre_unidad" class="form-control" placeholder="Nombre unidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="programa">Programa</label>
            <input required type="text" value="" name="programa" id="programa" class="form-control" placeholder="Programa">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <select required name="proveedor" id="proveedor" class="form-control selectpicker" data-live-search="true">
                <option value="">Elija un proveedor</option>
                @foreach($proveedores as $pro)
                <option value="{{$pro->rfc}}_{{$pro->domicilio}}">{{$pro->proveedor}}</option>
                @endforeach
            </select>
            <a href="{{url('administracion/proveedores/create')}}"><button type="button" class="btn btn-link">Nuevo proveedor</button></a>
            <input type="hidden" value="" name="rfc" id="rfc">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" value="" id="domicilio" name="domicilio" class="form-control" placeholder="Domicilio">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="concepto">Concepto</label>
            <textarea class="form-control" name="concepto" rows="4" placeholder="Concepto"></textarea>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" name="descripcion" rows="4" placeholder="Descripcion"></textarea>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
            <button class="btn btn-primary" id="btnsolicitar" type="submit">Guardar</button>
            <a href="{{url('administracion/ordenes')}}"> <button class="btn btn-danger" type="reset">Borrar</button> </a>
        </div>
    </div>
</div>
{!!Form::close()!!}
@push ('scripts')
<script>
    $("#unidad").change(mostrarValoresUnidad);
    $("#proveedor").change(mostrarValoresProveedor);

    function mostrarValoresUnidad() {
        datosUnidad = document.getElementById('unidad').value.split('_');
        $("#num_unidad").val(datosUnidad[0]);
        $("#nombre_unidad").val(datosUnidad[1]);
        $("#programa").val(datosUnidad[2]);
    }

    function mostrarValoresProveedor() {
        datosProveedor = document.getElementById('proveedor').value.split('_');
        $("#rfc").val(datosProveedor[0]);
        $("#domicilio").val(datosProveedor[1]);
    }
</script>
@endpush
@endsection