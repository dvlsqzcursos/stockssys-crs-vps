@extends('admin.plantilla.master')
@section('title','Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Solicitud de Despacho</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Registrar Solicitud de Despacho</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-users"></i> Validación de Información Importada</strong></h2>
                </div>

                <div class="card-body">

                    <table id="tabla-carga-datos" class="table table-striped table-hover display nowrap mtop16" width="100%">
                        <thead style="font-size: 1em; " >
                            <tr>
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
                            @php($total_estudiantes = 0)
                            @php($total_raciones_estudiantes = 0)
                            @php($total_docentes_voluntarios = 0)
                            @php($total_raciones_docentes_voluntarios = 0)
                            @foreach($resultados as $r)
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($r['fecha_de_solicitud'])) }}</td>
                                    <td>{{ $r['municipio_de_la_escuela'] }}</td>
                                    <td>{{ $r['jornada_de_la_escuela'] }}</td>
                                    <td>{{  $r['codigo_de_la_escuela'] }}</td>
                                    <td>{{ $r['nombre_de_la_escuela'] }}</td>
                                    <td>{{ $r['direccion_de_la_escuela'] }}</td>
                                    <td>{{ $r['mes_de_solicitud'] }}</td>
                                    @if( $r['dias_de_solicitud'] <= $entrega->dias_a_cubrir ) 
                                        <td>{{ $r['dias_de_solicitud'] }}</td> 
                                    @else 
                                        <td style="color: red;">{{ $r['dias_de_solicitud'] }}</td>
                                    @endif
                                    <td>{{ $r['ruta'] }}</td>
                                    <td>{{ $r['ninas_pre_primaria_a_tercero_primaria'] > 0 ? $r['ninas_pre_primaria_a_tercero_primaria'] : 0 }} </td>
                                    <td>{{ $r['ninos_pre_primaria_a_tercero_primaria'] > 0 ? $r['ninos_pre_primaria_a_tercero_primaria'] : 0 }}</td>
                                    <td>{{ $r['total_pre_primaria_a_tercero_primaria'] > 0 ? $r['total_pre_primaria_a_tercero_primaria'] : 0 }}</td>
                                    <td>{{ $r['ninas_cuarto_a_sexto'] > 0 ? $r['ninas_cuarto_a_sexto'] : 0 }} </td>
                                    <td>{{ $r['ninios_cuarto_sexto'] > 0 ? $r['ninios_cuarto_sexto'] : 0 }}</td>
                                    <td>{{ $r['total_cuarto_a_sexto'] > 0 ? $r['total_cuarto_a_sexto'] : 0 }}</td>
                                    <td>
                                        {{ $r['total_de_estudiantes'] > 0 ? $r['total_de_estudiantes'] : 0 }} 
                                        @php($total_estudiantes += $r['total_de_estudiantes']) 
                                    </td>
                                    <td>
                                        {{ $r['total_de_raciones_de_estudiantes'] > 0 ? $r['total_de_raciones_de_estudiantes'] : 0 }}
                                        @php($total_raciones_estudiantes += $r['total_de_raciones_de_estudiantes']) 
                                    </td>
                                    <td>{{ $r['total_docentes'] > 0 ? $r['total_docentes'] : 0 }}</td>
                                    <td>{{ $r['total_voluntarios'] > 0 ? $r['total_voluntarios'] : 0 }}</td>
                                    <td>
                                        {{ $r['total_de_docentes_y_voluntarios'] > 0 ? $r['total_de_docentes_y_voluntarios'] : 0 }}
                                        @php($total_docentes_voluntarios += $r['total_de_docentes_y_voluntarios'])
                                    </td>
                                    <td>
                                        {{ $r['total_de_raciones_de_docentes_y_voluntarios'] > 0 ? $r['total_de_raciones_de_docentes_y_voluntarios'] : 0 }}
                                        @php($total_raciones_docentes_voluntarios += $r['total_de_raciones_de_docentes_y_voluntarios'])
                                    </td>
                                    <td>{{ $r['total_de_personas'] > 0 ? $r['total_de_personas'] : 0 }}</td>
                                    <td>{{ $r['total_de_raciones'] > 0 ? $r['total_de_raciones'] : 0 }}</td>
                                    <td>{{ $r['tipo_de_actividad_alimentos'] > 0 ? $r['tipo_de_actividad_alimentos'] : 0 }}</td>
                                    <td>{{ $r['numero_de_entrega'] > 0 ? $r['numero_de_entrega'] : 0 }}</td>
                                    <td>{{ $r['tipo'] > 0 ? $r['tipo'] : 0 }}</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <span><strong>Total de Estudiantes: </strong> {{ number_format($total_estudiantes) }}</span> 
                    <span><strong>Total de Raciones Estudiantes: </strong> {{ number_format($total_raciones_estudiantes) }}</span> 
                    <span><strong>Total de Docentes y Voluntarios: </strong> {{ number_format($total_docentes_voluntarios) }}</span> 
                    <span><strong>Total de Raciones Docentes y Voluntarios: </strong> {{ number_format($total_raciones_docentes_voluntarios) }}</span> 
                    {!! Form::open(['url' => '/admin/solicitud_despacho/guardar_datos', 'files' => true]) !!}
                        
                        {!! Form::submit('Cargar Datos', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection