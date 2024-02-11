<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<!--
<body style="background-image: url({{ url('/static/imagenes/medidas_boleta.jpg') }} );   background-repeat: no-repeat; background-attachment: fixed;  background-size: 100% 100%;  background-position: center center; margin-top: -34;">
-->
<body>
    @foreach($despachos as $d)
        <div style="float: right; margin-top: 80px; margin-right: -50px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->codigo}}           
        </div>
        <div style="float: right; margin-top: 95px; margin-right: -275px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->racion->nombre}}           
        </div>
        <div style="float: right; margin-top: 127px; margin-right: -130px;  width: 100px; height: 10px; font-size: 12px;" >
            {{ obtenerMeses(null, $d->solicitud->entrega->mes_inicial).' - '.obtenerMeses(null, $d->solicitud->entrega->mes_final).' '.$d->solicitud->entrega->year}}           
        </div>
        <div style="float: left; margin-top: 127px; margin-left: 175px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->nombre}}           
        </div>
        <div style="float: left; margin-top: 145px; margin-left: -300px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->director }}  
        </div>
        <div style="float: right; margin-top: 175px; margin-right: -225px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->ubicacion->nombre}}           
        </div>
        <div style="float: right; margin-top: 195px; margin-right: -225px;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$d->escuela->ruta_asignada->ruta->correlativo }}           
        </div>

        <div style="float: left; margin-top: 270px; margin-left: -250px;  width: 500px; height: 10px; font-size: 12px;" >
            @foreach($d->detalles as $det)
                
                    {{ $det->alimento_bodega_socio->nombre}} 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $det->pl}}  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $det->no_unidades}}     
                    <br>       
                
            @endforeach        
        </div>
    @endforeach


</body>
</html>