<?php

namespace sisDepartamento;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table='areas';
    protected $primaryKey='idarea';
    public $timestamps=false;

    protected $fillable=[
        'area'
    ];
}