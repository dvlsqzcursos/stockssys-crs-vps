<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Escuela;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class EscuelasTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_escuelas_list(){
        $response = $this->actingAs($this->user)->get('/admin/escuelas');
        $response->assertStatus(200);
    }

    public function test_user_create_escuelas(){        
        $this->actingAs($this->user);

        $data = Escuela::create([
            'jornada'=>0,
            'codigo'=>'08-07-9615-89',
            'nombre'=>'EORM Escuela Prueba',
            'direccion'=>'prueba de direccion',
            'id_ubicacion'=>5,
            'director'=>'Juan Ortiz',
            'contacto_no1'=>55606679,
            'contacto_no2'=>55606678,
            'no_ninos_pre'=>25,
            'no_ninas_pre'=>25,
            'no_ninos_pri'=>25,
            'no_ninas_pri'=>25,
            'no_lideres'=>2,
            'no_voluntarios'=>10,
            'no_total_beneficiarios'=>100,
            'observaciones'=>null,        
            'estado'=>0,
            'id_socio'=>2
        ]);

        $this->assertModelExists($data);
    }

    public function test_user_delete_escuelas(){      
        $escuela = Escuela::find(1);  
        $escuela->delete();
        $this->assertSoftDeleted($escuela);
    }

    public function test_user_others_functions(){    
        $escuela = Escuela::find(1);   
        
        $response = $this->actingAs($this->user)->get('/admin/escuela/'.$escuela->id.'/editar');
        $response->assertStatus(200);

    }
}
