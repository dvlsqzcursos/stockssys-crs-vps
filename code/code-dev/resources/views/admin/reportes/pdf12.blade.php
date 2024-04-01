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

    <div>
        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
        @foreach($alimentos as $a)
            <b>{{$a->nombre}} - Existencia Actual: </b> {{ $a->saldo}}  <br>
            <table class="table table-striped table-hover mtop16">
                <thead>
                    <tr>
                        <td>PL</td>
                        <td>BUBD</td>
                        <td>CANT. INGRESADA</td>
                        <td>CANT. USADA</td>
                        <td>CANT. EXISTENCIA</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saldos as $s)
                        @if($a->id == $s->idinsumo)
                            <tr>
                                <td>{{ $s->pl }}</td>
                                <td>{{ $s->bubd }}</td>
                                <td>{{ $s->ingresado }}</td>
                                <td>{{ $s->usado }}</td>
                                <td>{{ $s->existencia }}</td>
                            </tr>
                        
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
            
        @endforeach
    </div>




</body>
</html>