<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class EstadosTrabajador extends Model
{
    protected $table='estados_trabajador';
    protected $primaryKey='idestado_trabajador';
    public $timestamps=false;

    protected $fillable=[
        'estado_trabajador'
    ];
}
