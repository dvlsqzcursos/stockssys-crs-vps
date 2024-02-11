<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RutaSolicitudDetalles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rutas_solicitudes_despachos_detalles';
    protected $hidden = ['created_at', 'updated_at'];

    public function ruta_solicitud(){
        return $this->hasOne(RutaSolicitud::class,'id','id_ruta_despacho');
    }

    public function escuela(){
        return $this->hasOne(Escuela::class,'id','id_escuela');
    }
}
