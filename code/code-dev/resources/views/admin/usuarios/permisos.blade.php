@extends('admin.plantilla.master')
@section('title','Permisos de Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}"><i class="fa-solid fa-users"></i> Usuarios</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/usuario/'.$usuario->id.'/permisos') }}"><i class="fa-solid fa-users"></i> Permisos de Usuario: {{ $usuario->usuario}}</a></li>
@endsection

@section('content')

<div class="container-fluid">
    {!! Form::open(['url' => '/admin/usuario/'.$usuario->id.'/permisos', 'files' => true]) !!}
        <div class="row">
            
            @foreach(permisosUsuario() as $key => $value)
                <div class="col-md-4 d-flex mtop16">
                    <div class="card ">
                    
                        <div class="card-header">
                            <h2 class="title"><strong> {!! $value['icon'] !!} {{ $value['title']}} </strong></h2>
                            
                        </div>

                        <div class="card-body">
                            

                                @foreach($value['keys'] as $k => $v)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="{{ $k }}" @if(kvfj($usuario->permisos, $k)) checked @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $v }}
                                        </label>
                                    </div>
                                @endforeach

                                

                            
                        </div>

                    </div>
                    
                </div>
            @endforeach

            
        </div>
        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
            <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary mtop16">Regresar</a>

    {!! Form::close() !!}
</div>



@endsection