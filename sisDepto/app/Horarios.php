<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table='horarios';
    protected $primaryKey='idhorario';
    public $timestamps=false;

    protected $fillable=[
        'hora_entrada',
        'hora_salida'
    ];
}
