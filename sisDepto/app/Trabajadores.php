<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Trabajadores extends Model
{
    protected $table='trabajadores';
    protected $primaryKey='idtrabajador';
    public $timestamps=false;

    protected $fillable=[
        'nombre_trabajador',
        'email',
        'telefono',
        'idtipo_trabajador',
        'idrol',
        'idestado',
        'idhorario'
    ];


}
