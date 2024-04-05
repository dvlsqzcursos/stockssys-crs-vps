<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte No.{{$numReporte}} </title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }

    


    </style>
    


</head>
<body>
    <div style="text-align: center;">
        <h5>
            Programa "Aprendizaje para la vida" "Nojb'al rech K'aslemal" (K'iche) <br>
            Pastoral Social Cáritas de los Altos 
        </h5>    
    </div>
    
    <div style="text-align: center;">
        <h5>
            Reporte No. {{$numReporte}} - StocksSys 
            
        </h5>    
        <b>Descripción: </b> {{ obtenerDescripcionReportes(null, $numReporte) }}
    </div>
    <br>
E1-08 90131 - Sebastian Mazariegos
af: 20441190141101
2044490141101
bf Maria Antonieta
clinica 4 - Dra Patricia 

90440
    <div>
        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
        <table cellpadding="0" cellspacing="0" width="100%" style="font-size: 15px">
            <thead>
                <tr>
                    <td>FECHA DE INGRESO</td>
                    <td>PROCEDENCIA</td>
                    <td>TIPO DOCUMENTO / NO. DOCUMENTO</td>                                    
                    <td>ALIMENTO</td>
                    <td>PL</td>
                    <td>CANT. INGRESADA</td>
                </tr>
            </thead>
            <tbody>
                @foreach($saldos as $s)
                    <tr>
                        <td>{{ $s->fecha_ingreso }}</td>
                        <td>
                            @if(!is_null($s->procedente)):
                                {{ $s->procedente }}
                            @else
                                @foreach($bodegas as $b)
                                    @if($b->id == $s->bodega_primaria)
                                        {{ $b->nombre }}
                                    @endif
                                @endforeach
                                
                            @endif
                        </td>
                        <td>{{ obtenerDocumentosIngreso(null, $s->tipo_documento).' - No. '.$s->no_documento }}</td>                                        
                        <td>{{ $s->alimento }}</td>
                        <td>{{ $s->pl }}</td>                                            
                        <td>{{ $s->ingresado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>




</body>
</html>