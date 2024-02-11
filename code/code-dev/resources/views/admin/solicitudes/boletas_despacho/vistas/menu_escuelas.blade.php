<div class="card ">

    <div class="card-header">
        <h2 class="title"><i class="fa-solid fa-school"></i><strong> Listado de Escuelas</strong></h2>
        
    </div>

    <div class="card-body" style="overflow-y: scroll; line-height: 1em; height:395px;">              
        <div class="d-grid gap-2">
            <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/mostrar') }}"  title="Editar"><i class="fa-solid fa-arrow-rotate-left"></i> Regresar</a>
            @foreach($escuelas_principales as $ep)
                <a class="btn btn-outline-primary" href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/escuela/'.$ep->id) }}"  title="Editar"><i class="fa-solid fa-school"></i> {{$ep->codigo.'-'.$ep->nombre}}</a>
            @endforeach

            
        </div>
    </div>

</div>