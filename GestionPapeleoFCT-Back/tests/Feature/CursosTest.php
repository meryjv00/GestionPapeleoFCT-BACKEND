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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTMyMzM5YTdmOTYxZDYxZTBiMDU0NjAzOWVlNzBmYmY2NDNjMzI4NGJkZWNkYzVkYjZjZGUxNzgyMzhmMTk2MDgwNWMzZGFlNmU1ZjQ0OWEiLCJpYXQiOiIxNjE1MzM5MTk2Ljc1MzY4MyIsIm5iZiI6IjE2MTUzMzkxOTYuNzUzNjk3IiwiZXhwIjoiMTY0Njg3NTE5Ni42OTM2NzciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.wXGl0qZaHHO-yRmJJpZVY965dls7BZJHKZKWkpwYrN_HyoY3eNUoQQr6dAUoOHRMS3QV-DNXMmTPCoiwswaDvFw-ecOB-JCGDY1RbgPtq4z5qcvguL0drNzXiU49vtbo0In8ViPTOYpuPgD14JigE-jk_fTtNgGXVjiBdPaXOOuz-XF6fFtYuCMGFW8vr_Z2AzPW_8jflSVqMJmryO7F4FEdiI4nadee59s1ULzCvc3fLUna7SolIszQz8pPAO6rnW6yt5DdexfuQKfstkU8IyfJS19KLMrwYJiDBsyHZsvONC7XEbJUDue8Cw47FGW4ECBY7ybfZvmDrAwBLGEpgXL06DO-UyxhZaQL_0ELE4GlkAWBquBc6nQUE9qyiU6zcxPxwPNfCZFHVtXyjO2km3tEKnVnxSXjE0HzxEk_Bz7KmHqEo5O6LYhe0wTreoSzZ5Nlx5RivgsfaTDujQXylvCVOWvoVwNmegc0AW5DKl1FqpLka3fL3WaxXKLl8QbgWhbi2yyHpEMeEBUtmOpjw550PJWjnRvzl3v-EW7wImdEo9veuF9smTC5ZjFMhOVdxSgzlcmBPOFyYoBuhCrgc2K9LcdP-uR6cZLdFszjHb9WgUZNB2vdKfzgGxzv9QibD_m7yMoOoSiIOrqziCiKukilQvhx1qBbO1LsMtQ7Fl8';
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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTMyMzM5YTdmOTYxZDYxZTBiMDU0NjAzOWVlNzBmYmY2NDNjMzI4NGJkZWNkYzVkYjZjZGUxNzgyMzhmMTk2MDgwNWMzZGFlNmU1ZjQ0OWEiLCJpYXQiOiIxNjE1MzM5MTk2Ljc1MzY4MyIsIm5iZiI6IjE2MTUzMzkxOTYuNzUzNjk3IiwiZXhwIjoiMTY0Njg3NTE5Ni42OTM2NzciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.wXGl0qZaHHO-yRmJJpZVY965dls7BZJHKZKWkpwYrN_HyoY3eNUoQQr6dAUoOHRMS3QV-DNXMmTPCoiwswaDvFw-ecOB-JCGDY1RbgPtq4z5qcvguL0drNzXiU49vtbo0In8ViPTOYpuPgD14JigE-jk_fTtNgGXVjiBdPaXOOuz-XF6fFtYuCMGFW8vr_Z2AzPW_8jflSVqMJmryO7F4FEdiI4nadee59s1ULzCvc3fLUna7SolIszQz8pPAO6rnW6yt5DdexfuQKfstkU8IyfJS19KLMrwYJiDBsyHZsvONC7XEbJUDue8Cw47FGW4ECBY7ybfZvmDrAwBLGEpgXL06DO-UyxhZaQL_0ELE4GlkAWBquBc6nQUE9qyiU6zcxPxwPNfCZFHVtXyjO2km3tEKnVnxSXjE0HzxEk_Bz7KmHqEo5O6LYhe0wTreoSzZ5Nlx5RivgsfaTDujQXylvCVOWvoVwNmegc0AW5DKl1FqpLka3fL3WaxXKLl8QbgWhbi2yyHpEMeEBUtmOpjw550PJWjnRvzl3v-EW7wImdEo9veuF9smTC5ZjFMhOVdxSgzlcmBPOFyYoBuhCrgc2K9LcdP-uR6cZLdFszjHb9WgUZNB2vdKfzgGxzv9QibD_m7yMoOoSiIOrqziCiKukilQvhx1qBbO1LsMtQ7Fl8';
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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTMyMzM5YTdmOTYxZDYxZTBiMDU0NjAzOWVlNzBmYmY2NDNjMzI4NGJkZWNkYzVkYjZjZGUxNzgyMzhmMTk2MDgwNWMzZGFlNmU1ZjQ0OWEiLCJpYXQiOiIxNjE1MzM5MTk2Ljc1MzY4MyIsIm5iZiI6IjE2MTUzMzkxOTYuNzUzNjk3IiwiZXhwIjoiMTY0Njg3NTE5Ni42OTM2NzciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.wXGl0qZaHHO-yRmJJpZVY965dls7BZJHKZKWkpwYrN_HyoY3eNUoQQr6dAUoOHRMS3QV-DNXMmTPCoiwswaDvFw-ecOB-JCGDY1RbgPtq4z5qcvguL0drNzXiU49vtbo0In8ViPTOYpuPgD14JigE-jk_fTtNgGXVjiBdPaXOOuz-XF6fFtYuCMGFW8vr_Z2AzPW_8jflSVqMJmryO7F4FEdiI4nadee59s1ULzCvc3fLUna7SolIszQz8pPAO6rnW6yt5DdexfuQKfstkU8IyfJS19KLMrwYJiDBsyHZsvONC7XEbJUDue8Cw47FGW4ECBY7ybfZvmDrAwBLGEpgXL06DO-UyxhZaQL_0ELE4GlkAWBquBc6nQUE9qyiU6zcxPxwPNfCZFHVtXyjO2km3tEKnVnxSXjE0HzxEk_Bz7KmHqEo5O6LYhe0wTreoSzZ5Nlx5RivgsfaTDujQXylvCVOWvoVwNmegc0AW5DKl1FqpLka3fL3WaxXKLl8QbgWhbi2yyHpEMeEBUtmOpjw550PJWjnRvzl3v-EW7wImdEo9veuF9smTC5ZjFMhOVdxSgzlcmBPOFyYoBuhCrgc2K9LcdP-uR6cZLdFszjHb9WgUZNB2vdKfzgGxzv9QibD_m7yMoOoSiIOrqziCiKukilQvhx1qBbO1LsMtQ7Fl8';
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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTMyMzM5YTdmOTYxZDYxZTBiMDU0NjAzOWVlNzBmYmY2NDNjMzI4NGJkZWNkYzVkYjZjZGUxNzgyMzhmMTk2MDgwNWMzZGFlNmU1ZjQ0OWEiLCJpYXQiOiIxNjE1MzM5MTk2Ljc1MzY4MyIsIm5iZiI6IjE2MTUzMzkxOTYuNzUzNjk3IiwiZXhwIjoiMTY0Njg3NTE5Ni42OTM2NzciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.wXGl0qZaHHO-yRmJJpZVY965dls7BZJHKZKWkpwYrN_HyoY3eNUoQQr6dAUoOHRMS3QV-DNXMmTPCoiwswaDvFw-ecOB-JCGDY1RbgPtq4z5qcvguL0drNzXiU49vtbo0In8ViPTOYpuPgD14JigE-jk_fTtNgGXVjiBdPaXOOuz-XF6fFtYuCMGFW8vr_Z2AzPW_8jflSVqMJmryO7F4FEdiI4nadee59s1ULzCvc3fLUna7SolIszQz8pPAO6rnW6yt5DdexfuQKfstkU8IyfJS19KLMrwYJiDBsyHZsvONC7XEbJUDue8Cw47FGW4ECBY7ybfZvmDrAwBLGEpgXL06DO-UyxhZaQL_0ELE4GlkAWBquBc6nQUE9qyiU6zcxPxwPNfCZFHVtXyjO2km3tEKnVnxSXjE0HzxEk_Bz7KmHqEo5O6LYhe0wTreoSzZ5Nlx5RivgsfaTDujQXylvCVOWvoVwNmegc0AW5DKl1FqpLka3fL3WaxXKLl8QbgWhbi2yyHpEMeEBUtmOpjw550PJWjnRvzl3v-EW7wImdEo9veuF9smTC5ZjFMhOVdxSgzlcmBPOFyYoBuhCrgc2K9LcdP-uR6cZLdFszjHb9WgUZNB2vdKfzgGxzv9QibD_m7yMoOoSiIOrqziCiKukilQvhx1qBbO1LsMtQ7Fl8';
        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->delete('/api/curso/30');

        $json = json_decode($response->getContent());
        dump($json);

        $response->assertStatus(400);
        $this->assertTrue($json->message == 'No se ha podido eliminar el curso 30');
    }

}
