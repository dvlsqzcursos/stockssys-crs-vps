<?php

namespace App\Imports;

use App\Models\SolicitudDetalles;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Throwable;
use App\Models\Escuela, App\Models\Racion;

class SolicitudDetallesImport implements ToModel, WithHeadingRow, WithValidation,  SkipsOnError, SkipsOnFailure
{

    use Importable, SkipsErrors, SkipsFailures;

    private $escuelas;
    private $tipo_actividad_alimentos;

    public function __construct(){
        $this->escuelas = Escuela::pluck('id', 'codigo');
        $this->tipo_actividad_alimentos = Racion::pluck('id', 'tipo_alimentos');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SolicitudDetalles([
            'fecha'  => $row['fecha_de_solicitud'], 
            'id_escuela'  => $row['codigo_de_la_escuela'],
        ]);
    }

    public function rules(): array
    {
        return [


             // Above is alias for as it always validates in batches
            
        ];
    }

    public function onError(Throwable $error)
     {
        
     }
}
