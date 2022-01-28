@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>
            <a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a>
            Buscar
        </h3>
    </div>
</div>
<form action="/resultado" method="post">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
                <label for="anio">Año</label>
                <select name="anio" id="anio" class="form-control selectpicker" data-live-search="true">
                    <option value="">Elija una opción</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="unidad">Unidad</label>
                <select name="unidad" id="unidad" class="form-control selectpicker" data-live-search="true">
                    <option value="">Elija una opción</option>
                    @foreach($oficinas as $ofice)
                    <option value="{{$ofice->unidad}}">{{$ofice->oficinas}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
        <a href="{{url('/resultado')}}"> <button type="submit" class="btn btn-primary">Buscar</button></a>
    </div>
</form>
@endsection