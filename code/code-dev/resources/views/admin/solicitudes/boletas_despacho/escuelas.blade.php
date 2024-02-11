@extends('admin.plantilla.master')
@section('title','Desgloce de Rutas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')
@php($total_raciones = 0)
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            @include('admin.solicitudes.boletas_despacho.vistas.menu_escuelas')
        </div>

        <div class="col-md-8">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-school"></i> Desgloce de Despacho</strong>   </h2>
                    
                </div>

                <div class="card-body" style="text-align:center;">  
                    <strong>Seleccione una escuela para visualizar su despacho(s)</strong>
                </div> 

                <div class="card-footer clearfix">

                </div>

            </div>
        </div>       
    </div>
</div>

@endsection