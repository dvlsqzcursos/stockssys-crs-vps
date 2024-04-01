<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Ruta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class RutasTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_rutas_list(){
        $response = $this->actingAs($this->user)->get('/admin/rutas');
        $response->assertStatus(200);
    }

    public function test_user_create_rutas(){        
        $this->actingAs($this->user);

        $data = Ruta::create([
            'correlativo'=>3,
            'id_ubicacion'=>3,
            'observaciones'=>null,
            'estado'=>0,
            'id_socio'=>2
        ]);

        $this->assertModelExists($data);
    }
    
    public function test_user_delete_rutas(){  
        $ruta = Ruta::find(1);  
        $ruta->delete();
        $this->assertSoftDeleted($ruta);
    }
    

    public function test_user_others_functions(){  
        $ruta = Ruta::find(1);   
        
        $response = $this->actingAs($this->user)->get('/admin/ruta/'.$ruta->id.'/asignar_escuelas');
        $response->assertStatus(200);

    }
}
