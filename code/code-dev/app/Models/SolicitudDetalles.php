<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudDetalles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'solicitud_detalles';
    protected $fillable = [
        'fecha', 
        'id_escuela',
        'mes_de_solicitud', 
        'dias_de_solicitud', 
        'ninas_pre_primaria_a_tercero_primaria', 
        'ninos_pre_primaria_a_tercero_primaria',
        'total_pre_primaria_a_tercero_primaria',
        'ninas_cuarto_a_sexto', 
        'ninos_cuarto_a_sexto',
        'total_cuarto_a_sexto', 
        'total_de_estudiantes', 
        'total_de_raciones_de_estudiantes', 
        'total_docentes',
        'total_voluntarios',
        'total_de_docentes_y_voluntarios', 
        'total_de_raciones_de_docentes_y_voluntarios',
        'total_de_personas', 
        'total_de_raciones', 
        'tipo_de_actividad_alimentos', 
        'numero_de_entrega',
        'tipo'
    ];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function solicitud(){
        return $this->hasOne(Solicitud::class,'id','id_solicitud');
    }

    public function escuela(){
        return $this->hasOne(Escuela::class,'id','id_escuela');
    }

    public function racion(){
        return $this->hasOne(Racion::class,'id','tipo_de_actividad_alimentos');
    }
}
