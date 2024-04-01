<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Bodega;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BodegasSociosTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_bodegas_socios_list(){
        $response = $this->actingAs($this->user)->get('/admin/bodega_socio/insumos');
        $response->assertStatus(200);
    }

    public function test_user_create_bodegas(){        
        $this->actingAs($this->user);

        $data = Bodega::create([
            'nombre'=>'Frijol',
            'id_unidad_medida'=>1,
            'categoria'=>0,
            'saldo'=>0,
            'observaciones'=>null,
            'tipo_bodega'=>1,
            'id_institucion'=>2,    
        ]);

        $this->assertModelExists($data);
    }
    
    public function test_user_delete_bodegas(){  
        $bodega = Bodega::find(1);  
        $bodega->delete();
        $this->assertSoftDeleted($bodega);
    }
    

}
