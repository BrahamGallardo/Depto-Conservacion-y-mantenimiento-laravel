<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class TiposArticulo extends Model
{
    protected $table='tipos_articulo';
    protected $primaryKey='idtipo_articulo';
    public $timestamps=false;

    protected $fillable=[
        'tipo_articulo'
    ];
}
