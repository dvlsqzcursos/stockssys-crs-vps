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

        <b>Total de Boletas de Despacho: </b>
                         {{ count($solicitud) }}
        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
        <table class="table table-striped table-hover mtop16">
                <thead>
                    <tr>
                        <td><strong>ESCUELA</strong></td>
                        <td><strong>NO. BOLETA</strong></td>
                        <td><strong>MUNICIPIO</strong></td>
                        <td><strong>TIPO RACIÓN</strong></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitud as $s)
                        <tr>
                            <td>{{$s->escuela}}</td>
                            <td>{{$s->no_documento}}</td>
                            <td>{{$s->municipio}}</td>
                            <td>{{$s->racion}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>




</body>
</html>