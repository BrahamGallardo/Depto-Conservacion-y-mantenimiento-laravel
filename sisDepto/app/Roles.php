<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table='roles';
    protected $primaryKey='idrol';
    public $timestamps=false;

    protected $fillable=[
        'nombre_rol',
        'idarea'
    ];
}
