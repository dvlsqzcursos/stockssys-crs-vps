@extends('admin.plantilla.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/reportes') }}"><i class="fa-solid fa-file-lines"></i> Reportes</a></li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3">
            <div class="card">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Listado de Reportes</strong></h2>
                </div>

                <div class="card-body" style="text-align:center;  overflow-y: scroll; line-height: 1em; height:400px;">
                    <ul>
                        <ol><small> 
                        <b>1.</b> Total de escuelas despachadas detallando cada tipo de alimento o producto tanto en unidades y su peso en libras/quintales, para cada modalidad escolar, voluntarios y lideres
                        </small></ol>
                        <ol><small>
                        <b>2.</b> Total de escuelas despachadas con Maíz USDA (mismas características del anterior)
                        </small></ol>
                        <ol><small>
                        <b>3.</b> Total de escuelas despachadas con Maiz Biofortificado (mismas características del anterior)
                        </small></ol>
                        <ol><small>
                        <b>4.</b> Total de escolares despachados (de preprimaria a 6º primaria) mismas características del anterior
                        </small></ol>
                        <ol><small>
                        <b>5.</b> Total de escolares despachados desglosado de prepa a tercero primaria y de cuarto a sexto primaria (mismas características del anterior)
                        </small></ol>
                        <ol><small>
                        <b>6.</b> Total de rutas despachadas y cantidad de unidades y su peso por cada ruta 
                        </small></ol>
                        <ol><small>
                        <b>7.</b> Total de toneladas métricas de ración escolar completa, desglosada (prepa a 30 y cuarto a sexto)
                        </small></ol>
                        <ol><small>
                        <b>8.</b> Todos los datos estadísticos: cantidad de escolares niños, cantidad de escolares niñas, niños de prepa a tercero primaria, niñas de prepa a tercero primaria, niños de cuarto a sexto y niñas de cuarto a sexto. Cantidad de voluntarios total y cantidad de Lideres total 
                        </small></ol>
                        <ol><small>
                        <b>9.</b> Reporte de los bimestres despachados en el año: nombre de los meses, numero de dias despachados
                        </small></ol>
                        <ol><small>
                        <b>10.</b> Total de guías despachadas: nombre del municipio, numero de ID de guía, números de boletas de despacho. 
                        </small></ol>
                        <ol><small>
                        <b>11.</b> Total de solicitudes de alimento en el año (visualizar su descripción)
                        </small></ol>
                        <ol><small>
                        <b>12.</b> Saldos de inventario por tipos de alimento u otro artículo. En el caso de alimento por tipo de PL, fecha BUBD del alimento´
                        </small></ol>
                        <ol><small>
                        <b>13.</b> Reporte de diferencias de pesos: ingresos y salidas por balance 
                        </small></ol>
                        <ol><small>
                        <b>14.</b> Reporte de alimento cuestionable o en estado de cuarentena: unidades y peso
                        </small></ol>
                        <ol><small>
                        <b>15.</b> Reporte de saldo de perdidas o declaración de alimento descartado: unidades y peso
                        </small></ol>
                        <ol><small>
                        <b>16.</b> Reporte de ingresos de guías de transporte de la bodega primaria y de las guías de proveedor de maíz biofortificado: numero de documento, fechas de ingreso, cantidad en unidades y peso, tipos de producto, PL y BUBD 
                        </small></ol>
                        <ol><small>
                        <b>17.</b> Registro de datos para muestreos aleatorios: PL y BUBD, tipo de alimento, cantidad en unidades y peso de las muestras (en libras y kilogramos), numero de contrato
                        </small></ol>
                    </ul>
                </div>

            </div>
            
        </div>

        <div class="col-md-9">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Generar Reporte</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/reporte/panel/generar', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-12">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Socio: </strong></label>
                            <div class="input-group">           
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="id_socio" id="id_socio" style="width: 95%" >
                                    @foreach($socio as $s)
                                        <option value=""></option>
                                        <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                                    @endforeach
                                </select>       
                                <a href="#" class="btn btn-sm btn-info " id="btn_buscar_socio_solicitudes_despacho" data-toogle="tooltrip" data-placement="top" title="Buscar" ><i class="fas fa-search"></i> </a>      
                            </div>
                        </div>

                        
                    </div>

                    <div class="row mtop16">
                        <div class="col-6">
                            <label for="name"> <strong> Solicitudes de Despacho: </strong></label>
                            <div class="input-group">           
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="id_solicitud" id="id_solicitud" style="width: 90%" >
                                    <option value=""></option>
                                    
                                </select>             
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="name"> <strong>No. Reporte a visualizar: </strong></label>
                            <div class="input-group">           
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="num_reporte"  style="width: 90%" >
                                    @for($i=1; $i <= 17; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>       
                            </div>
                        </div>

                        
                    </div>

                    {!! Form::submit('Generar', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>


    </div>
</div>
@endsection