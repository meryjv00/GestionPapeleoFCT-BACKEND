<?php

//Autor: Daniel

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistroTest extends TestCase
{
    //Registro de usuario. Devuelve los datos correctos
    public function testRegistroValido() {
        //Usuario con valores aleatorios
        $alea = rand(10000000, 99999999);
        $dniA = $alea . 'A';
        $correoA = $alea . '@gmail.com';
                
        $response = $this->postJson('/api/register', array('dni' => $dniA, 'email' => $correoA, 'password' => 'hola', 'activado' => 0));

        
        $json = json_decode($response->getContent());
        
        //Codigo 201
        $response->assertStatus(201);
        
        //Dni correcto
        $this->assertTrue($json->message->user->dni == $dniA);
        //Email correcto
        $this->assertTrue($json->message->user->email == $correoA);
        //Mensaje de correcto
        $this->assertTrue($json->message->correcto);
        
    }
    
    //Error por correo repetido Middleware notUser
    public function testRegistroInvalido() {
        $response = $this->postJson('/api/register', array('dni' => '05999032N', 'email' => 'director@gmail.com', 'password' => 'hola', 'activado' => 0));
        //dump($response->getContent());
        
        $response->assertStatus(518);
    }
    
}
