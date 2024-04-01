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
                    <a href="{{ url('/admin/reporte/exportar/pdf/formato1/'.$idSolicitud.'/'.$idSocio.'/'.$numReporte) }}" target="_blank" class="btn btn-outline-danger col-12"><i class="fa-solid fa-file-pdf"></i> PDF</a>
                    <a href="{{ url('/admin/reporte/exportar/excel/'.$idSolicitud.'/'.$idSocio.'/'.$numReporte) }}" class="btn btn-outline-success col-12 mtop16"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    
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
                    <div style="text-align: center;">
                        <h2>
                            Reporte No. {{$numReporte}} - StocksSys 
                            
                        </h2>    
                        <b>Descripción: </b> {{ obtenerDescripcionReportes(null, $numReporte) }}
                    </div>

                    <div class="col-md-12">
                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> No. de Solicitud: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('idSolicitud', $solicitud->id, ['class'=>'form-control', 'id' =>'idSolicitud', 'readonly']) !!}
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños preprimaria: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_ninos_pre', $total_ninos_pre, ['class'=>'form-control', 'id' =>'total_ninos_pre', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niñas preprimaria: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_ninas_pre', $total_ninas_pre, ['class'=>'form-control', 'id' =>'total_ninas_pre', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños y niñas preprimaria: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_pri', $total_pri, ['class'=>'form-control', 'id' =>'total_pri', 'readonly']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-4">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños primaria: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_ninos_pri', $total_ninos_pri, ['class'=>'form-control', 'id' =>'total_ninos_pri', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niñas primaria: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_ninas_pri', $total_ninas_pri, ['class'=>'form-control', 'id' =>'total_ninas_pri', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños y niñas primaria: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_pri', $total_pri, ['class'=>'form-control', 'id' =>'total_pri', 'readonly']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-6">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Docente y Voluntarios: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_d_v', $total_d_v, ['class'=>'form-control', 'id' =>'total_d_v', 'readonly']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Lideres: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('total_l', $total_l, ['class'=>'form-control', 'id' =>'total_l', 'readonly']) !!}
                            </div>
                        </div>
                    </div>


                    
                    
                </div>

            </div>
            
        </div>


    </div>

    
</div>
@endsection