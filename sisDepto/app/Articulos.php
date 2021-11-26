<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table='articulos';
    protected $primaryKey='idarticulos';
    public $timestamps=false;

    protected $fillable=[
        'nombre_articulo',
        'tipo',
        'unidad',
        'cantidad',
        'ubicacion'
        
    ];
}
