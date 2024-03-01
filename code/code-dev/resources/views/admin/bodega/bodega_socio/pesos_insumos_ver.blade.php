@extends('admin.plantilla.master')
@section('title','Pesos Alimento')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/insumos') }}"><i class="fa-solid fa-wheat-awn"></i> Insumos</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/insumos') }}"><i class="fa-solid fa-wheat-awn"></i> Pesos Alimento</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-wheat-awn"></i> Acciones de los Pesos de: </strong>{{ $insumo->nombre }}</h2>
                </div>

                <div class="card-body">
                    
                   <strong><i class="fa-solid fa-angles-right"></i> Gramos por libra: </strong> {{ $pesos_guardados->gramos_x_libra }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Gramos por Kg: </strong> {{ $pesos_guardados->gramos_x_kg }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Libras por KG: </strong> {{ $pesos_guardados->libras_x_kg }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Kilogramos por unidad (Caneca/Saco): </strong> {{ $pesos_guardados->kg_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Gramos x unidad: </strong> {{ $pesos_guardados->gramos_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Libras Netas por Unidad: </strong> {{ $pesos_guardados->libras_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Quintales x unidad:  </strong> {{ $pesos_guardados->quintales_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Peso bruto en quintales: </strong> {{ $pesos_guardados->peso_bruto_quintales }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Tonelada Metrica Kg: </strong> {{ $pesos_guardados->tonelada_metrica_kg }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Unidades por TM:  </strong> {{ $pesos_guardados->unidades_x_tm }} <br> 
                   
                </div>

            </div>                
        </div>

    </div>

</div>

@endsection