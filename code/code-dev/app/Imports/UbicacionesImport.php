<?php

namespace App\Imports;

use App\Models\Ubicacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UbicacionesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ubicacion([
            'nombre' => $row['nombre'], 
            'nomenclatura' => $row['nomenclatura'],
            'nivel' => $row['nivel'],
            'id_principal' => $row['id_principal'],
        ]);
    }
}
