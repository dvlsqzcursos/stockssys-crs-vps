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

        <b>Total de Solicitudes Atendidas: </b>
                {{ count($solicitud) }}
        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
        @foreach($solicitud as $s)
            <b>{{$loop->iteration.'.'}}</b> 
            <b>Solicitud (ID)</b>  {{ $s->id}} - 
            <b>Meses de Entrega: </b> {{obtenerMeses(null, $s->entrega->mes_inicial).' / '.obtenerMeses(null, $s->entrega->mes_final)}} 
            <br>
            <b>Archivo Excel de la Solicitud: </b>
            {{$s->nombre_archivo}}
            <br>
            <b>Comentarios/Observaciones: </b>
            {{$s->observaciones}}
            <br>
            
            
            <hr>
        @endforeach
    </div>




</body>
</html>