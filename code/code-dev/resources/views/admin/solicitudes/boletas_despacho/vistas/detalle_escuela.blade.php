

        @if(count($despachos) > 0)  
            @foreach($despachos as $d)   
                <div class="card ">

                    <div class="card-header">                
                        <h4 class="card-title"><strong><i class="fa-solid fa-school"></i> Desgloce de Despacho: </strong></h4>
                    </div>

                    <div class="card-body " style="text-align:center;  overflow-y: scroll; line-height: 1em; height:325px;">    
                                                    
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Registro: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('codigo', $d->fecha, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo de Documento: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::select('tipo_documento', ['0'=>'Boleta de Despacho','1'=>'Otros'],$d->no_documento,['class'=>'form-select', 'readonly']) !!}
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> No. Documento: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->no_documento, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> ID Solicitud: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->id_solicitud_despacho, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Correspondiente A: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', obtenerMeses(null, $d->solicitud->entrega->mes_inicial).' - '.obtenerMeses(null, $d->solicitud->entrega->mes_final).' '.$d->solicitud->entrega->year, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Racion Tipo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->racion->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            
                        </div>

                        <hr>
                        <div class="row mtop16">
                            <h5><strong>Información de la Escuela</strong></h5>
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Codigo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->escuela->codigo, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->escuela->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Responsable: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->escuela->director, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Municipio: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->escuela->ubicacion->nombre, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Ruta: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('codigo', $d->escuela->ruta_asignada->ruta->ubicacion->nomenclatura.'0'.$d->escuela->ruta_asignada->ruta->correlativo, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row mtop16">
                            <h5><strong>Detalle de Despacho</strong></h5>
                            <table  class="table table-striped table-hover mtop16">
                                <thead>
                                    <tr>
                                        <td><strong> PRODUCTO </strong></td>
                                        <td><strong> P/L </strong></td>
                                        <td><strong> RACION </strong></td>
                                        <td><strong> TOTAL EN LIBRAS/LITROS </strong></td>
                                        <td><strong> TOTAL EN SACO/CANECAS </strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($d->detalles as $det)
                                        <tr>
                                            <td>{{ $det->alimento_bodega_socio->nombre}}</td>
                                            <td>{{ $det->pl}}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $det->no_unidades}}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="row mtop16">
                            <div class="col-md-3 mtop16">
                                <a href="{{ url('/admin/solicitud_despacho/'.$d->id_solicitud_despacho.'/escuela/'.$d->id_escuela_despacho.'/despacho/'.$d->id.'/impresion') }}" target="_blank" class="btn btn-sm btn-info"><i class="fa-solid fa-print"></i> Imprimir en Boleta</a>
                            </div>
                        </div>
                            
                        

                    </div> 
                </div>
                <br>
            @endforeach
                                
        @else
            <div class="card ">

                <div class="card-header">                
                    <h2 class="card-title"><strong><i class="fa-solid fa-school"></i> Desgloce de Despacho: </strong></h2>

                </div>

                <div class="card-body " style="text-align:center;  overflow-y: scroll; line-height: 1em; height:325px;">  
                    <b style="color: red;">Escuela sin despacho(s), realice un egreso a esta escuela primero ó verifique los datos.</b>
                </div> 
            </div>
        @endif

    