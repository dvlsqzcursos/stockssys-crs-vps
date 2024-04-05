<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrimeraPrueba extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function primera_prueba(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
