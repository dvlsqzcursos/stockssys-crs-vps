@extends('admin.plantilla.master')
@section('title','Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
<li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Validación de Importaciones</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-users"></i> Validación de Información Importada</strong></h2>
                </div>

                <div class="card-body">

                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                <td><strong> CODIGO </strong></td>
                                <td><strong> NOMBRE </strong></td>
                                <td><strong> DIRECCION </strong></td>
                                <td><strong> UBICACION </strong></td>
                                <td><strong> DIRECTOR </strong></td>
                        </thead>
                        <tbody>
                            @foreach($resultados as $r)
                                <tr>
                                    <td>
                                        {!! Form::text('codigo', $r['codigo'], ['class'=>'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('nombre', $r['nombre'], ['class'=>'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('direccion', $r['direccion'], ['class'=>'form-control']) !!}
                                    </td>
                                    <td>
                                        <select name="id_ubicacion" id="id_ubicacion" style="width: 95%" >
                                            @foreach($ubicaciones as $u)
                                                @if($u->id == $r['id_ubicacion'])
                                                    <option value="{{ $u->id }}" selected>{{ $u->nombre.' / '.$u->ubicacion_superior->nombre.' / '.$u->ubicacion_superior->ubicacion_superior->nombre }}</option>
                                                @else
                                                    <option value="{{ $u->id }}">{{ $u->nombre.' / '.$u->ubicacion_superior->nombre.' / '.$u->ubicacion_superior->ubicacion_superior->nombre }}</option>
                                                @endif                                               
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {!! Form::text('director', $r['director'], ['class'=>'form-control']) !!}
                                    </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection