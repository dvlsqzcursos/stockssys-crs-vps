@extends('admin.plantilla.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/reportes') }}"><i class="fa-solid fa-file-lines"></i> Reportes</a></li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Exportar Reporte</strong></h2>
                </div>

                <div class="card-body">
                    <a href="{{ url('/admin/reporte/exportar/pdf/'.$idSolicitud.'/'.$idSocio.'/'.$numReporte) }}" class="btn btn-outline-danger col-12"><i class="fa-solid fa-file-pdf"></i> PDF</a>
                    <a href="{{ url('/admin/bodega_socio/insumos') }}" class="btn btn-outline-success col-12 mtop16"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    
                </div>

            </div>
            
        </div>

        <div class="col-md-10">
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-plus-circle"></i><strong> Generar Reporte</strong></h2>
                    <ul>                                             
                        <li>
                            <a href="{{ url('/admin/reporte/panel') }}" ><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
                        </li>
                    </ul>
                </div> 

                <div class="card-body">
                    <b>Total de Escuelas Atendidas @if(isset($solicitud1) ) Pre Primaria a 3ro Primaria @endif : </b>
                    @foreach($total_escuelas as $t)
                         {{$t->total}}

                    @endforeach
                    <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
                    @foreach($solicitud as $s)
                        <b>{{$loop->iteration.'. '.$s->escuela_nombre}}</b> - @if(isset($s->total_estudiantes) ) <b>Total de Estudiantes Atendidos: </b> {{$s->total_estudiantes}} -  @endif  <b>Tipo Ración:</b> {{$s->racion}}  <br>
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

                            @foreach($alimentos as $a)
                            @if($s->escuela_id == $a->escuela_id && $s->racion == $a->racion)
                                <tr>
                                    <td>{{$a->insumo}}</td>
                                    <td></td>
                                    <td>{{$a->cantidad}}</td>
                                    <td></td>
                                </tr>

                            @endif
                        @endforeach

                            </tbody>
                        </table>
                        
                        <hr>
                    @endforeach

                    @if(isset($solicitud1) )
                        <b>Total de Escuelas Atendidas 4to Primaria a 6to Primaria: </b>
                        @foreach($total_escuelas1 as $t1)
                            {{$t1->total}}

                        @endforeach
                        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
                        @foreach($solicitud1 as $s1)
                            <b>{{$loop->iteration.'. '.$s1->escuela_nombre}}</b> - @if(isset($s1->total_estudiantes) ) <b>Total de Estudiantes Atendidos: </b> {{$s1->total_estudiantes}} -  @endif  <b>Tipo Ración:</b> {{$s1->racion}}  <br>
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

                                @foreach($alimentos1 as $a1)
                                @if($s1->escuela_id == $a1->escuela_id && $s1->racion == $a1->racion)
                                    <tr>
                                        <td>{{$a1->insumo}}</td>
                                        <td></td>
                                        <td>{{$a1->cantidad}}</td>
                                        <td></td>
                                    </tr>

                                @endif
                            @endforeach

                                </tbody>
                            </table>
                            
                            <hr>
                        @endforeach
                    @endif

                    
                    
                </div>

            </div>
            
        </div>


    </div>

    
</div>
@endsection