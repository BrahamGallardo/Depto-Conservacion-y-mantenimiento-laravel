@extends('layouts.admin')
@section('contenido')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Programar</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        {!!Form::open(array('url'=>'evento','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}

        <div class="fomr-group">
            <label>Titulo</label>
            <input type="text" class="form-control" name="titulo">
        </div>
        <div class="fomr-group">
            <label>Descripcion del Evento</label>
            <textarea class="form-control" name="descripcion" rows="4" placeholder="Descripcion"></textarea>
        </div>
        <div class="fomr-group">
            <label>Fecha</label>
            <input type="date" class="form-control" name="fecha">
        </div>
        <br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-info" value="Guardar">
        {!!Form::close()!!}
    </div>
</div> <!-- /container -->


@endsection