<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class UnidadesArticulo extends Model
{
    protected $table='unidades_articulo';
    protected $primaryKey='idunidad';
    public $timestamps=false;

    protected $fillable=[
        'unidad'
    ];
}
