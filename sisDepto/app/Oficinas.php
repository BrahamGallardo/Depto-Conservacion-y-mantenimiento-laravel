<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Oficinas extends Model
{
    protected $table='oficinas';
    protected $primaryKey='num_oficina';

    public $timestamps=false;

    protected $fillable=[
    	'unidad',
    	'nombre_corto',
        'programa',
        'descripcion'
    ];
    protected $guarded=[
    	
    ];
}
