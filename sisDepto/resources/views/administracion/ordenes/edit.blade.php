@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Editar orden {{$orden->num_orden}}</h3>
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
{!!Form::model($orden,['method'=>'PATCH','route'=>['administracion.ordenes.update',$orden->num_orden]])!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input required type="date" value="{{$orden->fecha}}" name="fecha" class="form-control" placeholder="Fecha">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="unidad">Oficina</label>
            <select required name="unidad" id="unidad" class="form-control selectpicker" data-live-search="true">
                @foreach($oficinas as $ofice)
                @if($ofice->num_oficina == $orden->num)
                <option value="{{$ofice->num_oficina}}_{{$ofice->nombre_corto}}_{{$ofice->programa}}" selected>{{$ofice->oficinas}}</option>
                @else
                <option value="{{$ofice->num_oficina}}_{{$ofice->nombre_corto}}_{{$ofice->programa}}">{{$ofice->oficinas}}</option>
                @endif
                @endforeach
            </select>
            <input type="hidden" value="{{$orden->num}}" name="num_unidad" id="num_unidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="partida">Partida</label>
            <select required name="partida" class="form-control selectpicker" data-live-search="true">
                @foreach($partidas as $par)
                @if($par->num_partida == $orden->partida)
                <option value="{{$par->num_partida}}" selected>{{$par->partidas}}</option>
                @else
                <option value="{{$par->num_partida}}">{{$par->partidas}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="nombre">Unidad</label>
            <input required type="text" value="{{$orden->nombre_corto}}" name="nombre_unidad" id="nombre_unidad" class="form-control" placeholder="Nombre unidad">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="programa">Programa</label>
            <input type="text" value="{{$orden->programa}}" name="programa" id="programa" class="form-control" placeholder="Programa">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <select required name="proveedor" id="proveedor" class="form-control selectpicker" data-live-search="true">
                @foreach($proveedores as $pro)
                @if($pro->rfc == $orden->rfc)
                <option value="{{$pro->rfc}}_{{$pro->domicilio}}" selected>{{$pro->proveedor}}</option>
                @else
                <option value="{{$pro->rfc}}_{{$pro->domicilio}}">{{$pro->proveedor}}</option>
                @endif
                @endforeach
            </select>
            <input type="hidden" value="{{$orden->rfc}}" name="rfc" id="rfc">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" value="{{$orden->domicilio}}" id="domicilio" name="domicilio" class="form-control" placeholder="Domicilio">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="concepto">Concepto</label>
            <textarea class="form-control" name="concepto" rows="4" placeholder="Concepto">{{$orden->concepto}}</textarea>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" name="descripcion" rows="4" placeholder="Descripcion">{{$orden->descripcion}}</textarea>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
            <button class="btn btn-primary">Guardar</button>
            <button class="btn btn-danger" type="reset">Borrar cambios</button>
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