<?php

//Autor: Daniel

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmpresasTest extends TestCase {

    //Recuperar todas las empresas
    public function testGetEmpresas() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';

        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->get('/api/empresas');


        $response->assertStatus(200);
    }

    //Insertar una empresa
    public function testInsertEmpresa() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';

        $tlfA = rand(600000000, 699999999);
        $correoA = $tlfA . '@gmail.com';

        $empresa = array(
            'empresa' => array('nombre' => 'empresa1',
                'provincia' => 'Cadiz',
                'localidad' => 'Conil',
                'calle' => 'Sebastian',
                'cp' => '12200',
                'cif' => '23198738213',
                'tlf' => $tlfA,
                'email' => $correoA,
                'dniRepresentante' => '02999382O',
                'nombreRepresentante' => 'Pedro')
        );

        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->post('/api/insertEmpresa', $empresa);

        $response->assertStatus(201);

        //Mensaje correcto
        $json = json_decode($response->getContent());
        //Mensaje correcto
        $this->assertTrue($json->message == 'Datos insertados correctamente');
        //Empresa creada con tlf y correo correctos
        $this->assertTrue($json->empresa->tlf == $tlfA);
        $this->assertTrue($json->empresa->email == $correoA);
    }

    //Eliminar una empresa
    public function testDeleteEmpresa() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';

        //Crea una empresa
        $tlfA = rand(600000000, 699999999);
        $correoA = $tlfA . '@gmail.com';

        $empresa = array(
            'empresa' => array('nombre' => 'empresa1',
                'provincia' => 'Cadiz',
                'localidad' => 'Conil',
                'calle' => 'Sebastian',
                'cp' => '12200',
                'cif' => '23198738213',
                'tlf' => $tlfA,
                'email' => $correoA,
                'dniRepresentante' => '02999382O',
                'nombreRepresentante' => 'Pedro')
        );

        $respuestaEmpresa = $this->withHeaders(array(
            'Authorization' => 'Bearer ' . $token,
        ))->post('/api/insertEmpresa', $empresa);
        
        $empresa = json_decode($respuestaEmpresa->getContent());
        
        //ELIMINA LA EMPRESA RECIEN CREADA
        $response = $this->withHeaders(array(
            'Authorization' => 'Bearer ' . $token,
        ))->post('/api/deleteEmpresa/' . $empresa->empresa->id);
        
        $response->assertStatus(201);
    }

}
