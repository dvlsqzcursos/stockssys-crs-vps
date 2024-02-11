<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesoInsumo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pesos_insumos';
    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'gramos_x_libra' => 'decimal:6',
        'gramos_x_kg' => 'decimal:2',
        'libras_x_kg' => 'decimal:6',
        'kg_x_unidad' => 'decimal:2',
        'gramos_x_unidad' => 'decimal:2',
        'libras_x_unidad' => 'decimal:6',
        'quintales_x_unidad' => 'decimal:8',
        'peso_bruto_quintales' => 'decimal:3',
        'tonelada_metrica_kg' => 'decimal:2',
        'unidades_x_tm' => 'decimal:9',
    ];

    public function alimento(){
        return $this->hasOne(Bodega::class,'id','id_insumo');
    }
}
