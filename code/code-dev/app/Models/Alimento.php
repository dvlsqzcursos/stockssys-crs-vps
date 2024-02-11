<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alimento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'alimentos';
    protected $hidden = ['created_at', 'updated_at'];


}
