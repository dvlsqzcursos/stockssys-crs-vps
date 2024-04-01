<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte No.{{$numReporte}} </title>
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
        <b>Descripción: </b> {{ obtenerDescripcionReportes(null, $numReporte) }}
    </div>
    <br>

    <div>
        <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
        <div class="col-md-12">
            <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> No. de Solicitud: </strong></label>
            {{ $solicitud->id }}
        </div>

        <hr>

        <div class="row">

                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños preprimaria: </strong></label>
                {{ $total_ninos_pre }}
            

            <div class="col-md-4">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niñas preprimaria: </strong></label>
                {{ $total_ninas_pre }}
            </div>

            <div class="col-md-4">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños y niñas preprimaria: </strong></label>
                {{ $total_pri }}
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-4">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños primaria: </strong></label>
                {{$total_ninos_pri }}
            </div>

            <div class="col-md-4">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niñas primaria: </strong></label>
                {{$total_ninas_pri}}
            </div>

            <div class="col-md-4">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de niños y niñas primaria: </strong></label>
                {{ $total_pri }}
            </div>
        </div>

        <div class="row mtop16">
            <div class="col-md-6">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Docente y Voluntarios: </strong></label>
                {{ $total_d_v }}
            </div>

            <div class="col-md-6">
                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Total de Lideres: </strong></label>
                {{$total_l }}
            </div>
        </div>
    </div>




</body>
</html>