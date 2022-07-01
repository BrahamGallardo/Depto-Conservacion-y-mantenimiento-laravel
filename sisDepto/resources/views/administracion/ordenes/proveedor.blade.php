@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Nueva proveedor</h3>
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
{!!Form::open(array('url'=>'administracion/proveedores','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="rfc">RFC</label>
            <input required type="text" value="" name="rfc" class="form-control" placeholder="RFC">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="nombre">Nombre proveedor</label>
            <input type="text" value="" name="proveedor" class="form-control" placeholder="Nombre del proveedor">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" value="" name="domicilio" class="form-control" placeholder="Domicilio">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
            <button class="btn btn-primary" id="btnsolicitar" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Borrar</button>
        </div>
    </div>
</div>
{!!Form::close()!!}

@endsection