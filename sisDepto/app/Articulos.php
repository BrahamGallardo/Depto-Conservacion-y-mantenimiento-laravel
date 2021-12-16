<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table='articulos';
    protected $primaryKey='codigo';
    public $timestamps=false;

    protected $fillable=[
        'nombre_articulo',
        'tipo',
        'unidad',
        'cantidad',
        'ubicacion',
        'numero_articulo'
    ];
}
