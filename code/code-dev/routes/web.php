<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConexionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'UserStatus', 'Permissions']],function(){
    Route::get('/', [App\Http\Controllers\Admin\PanelPrincipalController::class, 'getInicio'])->name('panel_principal');

    //Modulo de Ubicaciones
    Route::get('/ubicaciones', [App\Http\Controllers\Admin\UbicacionController::class, 'getInicio'])->name('ubicaciones');
    Route::post('/ubicacion/registrar', [App\Http\Controllers\Admin\UbicacionController::class, 'postUbicacionRegistrar'])->name('ubicacion_registrar');    
    Route::get('/ubicacion/{id}/editar', [App\Http\Controllers\Admin\UbicacionController::class, 'getUbicacionEditar'])->name('ubicacion_editar');
    Route::post('/ubicacion/{id}/editar', [App\Http\Controllers\Admin\UbicacionController::class, 'postUbicacionEditar'])->name('ubicacion_editar');
    Route::get('/ubicacion/{id}/eliminar', [App\Http\Controllers\Admin\UbicacionController::class, 'getUbicacionEliminar'])->name('ubicacion_eliminar');
    Route::get('/ubicacion/{id}/listado/n1', [App\Http\Controllers\Admin\UbicacionController::class, 'getUbicacionListadoN1'])->name('ubicacion_n1');
    Route::post('/ubicacion/n1/registrar', [App\Http\Controllers\Admin\UbicacionController::class, 'postUbicacionN1Registrar'])->name('ubicacion_registrar_n1');
    Route::get('/ubicacion/{id}/listado/n2', [App\Http\Controllers\Admin\UbicacionController::class, 'getUbicacionListadoN2'])->name('ubicacion_n2');
    Route::post('/ubicacion/n2/registrar', [App\Http\Controllers\Admin\UbicacionController::class, 'postUbicacionN2Registrar'])->name('ubicacion_registrar_n2');
    Route::post('/ubicacion/importar', [App\Http\Controllers\Admin\UbicacionController::class, 'postUbicacionImportar'])->name('ubicacion_registrar');  

    //Modulo de instituciones
    Route::get('/instituciones', [App\Http\Controllers\Admin\InstitucionController::class, 'getInicio'])->name('instituciones');
    Route::get('/institucion/registrar', [App\Http\Controllers\Admin\InstitucionController::class, 'getInstitucionRegistrar'])->name('institucion_registrar');  
    Route::post('/institucion/registrar', [App\Http\Controllers\Admin\InstitucionController::class, 'postInstitucionRegistrar'])->name('institucion_registrar');    
    Route::get('/institucion/{id}/editar', [App\Http\Controllers\Admin\InstitucionController::class, 'getInstitucionEditar'])->name('institucion_editar');  
    Route::post('/institucion/{id}/editar', [App\Http\Controllers\Admin\InstitucionController::class, 'postInstitucionEditar'])->name('institucion_editar');
    Route::get('/institucion/{id}/eliminar', [App\Http\Controllers\Admin\InstitucionController::class, 'getInstitucionEliminar'])->name('institucion_eliminar');

    //Modulo de Usuarios
    Route::get('/usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'getInicio'])->name('usuarios');
    Route::get('/usuario/registrar', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioRegistrar'])->name('usuario_registrar');
    Route::post('/usuario/registrar', [App\Http\Controllers\Admin\UsuarioController::class, 'postUsuarioRegistrar'])->name('usuario_registrar');
    Route::get('/usuario/{id}/editar', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioEditar'])->name('usuario_editar');
    Route::post('/usuario/{id}/editar', [App\Http\Controllers\Admin\UsuarioController::class, 'postUsuarioEditar'])->name('usuario_editar');
    Route::get('/usuario/{id}/eliminar', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioEliminar'])->name('usuario_eliminar');
    Route::get('/usuario/{id}/permisos', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioPermisos'])->name('usuario_permisos');
    Route::post('/usuario/{id}/permisos', [App\Http\Controllers\Admin\UsuarioController::class, 'postUsuarioPermisos'])->name('usuario_permisos');
    Route::get('/usuario/{id}/rest-contra', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioRestablecerContra'])->name('usuario_rest_contra');
    Route::get('/usuario/{id}/rest-pin', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioRestablecerPin'])->name('usuario_rest_pin'); 
    Route::get('/usuario/{id}/suspender', [App\Http\Controllers\Admin\UsuarioController::class, 'getUsuarioSuspender'])->name('usuario_suspender');

    //Modulo de escuelas
    Route::get('/escuelas', [App\Http\Controllers\Admin\EscuelaController::class, 'getInicio'])->name('escuelas');
    Route::get('/escuela/registrar', [App\Http\Controllers\Admin\EscuelaController::class, 'getEscuelaRegistrar'])->name('escuela_registrar');  
    Route::post('/escuela/registrar', [App\Http\Controllers\Admin\EscuelaController::class, 'postEscuelaRegistrar'])->name('escuela_registrar');    
    Route::get('/escuela/{id}/editar', [App\Http\Controllers\Admin\EscuelaController::class, 'getEscuelaEditar'])->name('escuela_editar');  
    Route::post('/escuela/{id}/editar', [App\Http\Controllers\Admin\EscuelaController::class, 'postEscuelaEditar'])->name('escuela_editar');
    Route::get('/escuela/{id}/eliminar', [App\Http\Controllers\Admin\EscuelaController::class, 'getEscuelaEliminar'])->name('escuela_eliminar');
    Route::post('/escuela/importar', [App\Http\Controllers\Admin\EscuelaController::class, 'postEscuelaImportar'])->name('escuela_registrar');  

    //Modulo de rutas
    Route::get('/rutas', [App\Http\Controllers\Admin\RutaController::class, 'getInicio'])->name('rutas');
    Route::post('/ruta/registrar', [App\Http\Controllers\Admin\RutaController::class, 'postRutaRegistrar'])->name('ruta_registrar');
    Route::get('/ruta/{id}/eliminar', [App\Http\Controllers\Admin\RutaController::class, 'getRutaEliminar'])->name('ruta_eliminar');
    Route::get('/ruta/{id}/asignar_escuelas', [App\Http\Controllers\Admin\RutaController::class, 'getRutaAsignarEscuelas'])->name('ruta_asignar_escuelas');
    Route::post('/ruta/asignar_escuelas', [App\Http\Controllers\Admin\RutaController::class, 'postRutaAsignarEscuelas'])->name('ruta_asignar_escuelas');
    Route::post('/ruta/asignar_escuelas/actualizar_orden', [App\Http\Controllers\Admin\RutaController::class, 'postActualizarOrdenLlegada'])->name('ruta_asignar_escuelas');
    Route::get('/ruta_asignaciones/{id}/eliminar', [App\Http\Controllers\Admin\RutaController::class, 'getRutaEliminarEscuelas'])->name('ruta_asignar_escuelas');

    //Modulo de Entregas
    Route::get('/entregas', [App\Http\Controllers\Admin\EntregaController::class, 'getInicio'])->name('entregas');
    Route::post('/entrega/registrar', [App\Http\Controllers\Admin\EntregaController::class, 'postEntregaRegistrar'])->name('entrega_registrar');    
    Route::get('/entrega/{id}/editar', [App\Http\Controllers\Admin\EntregaController::class, 'getEntregaEditar'])->name('entrega_editar');
    Route::post('/entrega/{id}/editar', [App\Http\Controllers\Admin\EntregaController::class, 'postEntregaEditar'])->name('entrega_editar');
    Route::get('/entrega/{id}/eliminar', [App\Http\Controllers\Admin\EntregaController::class, 'getEntregaEliminar'])->name('entrega_eliminar');    

    //Modulo de Bodega - Bodega Socio
    Route::get('/bodega_socio/insumos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumos'])->name('bodega_socio_insumos');
    Route::post('/bodega_socio/insumo/registrar', [App\Http\Controllers\Admin\BodegaSocioController::class, 'postInsumoRegistrar'])->name('bodega_socio_insumo_registrar');
    Route::get('/bodega_socio/insumo/ingresos/alimentos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoIngresosAlimentos'])->name('bodega_socio_ingresos');
    Route::post('/bodega_socio/insumo/ingresos/alimentos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'postInsumoIngresosAlimentos'])->name('bodega_socio_ingresos');
    Route::get('/bodega_socio/insumo/ingresos/otros_insumos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoIngresosOtros'])->name('bodega_socio_ingresos');
    Route::post('/bodega_socio/insumo/ingresos/otros_insumos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'postInsumoIngresosOtros'])->name('bodega_socio_ingresos');
    Route::get('/bodega_socio/insumo/egresos/alimentos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoEgresosAlimentos'])->name('bodega_socio_egresos');
    Route::post('/bodega_socio/insumo/egresos/alimentos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'postInsumoEgresosAlimentos'])->name('bodega_socio_egresos');
    Route::get('/bodega_socio/insumo/egresos/otros_insumos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoEgresosOtros'])->name('bodega_socio_egresos');
    Route::post('/bodega_socio/insumo/egresos/otros_insumos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'postInsumoEgresosOtros'])->name('bodega_socio_egresos');
    Route::get('/bodega_socio/insumo/movimientos/ingresos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getMovimientosIngresos'])->name('bodega_socio_movimientos');
    Route::get('/bodega_socio/insumo/movimientos/egresos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getMovimientosEgresos'])->name('bodega_socio_movimientos');
    Route::get('/bodega_socio/insumo/movimientos/ingresos/detalles/{id}', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getMovimientosIngresoDetalle'])->name('bodega_socio_movimientos');
    Route::get('/bodega_socio/insumo/movimientos/egresos/detalles/{id}', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getMovimientosEgresoDetalle'])->name('bodega_socio_movimientos');
    Route::get('/bodega_socio/insumo/{id}/pesos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoPesos'])->name('bodega_socio_insumo_pesos');
    Route::post('/bodega_socio/insumo/pesos', [App\Http\Controllers\Admin\BodegaSocioController::class, 'postInsumoPesos'])->name('bodega_socio_insumo_pesos');
    Route::get('/bodega_socio/insumo/{id}/editar', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoEditar'])->name('bodega_socio_editar'); 
    Route::get('/bodega_socio/insumo/{id}/eliminar', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getInsumoEliminar'])->name('bodega_socio_eliminar');     
    Route::get('/bodega_socio/solicitudes_bodega_principal', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getSolicitudesBodegaPrimaria'])->name('bodega_socio_solicitudes');   
    Route::get('/bodega_socio/solicitudes_bodega_principal/{id}/imprimir', [App\Http\Controllers\Admin\BodegaSocioController::class, 'getSolicitudesBodegaPrimariaPDF'])->name('bodega_socio_solicitudes');    
    //Raciones bodega de socios 
    Route::get('/bodega_socio/raciones/{bodega}', [App\Http\Controllers\Admin\RacionController::class, 'getInicio'])->name('bodega_socio_raciones');
    Route::post('/bodega_socio/racion/registrar', [App\Http\Controllers\Admin\RacionController::class, 'postRacionRegistrar'])->name('bodega_socio_racion_registrar');    
    Route::get('/bodega_socio/racion/{id}/editar', [App\Http\Controllers\Admin\RacionController::class, 'getRacionEditar'])->name('bodega_socio_racion_editar');
    Route::post('/bodega_socio/racion/{id}/editar', [App\Http\Controllers\Admin\RacionController::class, 'postRacionEditar'])->name('bodega_socio_racion_editar');
    Route::get('/bodega_socio/racion/{id}/eliminar', [App\Http\Controllers\Admin\RacionController::class, 'getRacionEliminar'])->name('bodega_socio_racion_eliminar');
    Route::get('/bodega_socio/racion/{id}/alimentos', [App\Http\Controllers\Admin\RacionController::class, 'getRacionAlimentos'])->name('bodega_socio_racion_alimentos');
    Route::post('/bodega_socio/racion/alimentos/asignar', [App\Http\Controllers\Admin\RacionController::class, 'postRacionAlimentos'])->name('bodega_socio_racion_alimentos');
    Route::get('/bodega_socio/racion/alimentos/{id}/eliminar', [App\Http\Controllers\Admin\RacionController::class, 'getRacionAlimentosEliminar'])->name('bodega_socio_racion_alimentos');  
    //Kits bodega de socios 
    Route::get('/bodega_socio/kits/{bodega}', [App\Http\Controllers\Admin\KitController::class, 'getInicio'])->name('bodega_socio_kits');
    Route::post('/bodega_socio/kit/registrar', [App\Http\Controllers\Admin\KitController::class, 'postKitRegistrar'])->name('bodega_socio_kit_registrar');    
    Route::get('/bodega_socio/kit/{id}/editar', [App\Http\Controllers\Admin\KitController::class, 'getKitEditar'])->name('bodega_socio_kit_editar');
    Route::post('/bodega_socio/kit/{id}/editar', [App\Http\Controllers\Admin\KitController::class, 'postKitEditar'])->name('bodega_socio_kit_editar');
    Route::get('/bodega_socio/kit/{id}/eliminar', [App\Http\Controllers\Admin\KitController::class, 'getKitEliminar'])->name('bodega_socio_kit_eliminar');
    Route::get('/bodega_socio/kit/{id}/insumos', [App\Http\Controllers\Admin\KitController::class, 'getKitInsumos'])->name('bodega_socio_kit_insumos');
    Route::post('/bodega_socio/kit/insumos/asignar', [App\Http\Controllers\Admin\KitController::class, 'postKitInsumos'])->name('bodega_socio_kit_insumos');
    Route::get('/bodega_socio/kit/insumos/{id}/eliminar', [App\Http\Controllers\Admin\KitController::class, 'getKitInsumosEliminar'])->name('bodega_socio_kit_insumos');  


    //Modulo de Bodega - Bodega Principal
    Route::get('/bodega_principal/insumos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getInsumos'])->name('bodega_principal_insumos');
    Route::post('/bodega_principal/insumo/registrar', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'postInsumoRegistrar'])->name('bodega_principal_insumo_registrar');
    Route::get('/bodega_principal/insumo/ingresos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getInsumoIngresos'])->name('bodega_principal_ingresos');
    Route::post('/bodega_principal/insumo/ingresos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'postInsumoIngresos'])->name('bodega_principal_ingresos');
    Route::get('/bodega_principal/insumo/egresos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getInsumoEgresos'])->name('bodega_principal_egresos');
    Route::post('/bodega_principal/insumo/egresos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'postInsumoEgresos'])->name('bodega_principal_egresos');
    Route::get('/bodega_principal/insumo/{id}/pesos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getInsumoPesos'])->name('bodega_principal_insumo_pesos');
    Route::post('/bodega_principal/insumo/pesos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'postInsumoPesos'])->name('bodega_principal_insumo_pesos');
    Route::get('/bodega_principal/insumo/{id}/editar', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getInsumoEditar'])->name('bodega_principal_editar');
    Route::get('/bodega_principal/insumo/{id}/eliminar', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getInsumoEliminar'])->name('bodega_principal_eliminar');
    Route::get('/bodega_principal/solicitudes_socios', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getSolicitudesSocios'])->name('bodega_principal_solicitudes');
    Route::get('/bodega_principal/solicitudes_socios/{id}/detalles', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getSolicitudeSocioDetalles'])->name('bodega_principal_solicitudes');
    Route::get('/bodega_principal/solicitudes_socios/{id}/aceptar', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getAceptarSolicitudSocio'])->name('bodega_principal_solicitudes');
    Route::get('/bodega_principal/solicitudes_socios/{id}/rechazar', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getRechazarSolicitudSocio'])->name('bodega_principal_solicitudes');
    Route::get('/bodega_principal/insumo/movimientos/ingresos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getMovimientosIngresos'])->name('bodega_principal_movimientos');
    Route::get('/bodega_principal/insumo/movimientos/egresos', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getMovimientosEgresos'])->name('bodega_principal_movimientos');
    Route::get('/bodega_principal/insumo/movimientos/ingresos/detalles/{id}', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getMovimientosIngresoDetalle'])->name('bodega_principal_movimientos');
    Route::get('/bodega_principal/insumo/movimientos/egresos/detalles/{id}', [App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getMovimientosEgresoDetalle'])->name('bodega_principal_movimientos');


    //Modulo de Solicitudes    
    Route::get('/solicitudes_despachos', [App\Http\Controllers\Admin\SolicitudController::class, 'getInicio'])->name('solicitudes');
    Route::get('/solicitud_despacho/registrar', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudRegistrar'])->name('solicitud_registrar');
    Route::post('/solicitud_despacho/registrar', [App\Http\Controllers\Admin\SolicitudController::class, 'postSolicitudRegistrar'])->name('solicitud_registrar');
    Route::get('/solicitud_despacho/{id}/mostrar', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudMostrar'])->name('solicitud_mostrar');
    Route::get('/solicitud_despacho/{id}/eliminar', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudEliminar'])->name('solicitud_eliminar');
    Route::get('/solicitud_despacho/detalles/{id}/eliminar', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudDetallesEliminar'])->name('solicitud_detalle_eliminar');
    Route::get('/solicitud_despacho/detalles/{id}/registrar', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudDetallesRegistrar'])->name('solicitud_detalle_registrar');
    Route::post('/solicitud_despacho/detalles/registrar', [App\Http\Controllers\Admin\SolicitudController::class, 'postSolicitudDetallesRegistrar'])->name('solicitud_detalle_registrar');
    Route::get('/solicitud_despacho/detalles/{id}/editar', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudDetallesEditar'])->name('solicitud_detalle_editar');
    Route::post('/solicitud_despacho/detalles/{id}/editar', [App\Http\Controllers\Admin\SolicitudController::class, 'postSolicitudDetallesEditar'])->name('solicitud_detalle_editar');
    Route::get('/solicitud_despacho/{id}/rutas', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudRutas'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/{id}/rutas_confirmadas', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudRutasConfirmadas'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/ruta_confirmada/{id}/informacion_transporte', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudRutasConfirmadasTransporte'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/ruta_confirmada/informacion_transporte', [App\Http\Controllers\Admin\SolicitudController::class, 'postSolicitudRutasConfirmadasTransporte'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/{id}/ruta/{idRuta}', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudRutaDetalle'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/confirmar_ruta/sin_division', [App\Http\Controllers\Admin\SolicitudController::class,'postSolicitudRutaConfirmar'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/sub_rutas/actualizar_orden', [App\Http\Controllers\Admin\SolicitudController::class,'postActualizarOrdenLlegadaSubRutas'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho_ruta_confirmada/{id}/eliminar', [App\Http\Controllers\Admin\SolicitudController::class,'getSolicitudRutaConfirmadaEliminar'])->name('solicitud_rutas');    
    Route::post('/solicitud_despacho/crear_subruta', [App\Http\Controllers\Admin\SolicitudController::class,'postSolicitudCrearSubRuta'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/asignar_escuela_sub_ruta', [App\Http\Controllers\Admin\SolicitudController::class,'postSolicitudAsignarEscuelaSubRuta'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho_escuela_sub_ruta/{id}/eliminar', [App\Http\Controllers\Admin\SolicitudController::class,'getSolicitudEscuelaSubRutaEliminar'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho_sub_ruta/{id}/eliminar', [App\Http\Controllers\Admin\SolicitudController::class,'getSolicitudSubRutaEliminar'])->name('solicitud_rutas');   
    Route::get('/solicitud_despacho/{id}/solicitud_bodega_primaria', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudABodegaPrimaria'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/solicitud_bodega_primaria', [App\Http\Controllers\Admin\SolicitudController::class, 'postSolicitudABodegaPrimaria'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/{id}/escuelas', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudEscuelas'])->name('solicitud_escuelas');
    Route::get('/solicitud_despacho/{id}/escuela/{idEscuela}', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudEscuelaDespacho'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/{idSolicitud}/escuela/{idEscuela}/despacho/{id}/impresion', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudEscuelaDespachoPDF'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/{idSolicitud}/ruta_confirmada/{idRuta}/boleta/impresion', [App\Http\Controllers\Admin\SolicitudController::class, 'getSolicitudRutaConfirmadaPDF'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/despachar/escolar', [App\Http\Controllers\Admin\SolicitudController::class, 'postDespacharEscolares'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/despachar/lideres', [App\Http\Controllers\Admin\SolicitudController::class, 'postDespacharLideres'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/despachar/voluntarios', [App\Http\Controllers\Admin\SolicitudController::class, 'postDespacharVoluntarios'])->name('solicitud_rutas');

    //Modulo de Reportes
    Route::get('/reportes', [App\Http\Controllers\Admin\ReporteController::class, 'getInicio'])->name('reportes');
    Route::post('/reporte/informe_mensual', [App\Http\Controllers\Admin\ReporteController::class, 'postInformeMensualExport'])->name('reportes');
    Route::get('/reporte/panel', [App\Http\Controllers\Admin\ReporteController::class, 'getPanelReporte'])->name('reportes');
    Route::post('/reporte/panel/generar', [App\Http\Controllers\Admin\ReporteController::class, 'postPanelReporteGenerar'])->name('reportes');
    Route::get('/reporte/exportar/pdf/{idSolicitud}/{idSocio}/{numReporte}', [App\Http\Controllers\Admin\ReporteController::class, 'getReporteGenerarPDF'])->name('reportes');

    //Reporte de Bitacoras
    Route::get('/bitacoras', [App\Http\Controllers\Admin\BitacoraController::class, 'getInicio'])->name('bitacoras');

    //Reporte de Bitacoras
    Route::get('/cuenta_usuario', [App\Http\Controllers\Admin\UsuarioController::class, 'getCuentaUsuario'])->name('usuarios');
    Route::post('/cambio_password_usuario', [App\Http\Controllers\Admin\UsuarioController::class, 'postCambioPassword'])->name('usuarios');

    //Modulo de Pruebas
    Route::get('/pruebas', [App\Http\Controllers\Admin\PruebasController::class, 'getInicio'])->name('ubicaciones');
    Route::post('/prueba/importar', [App\Http\Controllers\Admin\PruebasController::class, 'postArchivoImportar'])->name('escuela_registrar');

    
});

Route::get('/stocksys/api/escuelas/{idSolicitud}',[App\Http\Controllers\Admin\SolicitudController::class, 'getEscuelasDespacho']); 
Route::get('/stocksys/api/escuelas/pesos/solicitud/{idSolicitud}/{idEscuela}',[App\Http\Controllers\Admin\SolicitudController::class, 'getEscuelasPesosDespacho']); 
Route::get('/stocksys/api/escuelas/pruebas/{idSolicitud}',[App\Http\Controllers\Admin\SolicitudController::class, 'getEscuelasPruebas']); 
Route::get('/stocksys/api/bodega_socio/insumo/pl_disponibles/{idAlimento}',[App\Http\Controllers\Admin\BodegaSocioController::class, 'getPlDisponiblesAlimento']); 
Route::get('/stocksys/api/bodega_socio/insumo/disponibles/{idInsumo}',[App\Http\Controllers\Admin\BodegaSocioController::class, 'getSaldoDisponiblesInsumo']); 
Route::get('/stocksys/api/bodega_socio/insumo/pl/saldo_disponible/{pl}',[App\Http\Controllers\Admin\BodegaSocioController::class, 'getPlSaldoDisponibleAlimento']);
Route::get('/stocksys/api/bodega_socio/solicitud_id/{id_solicitud}/escuela/{id_escuela}/raciones',[App\Http\Controllers\Admin\BodegaSocioController::class, 'getRacionesEscuelaSolicitud']);   
Route::get('/stocksys/api/solicitudes/socios/{idSocio}',[App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getSociosSolicitudes']);  
Route::get('/stocksys/api/bodega_principal/insumo/pl_disponibles/{idAlimento}',[App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getPlDisponiblesInsumo']); 
Route::get('/stocksys/api/bodega_principal/insumo/pl/saldo_disponible/{pl}',[App\Http\Controllers\Admin\BodegaPrincipalController::class, 'getPlSaldoDisponibleInsumo']);  
Route::get('/stocksys/api/solicitudes_despacho/socios/{idSocio}',[App\Http\Controllers\Admin\ReporteController::class, 'getSociosSolicitudes']); 


Route::get('/', function () {
    return view('welcome');
});


//Modulo de Inicio de Sesion
Route::get('/',[App\Http\Controllers\ConexionController::class, 'getIniciarSesion'])->name('login');
Route::get('/iniciar_sesion',[App\Http\Controllers\ConexionController::class, 'getIniciarSesion']);
Route::post('/iniciar_sesion',[App\Http\Controllers\ConexionController::class, 'postIniciarSesion']);
Route::get('/cerrar_sesion',[App\Http\Controllers\ConexionController::class, 'getCerraSesion'])->name('logout');
