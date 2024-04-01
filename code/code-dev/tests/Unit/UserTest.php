<?php

namespace Tests\Unit;

use Tests\TestCase;
use Auth, Artisan;
use App\Models\User, App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    private $user;

    public function setUp(): void
    {
        parent::setUp();        
        $this->user=User::find(1);
    }

    public function test_user_see_users_list(){
        $response = $this->actingAs($this->user)->get('/admin/usuarios');
        $response->assertStatus(200);
    }

    public function test_user_create_users(){        
        $this->actingAs($this->user);

        $data = Usuario::create([
            'nombres'=>'usuario',
            'apellidos'=>'prueba',
            'contacto'=>null,
            'correo'=>null,
            'puesto'=>null,
            'id_institucion'=>1,
            'usuario'=>'usuario.prueba1',
            'password'=>'Ssys.2024',
            'pin'=>'1234',
            'permisos'=>"{'panel_principal:true'}",
            'estado'=>0,
        ]);

        $this->assertModelExists($data);
    }

    public function test_user_delete_users(){      
        $usuario = Usuario::find(2);  
        $usuario->delete();
        $this->assertSoftDeleted($usuario);
    }

    public function test_user_others_functions(){    
        $usuario = Usuario::find(2);   
        
        $response = $this->actingAs($this->user)->get('/admin/usuario/'.$usuario->id.'/editar');
        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get('/admin/usuario/'.$usuario->id.'/permisos');
        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get('/admin/usuario/'.$usuario->id.'/rest-contra');        

        $response = $this->actingAs($this->user)->get('/admin/usuario/'.$usuario->id.'/rest-pin');

        $response = $this->actingAs($this->user)->get('/admin/usuario/'.$usuario->id.'/suspender');

    }
}
