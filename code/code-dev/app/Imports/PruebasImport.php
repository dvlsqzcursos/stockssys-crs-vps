<?php

namespace App\Imports;

use App\Models\Escuela;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PruebasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Escuela([
            'codigo'     => $row['codigo'],
            'nombre'    => $row['nombre'],  
            'direccion' => $row['direccion'],
            'id_ubicacion' => $row['id_ubicacion'], 
            'director' => $row['director'],   
            'estado' => $row['estado'],          
        ]);
    }
}
