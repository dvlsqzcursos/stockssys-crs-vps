<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Institucion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class InstitucionesTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_instituciones_list(){
        $response = $this->actingAs($this->user)->get('/admin/instituciones');
        $response->assertStatus(200);
    }

    public function test_user_create_instituciones(){        
        $this->actingAs($this->user);

        $data = Institucion::create([
            'nombre' =>'prueba1', 
            'direccion'=>'prueba de direccion', 
            'nivel'=>0, 
            'id_ubicacion'=>3,
            'encargado'=>null,
            'contacto'=>null,
            'correo'=>null,
            'observaciones'=>null,
            'estado'=>0,
        ]);

        $this->assertModelExists($data);
    }

    public function test_user_delete_instituciones(){      
        $institucion = Institucion::find(2);  
        $institucion->delete();
        $this->assertSoftDeleted($institucion);
    }

    public function test_user_others_functions(){    
        $institucion = Institucion::find(1);   
        
        $response = $this->actingAs($this->user)->get('/admin/institucion/'.$institucion->id.'/editar');
        $response->assertStatus(200);

    }
}
