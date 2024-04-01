<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Ubicacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UbicacionesTest extends TestCase
{

    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_ubicaciones_list(){
        $response = $this->actingAs($this->user)->get('/admin/ubicaciones');
        $response->assertStatus(200);
    }

    public function test_user_create_ubicaciones(){        
        $this->actingAs($this->user);

        $data = Ubicacion::create([
            'nombre'=>'Totonicapan',
            'nomenclatura'=>null,
            'nivel'=>2,
            'id_principal'=>1,
        ]);

        $this->assertModelExists($data);
    }

    public function test_user_delete_ubicaciones(){      
        $ubicacion = Ubicacion::find(2);  
        $ubicacion->delete();
        $this->assertSoftDeleted($ubicacion);
    }

    public function test_user_others_functions(){    
        $ubicacion = Ubicacion::find(1);   
        
        $response = $this->actingAs($this->user)->get('/admin/ubicacion/'.$ubicacion->id.'/editar');
        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get('/admin/ubicacion/'.$ubicacion->id.'/listado/n1');
        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get('/admin/ubicacion/'.$ubicacion->id.'/listado/n2');
        $response->assertStatus(200);

    }
}
