<script>

    $(document).ready(function(){


        var rol_usuario = document.getElementById('rol');


        var frm_permisos = document.getElementById('frm_permisos');
        

        $('#rol').change(function(){
                if(rol_usuario.value == 0){
                    frm_permisos.value = 'Panel principal, Ubicaciones, Instituciones, Entregas, Usuarios, Escuelas, Rutas, Raciones, Alimentos, Solicitudes, Reporteria';
                    console.log('administrador sistema');
                }

                if(rol_usuario.value == 1){
                    frm_permisos.value = 'Panel principal, Ubicaciones, Instituciones, Entregas, Usuarios, Escuelas, Rutas, Raciones, Alimentos, Solicitudes, Reporteria';
                    console.log('administrador ');
                }

                if(rol_usuario.value == 2){
                    frm_permisos.value = 'Panel principal, Entregas, Escuelas, Rutas, Raciones, Alimentos, Solicitudes, Reporteria';
                    console.log('encargado');
                }

                if(rol_usuario.value == 3){
                    frm_permisos.value = 'Panel principal, Escuelas, Rutas, Alimentos, Solicitudes, Reporteria';
                    console.log('bodega');
                }
            

            
            

        });
    });



</script>