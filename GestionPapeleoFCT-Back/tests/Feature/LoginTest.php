<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase {

    /**
     * A basic feature test example.
     *  By: María
     * @test
     */
    function login_cuenta_existente() {
        $response = $this->postJson('/api/login', array('email' => 'director@gmail.com', 'password' => '12345678'));

        $json = json_decode($response->getContent());
        //dump($json->message->datos_user);

        $response->assertStatus(200);
        $this->assertTrue($json->message->user->id == 1);
        $this->assertTrue($json->message->user->dni == '99999999X');
        $this->assertTrue($json->message->user->email == 'director@gmail.com');
        $this->assertTrue($json->message->datos_user->correo == 'director@gmail.com');
    }

    /**
     * A basic feature test example.
     * By: María
     * @test
     */
    function login_cuenta_inexistente() {
        $response = $this->postJson('/api/login', array('email' => 'directorr@gmail.com', 'password' => '12345678'));

        $json = json_decode($response->getContent());
        //dump($response->getContent());

        $response->assertStatus(400);
        $this->assertTrue($json->message == 'Login incorrecto. Revise las credenciales.');
    }
    
    

}
