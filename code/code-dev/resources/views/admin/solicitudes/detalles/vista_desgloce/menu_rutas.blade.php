<div class="card ">

    <div class="card-header">
        <h2 class="title"><i class="fa-solid fa-road-circle-exclamation"></i><strong> Listado de Rutas</strong></h2>
        
    </div>

    <div class="card-body" style="overflow-y: scroll; line-height: 1em; height:395px;">              
        <div class="d-grid gap-2">
            <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/mostrar') }}"  title="Editar"><i class="fa-solid fa-arrow-rotate-left"></i> Regresar</a>
            @foreach($rutas_principales as $rp)
                <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/ruta/'.$rp->id) }}"  title="Editar"><i class="fa-solid fa-road-circle-exclamation"></i> {{$rp->ubicacion->nomenclatura.'0'.$rp->correlativo}}</a>
            @endforeach

            
        </div>
    </div>

</div>