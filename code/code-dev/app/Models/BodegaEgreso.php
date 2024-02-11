<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodegaEgreso extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bodegas_egresos';
    protected $hidden = ['created_at', 'updated_at'];

    public function detalles(){
        return $this->hasMany(BodegaEgresoDetalle::class, 'id_egreso', 'id');
    }

    public function escuela(){
        return $this->hasOne(Escuela::class,'id','id_escuela_despacho');
    }

    public function solicitud(){
        return $this->hasOne(Solicitud::class,'id','id_solicitud_despacho');
    }

    public function racion(){
        return $this->hasOne(Racion::class,'id','tipo_racion');
    }

}
