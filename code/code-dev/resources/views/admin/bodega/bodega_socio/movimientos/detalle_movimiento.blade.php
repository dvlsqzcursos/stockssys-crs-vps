@extends('admin.plantilla.master')
@section('title','Bodega Socio')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Socio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/inventario') }}"><i class="fa-solid fa-calculator"></i> Inventario</a></li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">  

        <div class="col-md-12">  

            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Detalle de Movimiento</strong></h2>
                </div>

                <div class="card-body">
                    
                </div>

            </div>                
        </div>
        

        
    </div>

</div>

@endsection