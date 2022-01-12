<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table='proveedores';
    protected $primaryKey='rfc';

    public $timestamps=false;

    protected $fillable=[
    	'proveedor',
    	'domicilio'
    ];
    protected $guarded=[
    	
    ];
}
