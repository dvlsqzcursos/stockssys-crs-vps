<html lang="en">
<head>
    <title>Boleta de Despacho </title>
    <style>
        @page {
            size: 140mm 216mm landscape;
            height: 216mm;
            width: 140mm;
            margin: 0;
        }

        @media print {
            @page {
                size: 140mm 216mm;
            }
        }


        html {
            width: 140mm;
            height: 216mm;
            margin: 0;
        }

        body {
            width: 140mm;
            height: 216mm;
            margin: 0;
            padding: 0;
            width: 100%;
        }
    </style>
</head>
<body style="background-image: url('/static/imagenes/crs_1.png'); ">
    @foreach($despachos as $d)
        

        <div style="position: relative; top: 31.8mm; left: 48mm;  width: 250px; height: 10px; font-size: 8px;" >
            {{ $d->escuela->nombre}}           
        </div>

        <div style="position: relative; top: 33.8mm; left: 35.6mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->director }}  
        </div>

        <div style="position: relative; top: 5.3mm; left: 153.2mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->codigo}}           
        </div>

        <div style="position: relative; top: 13.2mm; left: 156mm;  width: 250px; height: 10px; font-size: 12px;">
            {{ $d->racion->nombre}}           
        </div>

        <div style="position: relative; top: 18.2mm; left: 170mm;  width: 250px; height: 10px; font-size: 12px;">
            {{ $d->participantes }}           
        </div>

        <div style="position: relative; top: 20.2mm; left: 180mm;  width: 250px; height: 10px; font-size: 12px;">
            {{ obtenerMeses(null, $d->solicitud->entrega->mes_inicial).' - '.obtenerMeses(null, $d->solicitud->entrega->mes_final) }}        
        </div>

        <div style="position: relative; top: 34mm; left: 156mm;  width: 250px; height: 10px; font-size: 12px;" >
            {{ $d->escuela->ubicacion->nombre}}           
        </div>

        <div style="position: relative; top: 38mm; left: 150mm;  width: 250px; height: 10px; font-size: 12px;"  >
            {{ $d->ruta_asignada->ruta_solicitud->nombre}}           
        </div>

        <div style="position: relative; top: 34.2mm; left: 48.2mm;  width: 250px; height: 5px; font-size: 12px;" >
            29/02/2024  
        </div>

        <div style="position: relative; top: 42.2mm; left: 45mm;  width: 100px; height: 10px; font-size: 12px; "  >
            {{ $d->ruta_asignada->ruta_solicitud->tipo_vehiculo}}           
        </div>

        <div style="position: relative; top: 46.5mm; left: 43.3mm;  width: 175px; height: 10px; font-size: 12px;"  >
            {{ $d->ruta_asignada->ruta_solicitud->nombre_piloto}}           
        </div>

        <div style="position: relative; top: 36.4mm; left: 96mm;  width: 100px; height: 10px; font-size: 12px;"  >
            {{ $d->ruta_asignada->ruta_solicitud->placa_vehiculo}}           
        </div>

        <div style="position: relative; top: 40.6mm; left: 99mm;  width: 100px; height: 10px; font-size: 12px;"  >
            {{ $d->ruta_asignada->ruta_solicitud->no_licencia}}           
        </div>

        @foreach($d->detalles as $det)
            <div style="position: relative; top: 50mm; left: 17mm; display:inline-block; padding-top:0px; padding-bottom:0px;  width: 200px; height: 5px; font-size: 12px;" >
                {{ $det->alimento_bodega_socio->nombre}} 
            </div>
                
            <div style="position: relative; top: 50mm; left: 50mm; display:inline-block; padding-top:0px; padding-bottom:0px;  width: 50px; height: 10px; font-size: 12px;" >  
                {{ $det->pl}}  
            </div>

            <div style="position: relative; top: 50mm; left: 55mm; display:inline-block; padding-top:0px; padding-bottom:0px;  width: 50px; height: 10px; font-size: 12px;" >  
                @foreach($raciones as $r)
                    @if($r->id == $d->tipo_racion)
                        @foreach($r->alimentos as $a)
                            @if($a->id_alimento == $det->id_insumo)
                                {{$a->cantidad}}
                            @endif
                        @endforeach
                    @endif 
                @endforeach
            </div>

            <div style="position: relative; top: 50mm; left: 60mm; display:inline-block; padding-top:0px; padding-bottom:0px;  width: 50px; height: 10px; font-size: 12px;" >

                @foreach($det->alimento_bodega_socio->pesos_alimento as $p) 
                        @if(Illuminate\Support\Str::lower($det->alimento_bodega_socio->nombre) != "aceite")
                            {{ $det->no_unidades*$p->libras_x_unidad}} 
                        @else
                            {{ $det->no_unidades*20}} 
                        @endif
                       
                @endforeach    
            </div> 

            <div style="position: relative; top: 50mm; left: 65mm; display:inline-block; padding-top:0px; padding-bottom:0px;  width: 50px; height: 10px; font-size: 12px;" >
                {{ $det->no_unidades}}    
            </div> <br>
            
        @endforeach        

        <div style="position: relative; top: 70mm; left: 90mm;  width: 250px; height: 10px; font-size: 12px;"  >
            Observaciones          
        </div>
        
        
    @endforeach
    
   

</body>
</html>