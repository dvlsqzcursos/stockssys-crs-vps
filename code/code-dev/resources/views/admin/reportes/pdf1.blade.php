<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte No.1 </title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }

    


    </style>
    


</head>
<body>
    <div style="text-align: center;">
        <h5>
            Programa "Aprendizaje para la vida" "Nojb'al rech K'aslemal" (K'iche) <br>
            Pastoral Social Cáritas de los Altos 
        </h5>    
    </div>
    
    <div style="text-align: center;">
        <h5>
            Reporte No. {{$numReporte}} - StocksSys 
            
        </h5>    
        <b>Descripción: </b>Total de escuelas despachadas detallando cada tipo de alimento o producto tanto en unidades y su peso en libras/quintales, para cada modalidad escolar, voluntarios y lideres
    </div>
    <br>

    <div>
        <b>Total de Escuelas Atendidas @if(isset($solicitud1) ) Pre Primaria a 3ro Primaria @endif: </b>
        @foreach($total_escuelas as $t)
                {{$t->total}}
        @endforeach
    </div>

    <div>
        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
        @foreach($solicitud as $s)
            <b>{{$loop->iteration.'. '.$s->escuela_nombre}}</b> - @if(isset($s->total_estudiantes) ) <b>Total de Estudiantes Atendidos: </b> {{$s->total_estudiantes}} -  @endif  <b>Tipo Ración:</b> {{$s->racion}}  <br>
            <table class="table table-striped table-hover mtop16">
                <thead>
                    <tr>
                        <td><strong>ALIMENTO</strong></td>
                        <td><strong>UNIDADES</strong></td>
                        <td><strong>SACO/CANECA</strong></td>
                        <td><strong>LIBRAS/QUINTALES</strong></td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($alimentos as $a)
                        @if($s->escuela_id == $a->escuela_id && $s->racion == $a->racion)
                            <tr>
                                <td>{{$a->insumo}}</td>
                                <td></td>
                                <td>{{$a->cantidad}}</td>
                                <td></td>
                            </tr>

                        @endif
                    @endforeach

                </tbody>
            </table>
                        
            <hr>
        @endforeach

        @if(isset($solicitud1) )
            <b>Total de Escuelas Atendidas 4to Primaria a 6to Primaria: </b>
            @foreach($total_escuelas1 as $t1)
                {{$t1->total}}

            @endforeach
            <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
            @foreach($solicitud1 as $s1)
                <b>{{$loop->iteration.'. '.$s1->escuela_nombre}}</b> - @if(isset($s1->total_estudiantes) ) <b>Total de Estudiantes Atendidos: </b> {{$s1->total_estudiantes}} -  @endif  <b>Tipo Ración:</b> {{$s1->racion}}  <br>
                <table class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td><strong>ALIMENTO</strong></td>
                            <td><strong>UNIDADES</strong></td>
                            <td><strong>SACO/CANECA</strong></td>
                            <td><strong>LIBRAS/QUINTALES</strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($alimentos1 as $a1)
                            @if($s1->escuela_id == $a1->escuela_id && $s1->racion == $a1->racion)
                                <tr>
                                    <td>{{$a1->insumo}}</td>
                                    <td></td>
                                    <td>{{$a1->cantidad}}</td>
                                    <td></td>
                                </tr>

                            @endif
                        @endforeach

                    </tbody>
                </table>
                
                <hr>
            @endforeach
        @endif
    </div>




</body>
</html>