<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table='solicitudes';
    protected $primaryKey='idsolicitud';
    public $timestamps=false;

    protected $fillable=[
        'asunto',
        'unidad',
        'jurisd_sanit',
        'tipo',
        'compromiso',
        'fecha_limite',
        'estado',
        'actualización',
        'comentarios'
    ];
}
