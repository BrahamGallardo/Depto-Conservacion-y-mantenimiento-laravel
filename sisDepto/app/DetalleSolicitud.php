<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    protected $table='detalle_solicitud';
    protected $primaryKey='iddetalle_solicitud	';

    public $timestamps=false;

    protected $fillable=[
    	'solicitud',
    	'egreso	',
        'razontrabajador',
        'fecha',
        'total',
        'folio',
        'documento'
    ];
    protected $guarded=[
    	
    ];
}
