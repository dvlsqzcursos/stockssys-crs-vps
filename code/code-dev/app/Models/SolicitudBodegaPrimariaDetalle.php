<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudBodegaPrimariaDetalle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'solicitudes_bodegas_primarias_detalles';
    protected $hidden = ['created_at', 'updated_at'];

    public function alimento_bodega_primaira(){
        return $this->hasOne(Insumo::class,'id','id_alimento');
    }

    public function alimento_bodega_socio(){
        return $this->hasOne(Bodega::class,'id','id_insumo_bodega_socio');
    }

}
