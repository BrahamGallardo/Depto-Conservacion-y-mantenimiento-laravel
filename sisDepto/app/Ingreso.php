<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso';
    protected $primaryKey='idingreso';

    public $timestamps=false;

    protected $fillable=[
    	'tipo_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    ];
    protected $guarded=[
    	
    ];
}
