<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class DetalleEgreso extends Model
{
    protected $table='detalle_egreso';
    protected $primaryKey='iddetalle_egreso';

    public $timestamps=false;

    protected $fillable=[
    	'idegreso',
        'cod_articulo',
        'cantidad'
    ];
    protected $guarded=[
    	
    ];
}
