<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalle_ingreso';
    protected $primaryKey='iddetalle_ingreso';

    public $timestamps=false;

    protected $fillable=[
    	'idingreso',
    	'archivo',
    	'precio_total',
        'cod_articulo',
        'cantidad'
    ];
    protected $guarded=[
    	
    ];
}
