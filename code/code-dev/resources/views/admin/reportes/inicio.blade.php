@extends('admin.plantilla.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/reportes') }}"><i class="fa-solid fa-file-lines"></i> Reportes</a></li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Generar Reporte</strong></h2>
                </div>

                <div class="card-body">
                    <a href="{{ url('/admin/reporte/panel') }}" class="btn btn-secondary mtop16">Ir Panel</a>
                </div>

            </div>
            
        </div>

        <div class="col-md-6">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Informe Mensual</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/reporte/informe_mensual', 'files' => true]) !!}

                        {!! Form::submit('Generar', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>
@endsection