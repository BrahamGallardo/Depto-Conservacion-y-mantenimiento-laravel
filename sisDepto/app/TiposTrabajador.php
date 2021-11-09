<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class TiposTrabajador extends Model
{
    protected $table='tipos_trabajador';
    protected $primaryKey='idtipo_trabajador';
    public $timestamps=false;

    protected $fillable=[
        'tipo_trabajador'
    ];
}
