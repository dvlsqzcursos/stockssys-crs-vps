<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RutaSolicitud extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rutas_solicitudes_despachos';
    protected $hidden = ['created_at', 'updated_at'];

    public function ruta_base(){
        return $this->hasOne(Ruta::class,'id','id_ruta_base');
    }

    public function detalles(){
        return $this->hasMany(RutaSolicitudDetalles::class,'id_ruta_despacho','id');
    }
}
