<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CursosTest extends TestCase {

    /**
     * A basic feature test example.
     * By: María
     * @test
     */
    public function lista_cursos_correcta() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';
        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->get('/api/cursos');

        $json = json_decode($response->getContent());
        //dump($json->message);

        $response->assertStatus(200);
        $this->assertTrue(count($json->message) == 24);
    }

    /**
     * A basic feature test example.
     * By: María
     * @test
     */
    public function insercion_cursos_correcta() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';
        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->post('/api/curso', array('cicloFormativo' => 'Ciclo Prueba', 'cicloFormativoA' => 'CP', 'familiaProfesional' => 'Familia Prueba', 'nHoras' => '500',
            'dniTutor' => '99999999X', 'cursoAcademico' => '2020/2021'));

        $json = json_decode($response->getContent());
        dump($json);

        $response->assertStatus(201);
        $this->assertTrue($json->message == 'Datos insertados correctamente');
    }

    /**
     * A basic feature test example.
     * By: María
     * @test
     */
    public function delete_cursos_existente() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';
        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->delete('/api/curso/23');

        $json = json_decode($response->getContent());
        dump($json);

        $response->assertStatus(201);
        $this->assertTrue($json->message == 'Curso eliminado correctamente');
    }

    /**
     * A basic feature test example.
     * By: María
     * @test
     */
    public function delete_cursos_inexistente() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZDMyZDllMDkwYmMzNWRiZjVjNDJkNDU0ZjEwNWU2ZjZkYmQxYTBkNjA1NTNjN2YxMGQyZmNkMTBmYzFiNGI0ZmE4OTIxYTAwMmRiNThiYzUiLCJpYXQiOiIxNjE1MzQ4ODk5LjMyNzc1NyIsIm5iZiI6IjE2MTUzNDg4OTkuMzI3NzYzIiwiZXhwIjoiMTY0Njg4NDg5OS4zMjA2NTciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gRTZdjC5Y7ipsvOcac-miwFNcp3qnfh369HqsTvC-EymXOk2-aMGMK1ka5thHJjyJevKPwi43RLlUCvKFPG2-y6w_i5Kia4XjKpnhFczuL4CCnUN1HF4EobfpKiT51kG_h1c4O2GcwEnGaobBbyWzdBySXEmVeqK2Rjkxlamlz5ZiDSKL-VpJI3PqMZeSfkm8GibuItWFGEEGqO4S0eMWGI1oSGFArnLBTEYrTgmftgB_4a0HVZ7iKHbvqgq3OUxBJctO1ddkkt5JNQVLCMCun9-0zmWmjDcLRhG3OKRDfGGyJqaRCaAAD-hmb4aDiOEVe_FUBXb1JZirfD_uYkeu0c5uPVph2DcUk1vAUkLeJ-_4722dqvhV2bgIlu3uTVueJv91hK46ZgoXuK9hB706bIZf11s8L20vue6Sa8rrVE2ZfyeUmdOHmZJCdU5tIzPFoLSnRRiAjrk8-NH2VWo1iJ4J_mwNBmDqKg7YRWLnaF-4XxXkWSGzbqhiutvrR-l8yG_Tej7dwOpbCZt3xMCcLOfSuoml6i4m4xfcEJ4ske1YEl9y2olv-aXdG8nrUNixhAhEtzTaQAPwv8sBiyPIR-b2qSVFBUSdQzWE_s5uojqgbIBR6B_d-wRyJLxHtxkRfik3YXBcyKD4scvkDRvUsGMS9kTV0YsCT0CqjXJShg';
        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->delete('/api/curso/30');

        $json = json_decode($response->getContent());
        dump($json);

        $response->assertStatus(400);
        $this->assertTrue($json->message == 'No se ha podido eliminar el curso 30');
    }

}
