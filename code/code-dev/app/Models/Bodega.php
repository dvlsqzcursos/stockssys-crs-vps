<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bodega extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $table = 'bodegas';
    protected $hidden = ['created_at', 'updated_at'];

    public function insumo(){
        return $this->hasOne(Insumo::class,'id','id_insumo');
    }

}
