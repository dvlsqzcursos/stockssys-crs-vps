<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Racion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class RacionesTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_raciones_list(){
        $response = $this->actingAs($this->user)->get('/admin/bodega_socio/raciones/1');
        $response->assertStatus(200);
    }

    public function test_user_create_raciones(){        
        $this->actingAs($this->user);

        $data = Racion::create([
            'nombre'=>'Escolar Prueba',
            'tipo_alimentos'=> 'solicitud_comida_escolar',
            'asignado_a'=>'0',
            'tipo_bodega'=>'1',
            'id_institucion'=>'1'    
        ]);

        $this->assertModelExists($data);
    }
    
    public function test_user_delete_raciones(){  
        $bodega = Racion::find(1);  
        $bodega->delete();
        $this->assertSoftDeleted($bodega);
    }

    public function test_user_others_functions(){  
        $racion = Racion::find(1);   
        
        $response = $this->actingAs($this->user)->get('/admin/bodega_socio/racion/'.$racion->id.'/editar');
        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get('/admin/bodega_socio/racion/'.$racion->id.'/alimentos');
        $response->assertStatus(200);

    }
}
