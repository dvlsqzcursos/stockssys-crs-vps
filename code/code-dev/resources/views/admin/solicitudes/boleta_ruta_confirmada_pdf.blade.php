<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia de Transporte - {{$ruta->nombre}} </title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }

        #footer {
            position: fixed;
            left: 20px;
            bottom: 0;
            text-align: center;
        }

        .page-number:after { content: counter(page); }

    


    </style>
    


</head>
<body>
    <div style="text-align: center;">
        <h5>
            Programa "Aprendizaje para la vida" "Nojb'al rech K'aslemal" (K'iche) <br>
            Pastoral Social Cáritas de los Altos 
        </h5>    
    </div>

    <div style="text-align: left;">
        <h5>
            Arquidiocesis de los Altos Quetzaltenango Totonicapán <br>
            Bodega PSC Salcajá #12 <br>
            KM. 190 Autopista Los Altos, Salcajá Quetzaltenango <br>
            Teléfono: 77688109
        </h5>    
    </div>

    <div style="display: flex;">
        <div style="text-align: left; display: inline-block; float:left;">
            <b>Fecha de traslado: </b>    
        </div>

        <div style="text-align: right; display: inline-block; float:right;">
            <b>Periodo correspondiente: </b> {{ obtenerMeses(null, $solicitud->entrega->mes_inicial).' - '.obtenerMeses(null, $solicitud->entrega->mes_final)}}    
            
        </div>
    </div>
    <br>

    <p style="text-align: center; border-style: solid; ">
        GUIA DE TRANSPORTE TERRESTRE
    </p>

    <div style="display: flex;">
        <div style="text-align: left; width: 50%; display: inline-block; float:left;">
            <b>Ruta: </b> {{ $ruta->nombre }}<br>
            <b>Empresa del transporte: </b> {{ $ruta->empresa_transporte }}<br>
            <b>Nombre del piloto: </b> {{ $ruta->nombre_piloto }} <br>
            <b>Número de licencia: </b> {{ $ruta->no_licencia }} <br>    
        </div>

        <div style="text-align: left; width: 50%; display: inline-block; float:right;">
            <b>Dirección de emisión: </b> <br>
            <b>Municipio de destino:</b> {{$ruta->ruta_base->ubicacion->nombre}}<br>
            <b>Placa del vehículo: </b> {{ $ruta->placa_vehiculo }} <br>
            <b>Tipo de vehículo: </b> {{ $ruta->tipo_vehiculo }}<br>   
        </div>
    </div>
    <br>

    <p style="text-align: justify;">
        <small  ><b><h6>NOTA: El encargado del transporte se responsabiliza por daños o diferencias en las unidades o cantidades que no sean entregadas
            en la bodega de destino, por diferencia de esta guía.</h6>
        </b></small>
    </p>

    <div>
        <table style="text-align:center;">
            <thead style="background-color: #96D4D4; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <td>CODIGO</td>
                    <td>ESCUELA</td>
                    <td>Part.</td>
                    @foreach($alimentos as $a)
                        <td>{{$a->nombre}}</td>
                    @endforeach
                    <td>Quintales/escuela</td>
                    <td>TIPO</td>
                    <td>BOL.</td>
                </tr>
            </thead>
            <tbody style="border: 1px solid black; font-size: 10px;">
                    @php($total_participantes = 0)
                    @foreach($detalle_escuelas as $det)  

                        <tr>
                            <td> {{$det->escuela_codigo}} </td>
                            <td> {{$det->escuela_nombre}} </td>
                            <td> 
                                {{$det->participantes}}
                                @php($total_participantes = $total_participantes + $det->participantes)
                            </td> 
                              
                            
                            
                                
                            @php($d = 0)
                            @for($i =0; $i < count($detalles); $i++)                    
                            
                            @if($det->escuela_id  == $detalles[$d]["escuela_id"] && $det->idracion  == $detalles[$d]["idracion"]  )
                            @php($total_quintales = 0)
                                @foreach($alimentos as $a)
                                    @php($e = 0)
                                    
                                    @for($j =0; $j< count($detalles[$d]["detalles_alimentos"]); $j++)
                                        @if($detalles[$d]["detalles_alimentos"][$e]["id_insumo"] == $a->id)
                                            <td>{{$detalles[$d]["detalles_alimentos"][$e]["no_unidades"] }}</td>       
                                            
                                            @if($a->nombre == "Arroz" || $a->nombre == "arroz")
                                                @php($total_quintales = $total_quintales + ($detalles[$d]["detalles_alimentos"][$e]["no_unidades"]))    
                                            @else
                                                @php($total_quintales = $total_quintales + $detalles[$d]["detalles_alimentos"][$e]["no_unidades"])    
                                            @endif                                
                                        @endif                                             
                                        @php($e++)
                                    @endfor

                                                                  
                                        
                                @endforeach                                    
                                    
                            @endif 

                                    
                                    

                                
                                    

                                    
                                    

                                
                                @php($d++)
                            @endfor  
                            
                            <td style="background-color: #96D4D4;">{{ $total_quintales }}</td>
                            <td>{{$det->racion}} </td>
                            <td></td>
                        </tr>
                    @endforeach

            </tbody>
            <tfoot style="background-color: #96D4D4; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <td colspan="2">Total de unidades a enviar</td>
                    <td>{{ $total_participantes }}</td>
                    @foreach($alimentos as $a)       
                    @php($totales = 0)
                        @foreach($totales_alimentos as $t)
                        
                        @if($a->id == $t->insumo)                 
                            <td>{{$t->total_insumo}}</td>    
                                                 
                            
                        @endif

                        @if($a->nombre == "Arroz" || $a->nombre == "arroz")
                            @php($totales = $totales + ($t->total_insumo))
                        @else
                            @php($totales = $totales + $t->total_insumo)
                        @endif  
                        
                        
                        @endforeach
                    @endforeach
                    <td>{{ $totales }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>

    <div style="display: inline-block; justify-item: center;">
        <table style="">
            <thead style=" border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <td>PRODUCTO</td>
                    
                    @foreach($alimentos as $a)
                        <td>{{$a->nombre}}</td>
                    @endforeach
                    <td>TOTAL</td>
                </tr>
            </thead>
            <tbody style="border: 1px solid black;">
                <tr>
                    <td>ENTEROS</td>
                    @foreach($alimentos as $a)                        
                        <td></td>
                    @endforeach
                    <td></td>
                    
                </tr>
                <tr>
                <td>PORCIONADOS</td>
                    @foreach($alimentos as $a)                        
                        <td></td>
                    @endforeach
                    <td></td>
                    
                </tr>

            </tbody>
        </table>
    </div>

    <div id="footer">
        <span class="page-number">Pagina <script type="text/php">echo $PAGE_NUM</script></span>
    </div>




</body>
</html>