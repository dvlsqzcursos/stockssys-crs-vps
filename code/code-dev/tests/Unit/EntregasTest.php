<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Entrega;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class EntregasTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_entregas_list(){
        $response = $this->actingAs($this->user)->get('/admin/entregas');
        $response->assertStatus(200);
    }

    public function test_user_create_entregas(){        
        $this->actingAs($this->user);

        $data = Entrega::create([
            'correlativo'=>2,
            'mes_inicial'=>2,
            'mes_final'=>4,
            'dias_a_cubrir'=>60,
            'year'=>2024,
            'id_socio'=>2
        ]);

        $this->assertModelExists($data);
    }
    
    public function test_user_delete_entregas(){  
        $entrega = Entrega::find(1);  
        $entrega->delete();
        $this->assertSoftDeleted($entrega);
    }
    

    public function test_user_others_functions(){  
        $entrega = Entrega::find(1);   
        
        $response = $this->actingAs($this->user)->get('/admin/entrega/'.$entrega->id.'/editar');
        $response->assertStatus(200);

    }

    
}
