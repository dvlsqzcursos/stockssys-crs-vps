<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Insumos - #{{$solicitud->id}} </title>
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
            Pastoral Social Cáritas de los Altos <br>
            SOLICITUD DE ALIMENTOS A BODEGA PRIMARIA
        </h5>    
    </div>
    <br><br>

    <div style="display: flex;">
        <div style="text-align: left; width: 33%; display: inline-block; float:left;">
            <b>Bodega: </b> <br>
            <b>Raciones Solicitadas: </b> {{ number_format($solicitud->raciones_solicitadas, 0, '.', ',' ) }} <br>
            <b>Beneficiarios a Atender: </b> {{ number_format($solicitud->beneficiarios, 0, '.', ',' ) }} <br>
        </div>

        <div style="text-align: center; width: 33%; display: inline-block; float:left">
            <b>ID: </b> <br>
        </div>

        <div style="text-align: left; width: 33%; display: inline-block; float:right;">
            <b>Fecha de Solicitud: </b> <br>
            <b>Mes de Solicitud:</b> <br>
            <b>Año Fiscal: </b>  <br>
        </div>
    </div>
    <br>

    <p style="text-align: justify;">
        <small><b><h6>
            De la manera más atenta nos dirigimos a ustedes para solicitarles nos sean enviadas las cantidades de alimentos indicadas 
            en la columna "Total a enviar (Unidades)" del siguiente cuadro para atender a las familias participantes en el programa
        </h6></b></small>
    </p>

    <br>
    <div>
        <table style="text-align:center;">
            <thead style=" border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <td colspan="2"></td>
                    <td>Ración</td>
                    <td colspan="2">Total Requerido</td>
                    <td colspan="2">Total en Existencia</td>
                    <td>Total a Enviar</td>
                </tr>
                <tr>
                    <td>PRODUCTO</td>
                    <td>TIPO</td>
                    <td>Gramos/Kgs</td>
                    <td>Kilogramos</td>
                    <td>Unidades</td>
                    <td>Kilogramos</td>
                    <td>Unidades</td>
                    <td>Unidades</td>
                </tr>
            </thead>
            <tbody style="border: 1px solid black; font-size: 10px;">
                @foreach($solicitud->detalles as $det)
                <tr>
                    <td>{{$det->alimento_bodega_socio->nombre}}</td>
                    <td>{{$det->racion->tipo_alimentos }}</td>
                    <td></td>
                    <td>{{$det->no_unidades}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach                   

            </tbody>
            
        </table>
    </div>
    <br>

    <p style="text-align: justify;">
        <small><b><h6>
            NOTA: <br>
            Esta solicitud incluye seis (6) unidades para stock de seguridad por cada una de las modalidades de entrega. <br>
            Les agradeceremos comunicarnos las fechas en que los alimentos serán enviados a nuestra bodega para coordinar la recepción de los mismos. <br><br>
            De antemano les agradecemos su atención a la presente solicitud. <br><br>
            Atentamente, <br><br>

        </h6></b></small>
    </p>
    
    <br>

    <div style="display: flex; font-size:10px;">
        <div style="text-align: left; width: 50%; display: inline-block; float:left;">
            <b>Preparado por: </b> <br><br><br>
            <b>Aprobado por: </b> <br>
        </div>

        <div style="text-align: left; width: 50%; display: inline-block; float:right;">
            <b>F.</b> <br><br><br>
            <b>F.</b> <br>
        </div>
    </div>
    <br><br><br><br>

    <div style="display: flex; font-size:10px;">
        <div style="text-align: left; width: 50%; display: inline-block; float:left;">
            <b>{{\Carbon\Carbon::now()}} </b> <br>
            <b>Generado por: </b> {{Auth::user()->nombres.' '.Auth::user()->apellidos}}<br>
        </div>

        <div style="text-align: left; width: 50%; display: inline-block; float:right;">
            <b>StocksSys</b> <br><br><br>
        </div>
    </div>



</body>
</html>