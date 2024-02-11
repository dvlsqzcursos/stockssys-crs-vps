@extends('admin.plantilla.master')
@section('title','Inicio de Solicitud')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Solicitud de Despacho</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Registrar Solicitud de Despacho</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2 col-md-2 d-flex">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Controles de Solicitud</strong></h2>
                    
                </div>

                <div class="card-body">              
                    <div class="d-grid gap-2  ">
                        <a class="btn btn-outline-primary" style=" word-break: break-all; " href="{{ url('/admin/solicitudes_despachos') }}"  title="Editar"><i class="fa-solid fa-arrow-rotate-left"></i> Regresar</a>
                        @if(kvfj(Auth::user()->permisos, 'solicitud_rutas'))
                            <a class="btn btn-outline-primary" style=" word-break: break-all; " href="{{ url('/admin/solicitud_despacho/'.$solicitud->id.'/rutas') }}"  title="Editar"><i class="fa-solid fa-road-circle-exclamation"></i> Administracion Rutas</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'solicitud_rutas_confirmadas'))
                            <a class="btn btn-outline-primary" style=" word-break: break-all; " href="{{ url('/admin/solicitud_despacho/'.$solicitud->id.'/rutas_confirmadas') }}"  title="Editar"><i class="fa-solid fa-eye"></i> Rutas Confirmadas</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'solicitud_solicitud_primaria'))
                            <a class="btn btn-outline-primary" style=" word-break: break-all; " href="{{ url('/admin/solicitud_despacho/'.$solicitud->id.'/solicitud_bodega_primaria') }}"  title="Editar"><i class="fa-solid fa-file-circle-exclamation"></i> Solicitud A Bodega</a>
                        @endif
                        @if(kvfj(Auth::user()->permisos, 'solicitud_escuelas'))
                            <a class="btn btn-outline-primary" style=" word-break: break-all; " href="{{ url('/admin/solicitud_despacho/'.$solicitud->id.'/escuelas') }}"  title="Editar"><i class="fa-solid fa-file-circle-exclamation"></i> Boletas de Despacho</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-10">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Carga De Datos Para Solicitud De Despacho</strong></h2>
                    
                </div>

                <div class="card-body">
                    

                        <div class="row">
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> ID Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('id_solicitud', $solicitud->id, ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Inicio de Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('fecha', $solicitud->created_at, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Entrega A Procesar: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('entrega', obtenerMeses(null, $solicitud->entrega->mes_inicial).' / '.obtenerMeses(null, $solicitud->entrega->mes_final), ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Días A Cubrir En Esta Entrega: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('entrega', $solicitud->entrega->dias_a_cubrir, ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Usuario Que Inicia La Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('usuario', $solicitud->usuario->nombres.' '.$solicitud->usuario->apellidos, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>    
                            
                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong> Observaciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('observaciones', $solicitud->observaciones, ['class'=>'form-control','rows'=>'2', 'readonly']) !!}
                                </div>
                            </div>
                        </div>


                        

                
                </div>

            </div>            
        </div>

    </div>

    <div class="row mtop16">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-file-excel"></i> Información Importada Del Archivo:</strong> {{$solicitud->nombre_archivo}}</h2>
                    <ul>      
                        @if(kvfj(Auth::user()->permisos, 'solicitud_detalle_registrar'))                 
                            <li><a href="{{ url('/admin/solicitud_despacho/detalles/'.$solicitud->id.'/registrar') }}" ><i class="fas fa-plus-circle"></i> Registrar</a></li>
                        @endif
                    </ul>
                </div>

                <div class="card-body">

                    <table id="tabla-carga-datos" class="table table-striped table-hover display nowrap mtop16" width="100%">
                        <thead style="font-size: 1em; " >
                            <tr>
                                <td ><strong> OPCIONES</strong></td>
                                <td ><strong> FECHA SOLICITUD</strong></td>
                                <td ><strong> MUNICIPIO ESCUELA </strong></td>
                                <td ><strong> JORNADA ESCUELA </strong></td>
                                <td ><strong> CODIGO ESCUELA </strong></td>
                                <td ><strong> NOMBRE ESCUELA </strong></td>
                                <td ><strong> DIRECCION ESCUELA</strong></td>
                                <td ><strong> MES SOLICITUD </strong></td>
                                <td ><strong> DIAS DE SOLICITUD </strong></td>
                                <td ><strong> RUTA </strong></td>
                                <td ><strong> NIÑAS PRE PRIMARIA A TERCERO PRIMARIA </strong></td>
                                <td ><strong> NIÑOS PRE PRIMARIA A TERCERO PRIMARIA </strong></td>
                                <td ><strong> TOTAL NIÑOS PRE PRIMARIA A TERCERO PRIMARIA </strong></td>
                                <td ><strong> NIÑAS CUARTO A SEXTO PRIMARIA </strong></td>
                                <td ><strong> NIÑOS CUARTO A SEXTO PRIMARIA </strong></td>
                                <td ><strong> TOTAL NIÑOS CUARTO A SEXTO PRIMARIA </strong></td>
                                <td ><strong> TOTAL DE ESTUDIANTES </strong></td>
                                <td ><strong> TOTAL DE RACIONES DE ESTUDIANTES </strong></td>
                                <td ><strong> TOTAL DOCENTES </strong></td>
                                <td ><strong> TOTAL VOLUNTARIOS </strong></td>
                                <td ><strong> TOTAL DE DOCENTES Y VOLUNTARIOS </strong></td>
                                <td ><strong> TOTAL DE RACIONES DE DOCENTES Y VOLUNTARIOS </strong></td>
                                <td ><strong> TOTAL PERSONAS </strong></td>
                                <td ><strong> TOTAL DE RACIONES </strong></td>
                                <td ><strong> TIPO DE ACTIVIDAD ALIMENTOS </strong></td>
                                <td ><strong> NUMERO DE ENTREGA </strong></td>
                                <td ><strong> TIPO </strong></td>


                        </thead>
                        <tbody>
                            
                            @foreach($solicitud->detalles as $sd)
                                <tr>
                                    <td width="240px">
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permisos, 'solicitud_detalle_editar'))
                                                <a href="{{ url('/admin/solicitud_despacho/detalles/'.$sd->id.'/editar') }}"  title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permisos, 'solicitud_detalle_eliminar'))
                                                <a href="#" data-action="eliminar" data-path="admin/solicitud_despacho/detalles" data-object="{{ $sd->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> 
                                            @endif
                                        </div>
                                    </td>
                                    <td> {{ Carbon\Carbon::parse($sd->fecha)->format('d/m/Y') }} </td>
                                    <td>{{$sd->escuela->ubicacion->nombre}}</td>
                                    <td>{{$sd->escuela->jornada === 0 ? "Matutina" : "Vespertina"}} </td>
                                    <td>{{$sd->escuela->codigo}}</td>
                                    <td>{{$sd->escuela->nombre}}</td>
                                    <td>{{$sd->escuela->direccion}}</td>
                                    <td>{{$sd->mes_de_solicitud}}</td>
                                    <td>{{$sd->dias_de_solicitud}}</td>
                                    <td>
                                        @if($sd->escuela->ruta_asignada)
                                            {{$sd->escuela->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$sd->escuela->ruta_asignada->ruta->correlativo}}
                                        @else
                                            Sin Asignar
                                        @endif
                                    </td>
                                    <td>{{$sd->ninas_pre_primaria_a_tercero_primaria}}</td>
                                    <td>{{$sd->ninos_pre_primaria_a_tercero_primaria}}</td>
                                    <td>{{$sd->total_pre_primaria_a_tercero_primaria}}</td>
                                    <td>{{$sd->ninas_cuarto_a_sexto}}</td>
                                    <td>{{$sd->ninos_cuarto_a_sexto}}</td>
                                    <td>{{$sd->total_cuarto_a_sexto}}</td>
                                    <td>{{$sd->total_de_estudiantes}}</td>
                                    <td>{{$sd->total_de_raciones_de_estudiantes}}</td>
                                    <td>{{$sd->total_docentes}}</td>
                                    <td>{{$sd->total_voluntarios}}</td>
                                    <td>{{$sd->total_de_docentes_y_voluntarios}}</td>
                                    <td>{{$sd->total_de_raciones_de_docentes_y_voluntarios}}</td>
                                    <td>{{$sd->total_de_personas}}</td>
                                    <td>{{$sd->total_de_raciones}}</td>
                                    <td>{{$sd->racion->tipo_alimentos}}</td>
                                    <td>{{$sd->numero_de_entrega}}</td>
                                    <td>{{$sd->tipo}}</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="row">
                        <div class="col-md-2">
                            <span for="name" style="font-size: 0.8125em"><strong>TOTAL ESTUDIANTES: </strong> <br> {{number_format($total_estudiantes)}}</span>                            
                        </div>  

                        <div class="col-md-2">
                            <span for="name" style="font-size: 0.8125em"><strong>TOTAL RACIONES ESTUDIANTES: </strong> <br> {{number_format($total_raciones_estudiantes)}}</span>                            
                        </div>  

                        <div class="col-md-2">
                            <span for="name" style="font-size: 0.8125em"><strong>TOTAL DOCENTES Y VOLUNTARIOS: </strong> <br> {{number_format($total_docentes_voluntarios)}}</span>                            
                        </div>  

                        <div class="col-md-2">
                            <span for="name" style="font-size: 0.8125em"><strong>TOTAL RACIONES DOCENTES Y VOLUNTARIOS: </strong> <br> {{number_format($total_raciones_docentes_voluntarios)}}</span>                            
                        </div>  

                        <div class="col-md-2">
                            <span for="name" style="font-size: 0.8125em"><strong>TOTAL PERSONAS: </strong> <br> {{number_format($total_personas)}}</span>                            
                        </div>  

                        <div class="col-md-2">
                            <span for="name" style="font-size: 0.8125em"><strong>TOTAL RACIONES: </strong> <br> {{number_format($total_raciones)}}</span>                            
                        </div>  
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection