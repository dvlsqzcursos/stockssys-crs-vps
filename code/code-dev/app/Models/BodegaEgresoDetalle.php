<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodegaEgresoDetalle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bodegas_egresos_detalles';
    protected $hidden = ['created_at', 'updated_at'];

    public function alimento_bodega_socio(){
        return $this->hasOne(Bodega::class,'id','id_insumo');
    }

    public function insumo(){
        return $this->hasOne(Bodega::class,'id','id_insumo');
    }
}
