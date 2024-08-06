<div class="col-md-3">
    <div class="card ">

        <div class="card-header">
            <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Administración de la Ruta</strong>   </h2>
            
        </div>

        <div class="card-body" >  
            @if($tipo_ruta == 2)
                <div class="card ">

                    <div class="card-header">
                        <h2 class="title"><strong><i class="fa-solid fa-folder"></i> Confirmar Ruta Sin Dividir</strong>   </h2>
                        
                    </div>

                    <div class="card-body" >  
                    {!! Form::open(['url' => '/admin/solicitud_despacho/confirmar_ruta/sin_division', 'files' => true]) !!}
                        {!! Form::hidden('id_solicitud', $idSolicitud, ['class'=>'form-control']) !!}
                        {!! Form::hidden('ruta_base', $ruta->id, ['class'=>'form-control']) !!}
                        {!! Form::hidden('nombre_ruta_solicitud', $ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo, ['class'=>'form-control']) !!}
                    
                    

                        {!! Form::submit('Confirmar', ['class'=>'btn btn-info mtop16']) !!}

                    {!! Form::close() !!}

                    

                    </div> 

                </div>
            @endif
            <hr>
            @if($tipo_ruta == 2 || $tipo_ruta == 1 )
                <div class="card ">

                    <div class="card-header">
                        <h2 class="title"><strong><i class="fa-solid fa-folder-tree"></i> Crear Sub-Ruta</strong>   </h2>
                        
                    </div>

                    <div class="card-body" >  
                        {!! Form::open(['url' => '/admin/solicitud_despacho/crear_subruta', 'files' => true]) !!}       
                            {!! Form::hidden('id_solicitud', $idSolicitud, ['class'=>'form-control']) !!}                     
                            {!! Form::hidden('ruta_base', $ruta->id, ['class'=>'form-control']) !!}
                            {!! Form::hidden('nombre_ruta_solicitud', $ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo, ['class'=>'form-control']) !!}

                            

                            {!! Form::submit('Crear', ['class'=>'btn btn-info mtop16']) !!}

                        {!! Form::close() !!}

                    </div> 

                </div>
            @endif

        </div> 

        <div class="card-footer clearfix">

        </div>

    </div>
</div>

