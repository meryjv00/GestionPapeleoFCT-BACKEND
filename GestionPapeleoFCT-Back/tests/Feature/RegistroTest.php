<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistroTest extends TestCase
{
    //Registro de usuario
    public function testRegistroValido() {

        $response = $this->postJson('/api/register', array('dni' => '00999000N', 'email' => '12300567890@a.com', 'password' => 'hola', 'activado' => 0));
        dump($response->getContent());
        
        $response->assertStatus(201);
    }
    
    //Error por correo repetido Middleware notUser
    public function testRegistroInvalido() {
        $response = $this->postJson('/api/register', array('dni' => '05999032N', 'email' => 'director@gmail.com', 'password' => 'hola', 'activado' => 0));
        //dump($response->getContent());
        
        $response->assertStatus(518);
    }
}
