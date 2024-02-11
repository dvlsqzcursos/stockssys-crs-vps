<?php

namespace App\Imports;

use App\Models\Escuela;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EscuelasImport implements ToModel, WithHeadingRow, WithValidation
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Escuela([
            'jornada'     => $row['jornada'],
            'codigo'     => $row['codigo'],
            'nombre'    => $row['nombre'],  
            'direccion' => $row['direccion'],            
            'id_ubicacion' => $row['id_ubicacion'], 
            'no_total_beneficiarios' => $row['no_beneficiarios'], 
            'director' => $row['director'],   
            'estado' => $row['estado'],    
            'id_socio' => $row['id_socio'],      
        ]);
    }

    public function rules(): array
    {
        return [


             // Above is alias for as it always validates in batches
             '*.id_ubicacion' => [
                'integer', 'required'
             ],
        ];
    }
}
