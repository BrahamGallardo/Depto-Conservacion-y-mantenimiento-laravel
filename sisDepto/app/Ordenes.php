<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    protected $table='ordenes';
    protected $primaryKey='num_orden';

    public $timestamps=false;

    protected $fillable=[
    	'unidad',
    	'partida',
        'concepto',
        'proveedor',
        'descripcion',
        'fecha'
    ];
    protected $guarded=[
    	
    ];
}
