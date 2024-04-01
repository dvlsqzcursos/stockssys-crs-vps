<?php
    function obtenerRoles($modo, $id){
        $or = [
            '0' => 'Administrador del Sistema',
            '1' => 'Administrador',
            '2' => 'Encargado (Socio)',
            '3' => 'Bodega (Socio)', 
        ];

        if(!is_null($modo)):
            return $or;
        else:
            return $or[$id];
        endif;
    }

    function obtenerTiposInstitucion($modo, $id){
        $ti = [
            '0' => 'Soporte',
            '1' => 'Socio',
            '2' => 'Principal'
        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }


    function obtenerEstadosUsuario($modo, $id){
        $estado = [
            '0' => 'Activo',
            '1' => 'Suspendido',
        ];

        
        if(!is_null($modo)):
            return $estado;
        else:
            return $estado[$id];
        endif;
    }

    function obtenerDocumentosIngreso($modo, $id){
        $documento = [
            '1'=>'Guia de Transporte Terrestre',
            '2'=>'Factura',
            '3'=>'Recibo',
            '4'=>'Otro',
        ];

        
        if(!is_null($modo)):
            return $documento;
        else:
            return $documento[$id];
        endif;
    }

    function obtenerDocumentosEgreso($modo, $id){
        $documento = [
            '1'=>'Boleta de Despacho',
            '2'=>'Factura',
            '3'=>'Recibo',
            '4'=>'Perdida/Descarte',
            '5'=>'Cuestionable/Cuarentena',
            '6'=>'Otro',
        ];

        
        if(!is_null($modo)):
            return $documento;
        else:
            return $documento[$id];
        endif;
    }

    function obtenerEstadoSolicitud($modo, $id){
        $estado = [
            '1'=>'Registrada y Enviada Digitalmente',
            '2'=>'Aceptada',
            '3'=>'Rechazada'
        ];

        
        if(!is_null($modo)):
            return $estado;
        else:
            return $estado[$id];
        endif;
    }

    function obtenerUnidadesMedidaInsumos($modo, $id){
        $ti = [
            '0' => 'Kilogramos por unidad (Caneca/Saco)',
            '1' => 'Gramos x unidad',
            '2' => 'Libras Netas por Unidad = Kg por unidad x Libras por Kg.',
            '3' => 'Quintales x unidad',
            '4' => 'Peso bruto en quintales (peso neto + caneca metalica)',
            '5' => 'Tonelada Metrica Kg.',
            '6' => 'Unidades por TM',
            '7' => 'Barril',
            '8' => 'Cilindro'

        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }

    function obtenerCategoriaInsumos($modo, $id){
        $ti = [
            '0' => 'Alimentos',
            '1' => 'Otros'

        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }

    function obtenerUnidadesMedidaRaciones($modo, $id){
        $ti = [
            '0' => 'Gramos',
            '1' => 'Kilogramos',
            '2' => 'Libras'
        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }

    function obtenerOpcionesBeneficiarios($modo, $id){
        $ob = [
            '0' => 'Estudiantes',
            '1' => 'Lideres',
            '2' => 'Docentes y Voluntarios',
        ];

        if(!is_null($modo)):
            return $ob;
        else:
            return $ob[$id];
        endif;
    }

    function obtenerMeses($modo, $id){
        $m = [
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];

        if(!is_null($modo)):
            return $m;
        else:
            return $m[$id];
        endif;
    }

    function obtenerDescripcionReportes($modo, $id){
        $r = [
            '1' => 'Total de escuelas despachadas detallando cada tipo de alimento o producto tanto en unidades y su peso en libras/quintales, para cada modalidad escolar, voluntarios y lideres.',
            '2' => 'Total de escuelas despachadas con Maíz USDA (mismas características del anterior).',
            '3' => 'Total de escuelas despachadas con Maiz Biofortificado (mismas características del anterior).',
            '4' => 'Total de escolares despachados (de preprimaria a 6º primaria) mismas características del anterior.',
            '5' => 'Total de escolares despachados desglosado de prepa a tercero primaria y de cuarto a sexto primaria (mismas características del anterior).',
            '6' => 'Total de rutas despachadas y cantidad de unidades y su peso por cada ruta.',
            '7' => 'Total de toneladas métricas de ración escolar completa, desglosada (prepa a 30 y cuarto a sexto).',
            '8' => 'Todos los datos estadísticos: cantidad de escolares niños, cantidad de escolares niñas, niños de prepa a tercero primaria, niñas de prepa a tercero primaria, niños de cuarto a sexto y niñas de cuarto a sexto. Cantidad de voluntarios total y cantidad de Lideres total.',
            '9' => 'Reporte de los bimestres despachados en el año: nombre de los meses, numero de dias despachados.',
            '10' => 'Total de guías despachadas: nombre del municipio, numero de ID de guía, números de boletas de despacho.',
            '11' => 'Total de solicitudes de alimento en el año (visualizar su descripción).',
            '12' => 'Saldos de inventario por tipos de alimento u otro artículo. En el caso de alimento por tipo de PL, fecha BUBD del alimento.',
            '13' => 'Reporte de diferencias de pesos: ingresos y salidas por balance.',
            '14' => 'Reporte de alimento cuestionable o en estado de cuarentena: unidades y peso.',
            '15' => 'Reporte de saldo de perdidas o declaración de alimento descartado: unidades y peso.',
            '16' => 'Reporte de ingresos de guías de transporte de la bodega primaria y de las guías de proveedor de maíz biofortificado: numero de documento, fechas de ingreso, cantidad en unidades y peso, tipos de producto, PL y BUBD.',
            '17' => 'Registro de datos para muestreos aleatorios: PL y BUBD, tipo de alimento, cantidad en unidades y peso de las muestras (en libras y kilogramos), numero de contrato.'
        ];

        if(!is_null($modo)):
            return $r;
        else:
            return $r[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function permisosUsuario(){
        $p = [
            'panel_principal' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Modulo Panel Principal',
                'keys' => [
                    'panel_principal' => 'Puede ver el panel principal.'
                ]
            ],
            'ubicaciones' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Ubicaciones', 
                'keys' => [
                    'ubicaciones' => 'Puede ver el listado de ubicaciones.',
                    'ubicacion_importar' => 'Puede importar nuevas ubicaciones desde un archivo excel.',
                    'ubicacion_registrar' => 'Puede agregar nuevas ubicaciones.',
                    'ubicacion_editar' => 'Puede editar ubicaciones.',
                    'ubicacion_eliminar' => 'Puede eliminar ubicaciones.',
                    'ubicacion_n1' => 'Puede ver el listado de ubicaciones N1.',
                    'ubicacion_registrar_n1' => 'Puede agregar nuevas ubicaciones N1.',
                    'ubicacion_editar_n1' => 'Puede editar ubicaciones N1.',
                    'ubicacion_eliminar_n1' => 'Puede eliminar ubicaciones N1.',
                    'ubicacion_n2' => 'Puede ver el listado de ubicaciones N2.',
                    'ubicacion_registrar_n2' => 'Puede agregar nuevas ubicaciones N2.',
                    'ubicacion_editar_n2' => 'Puede editar ubicaciones N2.',
                    'ubicacion_eliminar_n2' => 'Puede eliminar ubicaciones N2.'                    
                ]
            ],
            'instituciones' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Instituciones',
                'keys' => [
                    'instituciones' => 'Puede ver el listado de instituciones.',
                    'institucion_registrar' => 'Puede agregar nuevas instituciones.',
                    'institucion_editar' => 'Puede editar instituciones.',
                    'institucion_eliminar' => 'Puede eliminar instituciones.'                 
                ]
            ],
            'usuarios' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Usuarios',
                'keys' => [
                    'usuarios' => 'Puede ver el listado de usuarios.',
                    'usuario_registrar' => 'Puede agregar nuevas usuarios.',
                    'usuario_editar' => 'Puede editar usuarios.',
                    'usuario_eliminar' => 'Puede eliminar usuarios.',
                    'usuario_permisos' => 'Puede editar permisos de los usuarios.',
                    'usuario_rest_contra' => 'Puede restablecer la contraseña de los usuarios.',
                    'usuario_rest_pin' => 'Puede restablecer el pin de los usuarios.'                            
                ]
            ],
            'escuelas' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Escuelas',
                'keys' => [
                    'escuelas' => 'Puede ver el listado de escuelas.',
                    'escuela_registrar' => 'Puede agregar nuevas escuelas.',
                    'escuela_importar' => 'Puede importar nuevas escuelas desde un archivo excel.',
                    'escuela_editar' => 'Puede editar escuelas.',
                    'escuela_eliminar' => 'Puede eliminar escuelas.'                           
                ]
            ],
            'rutas' => [
                'icon' => '<i class="fa-solid fa-route"></i>',
                'title' => 'Modulo Rutas',
                'keys' => [
                    'rutas' => 'Puede ver el listado de rutas.',
                    'ruta_registrar' => 'Puede agregar nuevas rutas.',
                    'ruta_asignar_escuelas' => 'Puede asignar escuelas a las rutas.',
                    'ruta_eliminar' => 'Puede eliminar rutas.'                           
                ]
            ],
            'entregas' => [
                'icon' => '<i class="fa-solid fa-people-carry-box"></i>',
                'title' => 'Modulo Entregas',
                'keys' => [
                    'entregas' => 'Puede ver el listado de entregas.',
                    'entrega_registrar' => 'Puede agregar nuevas entregas.',
                    'entrega_editar' => 'Puede editar entregas.',
                    'entrega_eliminar' => 'Puede eliminar entregas.'                 
                ]
            ],
            'bodegas_principales' => [
                'icon' => '<i class="fa-solid fa-warehouse"></i>',
                'title' => 'Modulo Bodega Principal',
                'keys' => [
                    'bodega_principal_insumos' => 'Puede ver el listado de insumos de la bodega principal.',
                    'bodega_principal_insumo_registrar' => 'Puede registrar insumos en la bodega principal.',
                    'bodega_principal_insumo_pesos' => 'Puede ver y editar los pesos de los insumos de la bodega principal.',
                    'bodega_principal_eliminar' => 'Puede eliminar registros de la bodega principal.',
                    'bodega_principal_ingresos' => 'Puede registrar ingresos a la bodega principal.',    
                    'bodega_principal_egresos' => 'Puede registrar egresos a la bodega principal.',                      
                    'bodega_principal_solicitudes' => 'Puede ver el listado de solicitudes de socios.',
                    'bodega_principal_movimientos' => 'Puede ver el historial de movimientos de la bodega.',
                ]
            ],
            'bodegas_socios' => [
                'icon' => '<i class="fa-solid fa-warehouse"></i>',
                'title' => 'Modulo Bodegas Socios',
                'keys' => [
                    'bodega_socio_insumos' => 'Puede ver el listado de insumos de la bodega socio.',
                    'bodega_socio_insumo_registrar' => 'Puede registrar insumos en la bodega socio.',                    
                    'bodega_socio_insumo_pesos' => 'Puede ver y editar los pesos de los insumos de la bodega socio.',
                    'bodega_socio_eliminar' => 'Puede eliminar registros de la bodega socio.',
                    'bodega_socio_solicitudes' => 'Puede ver el listado y detalle de solicitudes a bodega primaria.',
                    'bodega_socio_ingresos' => 'Puede registrar ingresos a la bodega socio.',    
                    'bodega_socio_egresos' => 'Puede registrar egresos a la bodega socio.',  
                    'bodega_socio_movimientos' => 'Puede ver el historial de movimientos de la bodega.',
                    'bodega_socio_raciones' => 'Puede ver el listado de raciones.',
                    'bodega_socio_racion_registrar' => 'Puede agregar nuevas raciones.',
                    'bodega_socio_racion_editar' => 'Puede editar raciones.',
                    'bodega_socio_racion_eliminar' => 'Puede eliminar raciones.',
                    'bodega_socio_racion_alimentos' => 'Puede crear, editar y eliminar alimentos que conforman las raciones.',                    
                    'bodega_socio_kits' => 'Puede ver el listado de kits.',
                    'bodega_socio_kit_registrar' => 'Puede agregar nuevas kits.',
                    'bodega_socio_kit_editar' => 'Puede editar kits.',
                    'bodega_socio_kit_eliminar' => 'Puede eliminar kits.',
                    'bodega_socio_kit_insumos' => 'Puede crear, editar y eliminar insumos que conforman las kits.',  
                ]
            ],
            'solicitudes' => [
                'icon' => '<i class="fa-solid fa-file-invoice"></i>',
                'title' => 'Modulo Solicitudes',
                'keys' => [
                    'solicitudes' => 'Puede ver el listado de solicitudes.',
                    'solicitud_registrar' => 'Puede agregar nuevas solicitudes.',
                    'solicitud_mostrar' => 'Puede ver los detalles de las solicitudes.',
                    'solicitud_eliminar' => 'Puede eliminar solicitudes.',  
                    'solicitud_detalle_registrar' => 'Puede registrar detalles de las solicitudes.', 
                    'solicitud_detalle_editar' => 'Puede editar detalles de las solicitudes.', 
                    'solicitud_detalle_eliminar' => 'Puede eliminar detalles de solicitudes.',                    
                    'solicitud_rutas' => 'Puede visualizar las rutas de las solicitudes',   
                    'solicitud_rutas_administrar' => 'Puede administrar las rutas de las solicitudes',   
                    'solicitud_rutas_confirmadas' => 'Puede visualizar las rutas de las solicitudes ya confirmadas',
                    'solicitud_solicitud_primaria' => 'Puede realizar solicitudes a bodega primaria',
                    'solicitud_escuelas' => 'Puede visualizar las escuelas para boletas de despacho.',
                ]
            ],
            'reportes' => [
                'icon' => '<i class="fa-solid fa-box-archive"></i>',
                'title' => 'Modulo Reportes',
                'keys' => [
                    'reportes' => 'Puede ver el listado de reportes del sistema.',
                    'bitacoras' => 'Puede ver el listado de bitacoras del sistema.',        
                ]
            ],

            
    

        ];

        return $p;
    }

?>