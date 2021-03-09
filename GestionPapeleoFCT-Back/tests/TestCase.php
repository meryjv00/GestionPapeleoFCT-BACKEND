<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Http\Controllers\API\AuthController;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    public function testCanonico() {
         $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->post('/register', [ 'dni' => 'dni', 'email'=> 'email', 'password'=> 'password' , 'activado'=> 0 ]);
         
         $response->assertStatus(201);
    }
}
