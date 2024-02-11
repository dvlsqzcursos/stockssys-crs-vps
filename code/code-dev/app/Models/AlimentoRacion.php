<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlimentoRacion extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $table = 'alimentos_raciones';
    protected $hidden = ['created_at', 'updated_at']; 

    public function alimento(){
        return $this->hasOne(Bodega::class,'id','id_alimento');
    }
}
