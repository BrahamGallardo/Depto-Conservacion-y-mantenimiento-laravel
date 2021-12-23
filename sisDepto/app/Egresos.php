<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Egresos extends Model
{
    protected $table='egresos';
    protected $primaryKey='idegreso';

    public $timestamps=false;

    protected $fillable=[
    	'fecha',
    	'trabajador',
        'razon'
    ];
    protected $guarded=[
    	
    ];
}
