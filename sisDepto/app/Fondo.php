<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    protected $table='fondo_revolvente';
    protected $primaryKey='idfondo';

    public $timestamps=false;

    protected $fillable=[
    	'total',
    	'usado',
        'disponible'
    ];
    protected $guarded=[
    	
    ];
}
