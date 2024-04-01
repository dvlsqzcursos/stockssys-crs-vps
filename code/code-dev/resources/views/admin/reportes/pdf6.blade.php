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

    <b>Total de Rutas Despachadas: </b>
    @foreach($total_rutas as $t)
            {{$t->total}}

    @endforeach

    <hr>
    <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
    @foreach($solicitud as $s)
        <b>{{$loop->iteration.'. '.$s->ruta}}</b>    <br>
        <table class="table table-striped table-hover mtop16">
            <thead>
                <tr>
                    <td><strong>ALIMENTO</strong></td>
                    <td><strong>UNIDADES</strong></td>
                    <td><strong>SACO/CANECA</strong></td>
                    <td><strong>LIBRAS/QUINTALES</strong></td>
                </tr>
            </thead>
            <tbody>
            
            @foreach($alimentos_bodega as $ab)
                <tr>
                    <td>{{$ab->nombre}}</td>
                    <td></td>
                    @php($cantidad = 0)
                    @foreach($alimentos as $a)
                    
                        @if($s->idruta == $a->idruta )
                            
                                @if($ab->id == $a->idinsumo)
                                    @php($cantidad = $cantidad + $a->cantidad)
                                @endif
                                

                                

                        @endif
                        
                    @endforeach
                    <td>{{$cantidad}}</td>
                    <td></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        
        <hr>
    @endforeach




</body>
</html>