@extends('admin.plantilla.master')
@section('title','Editar Escuela')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            @include('admin.solicitudes.detalles.vista_desgloce.menu_rutas')
        </div>

        <div class="col-md-10">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fa-solid fa-road-circle-exclamation"></i><strong> Desgloce de la Ruta</strong>   </h2>
                    
                </div>

                <div class="card-body" style="text-align:center;">  
                    <strong>Seleccione una ruta para visualizar su detalle</strong>
                </div> 

                <div class="card-footer clearfix">

                </div>

            </div>
        </div>


        

    </div>

    
</div>

@endsection