<?php

namespace App\Imports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SolicitudImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Solicitud([
            'fecha'  => $row['fecha_de_solicitud'], 
            'id_escuela'  => $row['id_escuela'],
            'mes_de_solicitud'  => $row['mes_de_solicitud'], 
            'dias_de_solicitud'  => $row['dias_de_solicitud'], 
            'ninas_pre_primaria_a_tercero_primaria'  => $row['ninas_pre_primaria_a_tercero_primaria'], 
            'ninos_pre_primaria_a_tercero_primaria'  => $row['ninos_pre_primaria_a_tercero_primaria'],
            'total_pre_primaria_a_tercero_primaria'  => $row['total_pre_primaria_a_tercero_primaria'],
            'ninas_cuarto_a_sexto'  => $row['ninas_cuarto_a_sexto'], 
            'ninos_cuarto_a_sexto'  => $row['ninos_cuarto_a_sexto'],
            'total_cuarto_a_sexto'  => $row['total_cuarto_a_sexto'], 
            'total_de_estudiantes'  => $row['total_de_estudiantes'], 
            'total_de_raciones_de_estudiantes'  => $row['total_de_raciones_de_estudiantes'], 
            'total_docentes'  => $row['total_docentes'],
            'total_voluntarios'  => $row['total_voluntarios'],
            'total_de_docentes_y_voluntarios'  => $row['total_de_docentes_y_voluntarios'], 
            'total_de_raciones_de_docentes_y_voluntarios' => $row['total_de_raciones_de_docentes_y_voluntarios'],
            'total_de_personas' => $row['total_de_personas'], 
            'total_de_raciones' => $row['total_de_raciones'], 
            'tipo_de_actividad_alimentos' => $row['tipo_de_actividad_alimentos'], 
            'numero_de_entrega' => $row['numero_de_entrega'],
            'tipo'  => $row['tipo'], 
        ]);
    }

    public function rules(): array
    {
        return [


             // Above is alias for as it always validates in batches
             '*.fecha' => [
                'date', 'required'
             ],
        ];
    }
}
