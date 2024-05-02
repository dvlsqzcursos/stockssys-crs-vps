<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombres', 250);
            $table->string('apellidos', 250);
            $table->string('contacto', 40)->nullable();    
            $table->string('correo', 250)->nullable();    
            $table->string('puesto', 250)->nullable();  
            $table->integer('id_institucion');
            $table->string('usuario')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('pin')->nullable();
            $table->integer('rol')->nullable();
            $table->text('permisos')->nullable();
            $table->integer('estado');
            $table->rememberToken();
            $table->timestamps(); 
            $table->softDeletes();            
            
        });

        DB::unprepared('SELECT 1; SET IDENTITY_INSERT users ON');
        DB::table('users')->insert(array(
            'id'=>'1',
            'nombres'=>'Ricardo Daniel',
            'apellidos'=>'Velasquez Quiroa',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>'Encargado de Desarrollo',
            'id_institucion'=>'1',
            'usuario'=>'ricardo.velasquez',
            'password'=>'$2y$10$NEK4ExERTEocC1ygE46ptOZTJeUv7V6ShSd5TPo90NbiKx/8.dcpi',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'0',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","insumos":"true","insumo_registrar":"true","insumo_editar":"true","insumo_eliminar":"true","insumo_pesos":"true","bodega_principal_insumos":"true","bodega_principal_insumo_registrar":"true","bodega_principal_ingresos":"true","bodega_principal_egresos":"true","bodega_principal_eliminar":"true","bodega_socio_insumos":"true","bodega_socio_insumo_registrar":"true","bodega_socio_ingresos":"true","bodega_socio_egresos":"true","bodega_socio_insumo_pesos":"true","bodega_socio_eliminar":"true","bodega_socio_raciones":"true","bodega_socio_racion_registrar":"true","bodega_socio_racion_editar":"true","bodega_socio_racion_eliminar":"true","bodega_socio_racion_alimentos":"true","bodega_socio_kits":"true","bodega_socio_kit_registrar":"true","bodega_socio_kit_editar":"true","bodega_socio_kit_eliminar":"true","bodega_socio_kit_insumos":"true","solicitudes":"true","solicitud_registrar":"true","solicitud_mostrar":"true","solicitud_eliminar":"true","solicitud_detalle_eliminar":"true","solicitud_detalle_editar":"true","solicitud_detalle_registrar":"true","solicitud_rutas":"true","bitacoras":"true"}',
            'estado'=>'0', 
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(),       
        ));

        DB::table('users')->insert(array(
            'id'=>'2',
            'nombres'=>'Usuario',
            'apellidos'=>'Prueba',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>'Usuario de Prueba',
            'id_institucion'=>'2',
            'usuario'=>'usuario.prueba',
            'password'=>'$2y$10$NEK4ExERTEocC1ygE46ptOZTJeUv7V6ShSd5TPo90NbiKx/8.dcpi',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'2',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_importar":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_importar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","bodega_principal_insumos":"true","bodega_principal_insumo_registrar":"true","bodega_principal_insumo_pesos":"true","bodega_principal_eliminar":"true","bodega_principal_ingresos":"true","bodega_principal_egresos":"true","bodega_principal_solicitudes":"true","bodega_principal_movimientos":"true","bodega_socio_insumos":"true","bodega_socio_insumo_registrar":"true","bodega_socio_insumo_pesos":"true","bodega_socio_eliminar":"true","bodega_socio_solicitudes":"true","bodega_socio_ingresos":"true","bodega_socio_egresos":"true","bodega_socio_movimientos":"true","bodega_socio_raciones":"true","bodega_socio_racion_registrar":"true","bodega_socio_racion_editar":"true","bodega_socio_racion_eliminar":"true","bodega_socio_racion_alimentos":"true","bodega_socio_kits":"true","bodega_socio_kit_registrar":"true","bodega_socio_kit_editar":"true","bodega_socio_kit_eliminar":"true","bodega_socio_kit_insumos":"true","solicitudes":"true","solicitud_registrar":"true","solicitud_mostrar":"true","solicitud_eliminar":"true","solicitud_detalle_registrar":"true","solicitud_detalle_editar":"true","solicitud_detalle_eliminar":"true","solicitud_rutas":"true","solicitud_rutas_administrar":"true","solicitud_rutas_confirmadas":"true","solicitud_solicitud_primaria":"true","solicitud_escuelas":"true","reportes":"true","bitacoras":"true"}',
            'estado'=>'0',       
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), 
        ));
        DB::table('users')->insert(array(
            'id'=>'3',
            'nombres'=>'Otto Raul',
            'apellidos'=>'Molina Dominguez',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>NULL,
            'id_institucion'=>'2',
            'usuario'=>'otto.molina',
            'password'=>'$2y$10$NEK4ExERTEocC1ygE46ptOZTJeUv7V6ShSd5TPo90NbiKx/8.dcpi',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'2',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","insumos":"true","insumo_registrar":"true","insumo_editar":"true","insumo_eliminar":"true","insumo_pesos":"true","bodega_principal_insumos":"true","bodega_principal_insumo_registrar":"true","bodega_principal_ingresos":"true","bodega_principal_egresos":"true","bodega_principal_eliminar":"true","bodega_socio_insumos":"true","bodega_socio_insumo_registrar":"true","bodega_socio_ingresos":"true","bodega_socio_egresos":"true","bodega_socio_insumo_pesos":"true","bodega_socio_eliminar":"true","bodega_socio_raciones":"true","bodega_socio_racion_registrar":"true","bodega_socio_racion_editar":"true","bodega_socio_racion_eliminar":"true","bodega_socio_racion_alimentos":"true","bodega_socio_kits":"true","bodega_socio_kit_registrar":"true","bodega_socio_kit_editar":"true","bodega_socio_kit_eliminar":"true","bodega_socio_kit_insumos":"true","solicitudes":"true","solicitud_registrar":"true","solicitud_mostrar":"true","solicitud_eliminar":"true","solicitud_detalle_eliminar":"true","solicitud_detalle_editar":"true","solicitud_detalle_registrar":"true","solicitud_rutas":"true","bitacoras":"true"}',
            'estado'=>'0',       
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), 
        ));
        DB::table('users')->insert(array(
            'id'=>'4',
            'nombres'=>'Kilbert Haiser',
            'apellidos'=>'Velasquez Gonzalez',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>NULL,
            'id_institucion'=>'2',
            'usuario'=>'kilbert.velasquez',
            'password'=>'$2y$10$NEK4ExERTEocC1ygE46ptOZTJeUv7V6ShSd5TPo90NbiKx/8.dcpi',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'2',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","insumos":"true","insumo_registrar":"true","insumo_editar":"true","insumo_eliminar":"true","insumo_pesos":"true","bodega_principal_insumos":"true","bodega_principal_insumo_registrar":"true","bodega_principal_ingresos":"true","bodega_principal_egresos":"true","bodega_principal_eliminar":"true","bodega_socio_insumos":"true","bodega_socio_insumo_registrar":"true","bodega_socio_ingresos":"true","bodega_socio_egresos":"true","bodega_socio_insumo_pesos":"true","bodega_socio_eliminar":"true","bodega_socio_raciones":"true","bodega_socio_racion_registrar":"true","bodega_socio_racion_editar":"true","bodega_socio_racion_eliminar":"true","bodega_socio_racion_alimentos":"true","bodega_socio_kits":"true","bodega_socio_kit_registrar":"true","bodega_socio_kit_editar":"true","bodega_socio_kit_eliminar":"true","bodega_socio_kit_insumos":"true","solicitudes":"true","solicitud_registrar":"true","solicitud_mostrar":"true","solicitud_eliminar":"true","solicitud_detalle_eliminar":"true","solicitud_detalle_editar":"true","solicitud_detalle_registrar":"true","solicitud_rutas":"true","bitacoras":"true"}',
            'estado'=>'0',       
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), 
        ));
        DB::table('users')->insert(array(
            'id'=>'5',
            'nombres'=>'Javier Moises',
            'apellidos'=>'Sapon Alvarado',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>NULL,
            'id_institucion'=>'2',
            'usuario'=>'javier.sapon',
            'password'=>'$2y$10$NEK4ExERTEocC1ygE46ptOZTJeUv7V6ShSd5TPo90NbiKx/8.dcpi',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'2',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","insumos":"true","insumo_registrar":"true","insumo_editar":"true","insumo_eliminar":"true","insumo_pesos":"true","bodega_principal_insumos":"true","bodega_principal_insumo_registrar":"true","bodega_principal_ingresos":"true","bodega_principal_egresos":"true","bodega_principal_eliminar":"true","bodega_socio_insumos":"true","bodega_socio_insumo_registrar":"true","bodega_socio_ingresos":"true","bodega_socio_egresos":"true","bodega_socio_insumo_pesos":"true","bodega_socio_eliminar":"true","bodega_socio_raciones":"true","bodega_socio_racion_registrar":"true","bodega_socio_racion_editar":"true","bodega_socio_racion_eliminar":"true","bodega_socio_racion_alimentos":"true","bodega_socio_kits":"true","bodega_socio_kit_registrar":"true","bodega_socio_kit_editar":"true","bodega_socio_kit_eliminar":"true","bodega_socio_kit_insumos":"true","solicitudes":"true","solicitud_registrar":"true","solicitud_mostrar":"true","solicitud_eliminar":"true","solicitud_detalle_eliminar":"true","solicitud_detalle_editar":"true","solicitud_detalle_registrar":"true","solicitud_rutas":"true","bitacoras":"true"}',
            'estado'=>'0',       
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), 
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT users OFF');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
