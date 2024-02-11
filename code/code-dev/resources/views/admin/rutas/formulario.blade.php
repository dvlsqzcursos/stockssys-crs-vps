<div class="row">
    <div class="col-md-12">
        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Ubicación: </strong></label>
        <div class="input-group">           
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            <select name="id_ubicacion" id="id_ubicacion" style="width: 88%" >
                @foreach($ubicaciones as $u)
                    <option value=""></option>
                    <option value="{{ $u->id }}">{{ $u->nombre.' / '.$u->ubicacion_superior->nombre.' / '.$u->ubicacion_superior->ubicacion_superior->nombre }}</option>
                @endforeach
            </select>             
        </div>
    </div>

    <div class="col-md-12 mtop16">
        <label for="name"> <strong> Observaciones: </strong></label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
            {!! Form::textarea('observaciones', $ruta->observaciones, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
    </div>

    
    
</div>