<div class="col-md-9">
    <div class="card ">

        <div class="card-header">
            <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Distribución de la Ruta</strong>   </h2>
            
        </div>

        <div class="card-body" >  
            @if($tipo_ruta == 0 )
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="title"><strong><a href="#" data-action="eliminar" data-path="admin/solicitud_despacho_ruta_confirmada" data-object="{{ $ruta_despacho->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a> Listado de Escuelas - Ruta Confirmada Sin Division</strong>   </h2>
                            </div>

                            <div class="card-body">
                                <table id="tabla" class="table table-striped table-hover mtop16">
                                    <thead>
                                        <tr>
                                            <td><strong> ESCUELA</strong></td>
                                            <td><strong> ORDEN</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($ruta_despacho->detalles as $det)
                                            <tr>
                                                <td>{{ $det->escuela->codigo.' / '.$det->escuela->nombre}}</td>
                                                <td>
                                                    {!! Form::open(['url' => '/admin/solicitud_despacho/sub_rutas/actualizar_orden']) !!}
                                                        <div class="col-md-6">
                                                            <div class="input-group"> 
                                                                {!! Form::hidden('id_asignacion', $det->id, ['class'=>'form-control']) !!}
                                                                {!! Form::number('orden', $det->orden_llegada, ['class'=>'form-control', 'min'=>'1']) !!}
                                                                {{ Form::button('<i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-sm', 'type' => 'submit']) }}
                                                            </div>
                                                        </div> 
                                                        
                                                    {!! Form::close() !!}  
                                                
                                                </td>
                                            </tr>
                                        @endforeach                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($tipo_ruta == 1 )
                <div class="row">
                    <div class="col-md-4">
                        <div class="card ">

                            <div class="card-header">
                                <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Agregar Escuela a la Sub-Ruta</strong>   </h2>
                                
                            </div>

                            <div class="card-body" >  
                                {!! Form::open(['url' => '/admin/solicitud_despacho/asignar_escuela_sub_ruta', 'files' => true]) !!}                            
                                    
                                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Sub-Ruta: </strong></label>
                                        <div class="input-group">           
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            <select name="id_sub_ruta_despacho" id="id_ubicacion" style="width: 90%" >
                                                @foreach($sub_rutas as $s)
                                                    <option value=""></option>
                                                    <option value="{{ $s->id }}">{{ $s->nombre}}</option>
                                                @endforeach
                                            </select>            
                                        </div>

                                        <label for="name" class="mtop16"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Escuela: </strong></label>
                                        <div class="input-group">           
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            <select name="id_escuela" id="id_escuela" style="width: 90%" >
                                                @foreach($escuelas as $e)
                                                    <option value=""></option>
                                                    <option value="{{ $e->id }}">{{ $e->id.' - '.$e->codigo.' - '.$e->nombre}}</option>
                                                @endforeach
                                            </select>            
                                        </div>

                                        <label for="name " class="mtop16"> <strong>Orden de Llegada en la Sub Ruta: </strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {!! Form::number('orden_llegada', 1, ['class'=>'form-control', 'min'=>'1']) !!}
                                        </div>

                                    {!! Form::submit('Asignar', ['class'=>'btn btn-info mtop16']) !!}

                                {!! Form::close() !!}
                            </div> 

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="title"><strong><i class="fa-solid fa-gears"></i> Listado de Sub-Rutas</strong>   </h2>
                            </div>

                            <div class="card-body">
                                @foreach($sub_rutas as $s)
                                    <p><a href="#" data-action="eliminar" data-path="admin/solicitud_despacho_sub_ruta" data-object="{{ $s->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a><b> Sub Ruta: </b> {{ $s->nombre}}  </p>
                                    <table class="table table-striped table-hover mtop16">
                                        <thead>
                                            <tr>
                                                <td><strong> ESCUELA</strong></td>
                                                <td><strong> ORDEN LLEGADA</strong></td>
                                                <td><strong> PESO QUINTALES</strong></td>
                                                
                                            </tr>
                                        </thead>
                                        @php($total_peso_ruta = 0)
                                        @foreach($s->detalles as $det)
                                            <tbody> 
                                                <tr>
                                                    <td> <a href="#" data-action="eliminar" data-path="admin/solicitud_despacho_escuela_sub_ruta" data-object="{{ $det->id }}" class="btn-eliminar" data-toogle="tooltrip" data-placement="top" title="Eliminar" ><i class="fa-solid fa-trash-can"></i></a>  {{ $det->escuela->codigo.' / '.$det->escuela->nombre }}</td>
                                                    <td>
                                                        {!! Form::open(['url' => '/admin/solicitud_despacho/sub_rutas/actualizar_orden']) !!}
                                                            <div class="col-md-6">
                                                                <div class="input-group"> 
                                                                    {!! Form::hidden('id_asignacion', $det->id, ['class'=>'form-control']) !!}
                                                                    {!! Form::number('orden', $det->orden_llegada, ['class'=>'form-control', 'min'=>'1']) !!}
                                                                    {{ Form::button('<i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-sm', 'type' => 'submit']) }}
                                                                </div>
                                                            </div> 
                                                        
                                                        {!! Form::close() !!}  
                                                    </td>
                                                    @php($total_peso_escuela = 0)   
                                                    @foreach($detalle_escuelas as $det_esc)
                                                        @if($det->escuela->id == $det_esc->escuela_id)
                                                            @php($total_peso_escuela = $total_peso_escuela + ($det_esc->peso/453.59237)/100  ) 
                                                        @endif
                                                    @endforeach
                                                    <td> {{number_format(  $total_peso_escuela , 2, '.', ',' ) }}</td>
                                                    @php($total_peso_ruta = $total_peso_ruta + $total_peso_escuela)
                                                </tr>
                                            </tbody>                                            
                                        @endforeach
                                        <tbody>
                                            <b style="color: blue;">Peso Total Quintales: </b> {{number_format(  $total_peso_ruta, 2, '.', ',' ) }}
                                        </tbody>
                                    </table> 
                                    <hr>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
        </div> 

        <div class="card-footer clearfix">

        </div>

    </div>
</div>