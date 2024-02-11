<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsumoKit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'insumos_kits';
    protected $hidden = ['created_at', 'updated_at']; 

    public function insumo(){
        return $this->hasOne(Bodega::class,'id','id_insumo');
    }
}
