<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodegaIngreso extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bodegas_ingresos';
    protected $hidden = ['created_at', 'updated_at'];

    public function detalles(){
        return $this->hasMany(BodegaIngresoDetalle::class, 'id_ingreso', 'id');
    }

    public function institucion(){
        return $this->hasOne(Institucion::class,'id','id_bodega_despacho');
    }
}
