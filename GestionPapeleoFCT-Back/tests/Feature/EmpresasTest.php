<?php

//Autor: Daniel

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmpresasTest extends TestCase {

    //Recuperar todas las empresas
    public function testGetEmpresas() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTI5NTJiYjlhOWUwZjRlYzgzZDYxYTJiOTRiNTllNTFmNzUxYzI2MDk1MTU0NjI0YTY1NGM3YjljYTBkOTU5ZDFmYTFlZTIyNzU1YjIxY2EiLCJpYXQiOiIxNjE1MzM4NDc4LjU2NzMxNyIsIm5iZiI6IjE2MTUzMzg0NzguNTY3MzIzIiwiZXhwIjoiMTY0Njg3NDQ3OC41NTg4NjgiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.L4v-wOjaToiboCvGNDv7xh1T09bGXDdZ1yYVYRwBFIEDOghuPp3clJ4bTKRm0557Jk3N612eb78LWnpXGnAsuBajQ2P83sdVsSw-cCoTYD5d87X_bRfX8wHp52Q6D3YhSn1TUQfClUQ_VS_P70cJjvnCz-MXW7UvAJNlhq3vvruJ6tndFRfizJsby-s6XccW-MvZ9e005X0XB2qhdw_-bO2YKtozqISyXy2_sZsg_MDRrT8SbyubjqdAZd7XyGbk0FZztARH4BTkDAW2Vv0Cf_sHqFyereU_30CPPmBPBpnLVUiLgZ7ekJMjEiPCGH-0W9BXbVEpxl_UOdkgFna_ir1rZt509LnlUb7baw79dVyvWJxQXjXkktKsnAM1-bBLu-BykWU0JFgBYbOXhfa7CNePOf2IPvULVWA219XjNa6pujwI_DQgMPrEkfGFGG83lKHVBBvXD7blr77T1EIq0SS3DxcfrJQ1qzWH-0I90jaOti415fGPLweIrEzmh6YXYdu4uYyi6bnrEBUzzi6D7P5UC8Vi3_tlsNK_N3uFMviixsE-3HkZOghiQG6iAyxA64LT8gUr_UFR10oIlammvMmcKj9odDjGbiIUaL9AVHCchCoxJCBF9k-e-2htuobUIC4UPUOoPq3cFzso6WivD0pyub459z8kxnD0to1_92g';

        $response = $this->withHeaders(array(
                    'Authorization' => 'Bearer ' . $token,
                ))->get('/api/empresas');


        $response->assertStatus(200);
    }

    //Insertar una empresa
    public function testInsertEmpresa() {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTI5NTJiYjlhOWUwZjRlYzgzZDYxYTJiOTRiNTllNTFmNzUxYzI2MDk1MTU0NjI0YTY1NGM3YjljYTBkOTU5ZDFmYTFlZTIyNzU1YjIxY2EiLCJpYXQiOiIxNjE1MzM4NDc4LjU2NzMxNyIsIm5iZiI6IjE2MTUzMzg0NzguNTY3MzIzIiwiZXhwIjoiMTY0Njg3NDQ3OC41NTg4NjgiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.L4v-wOjaToiboCvGNDv7xh1T09bGXDdZ1yYVYRwBFIEDOghuPp3clJ4bTKRm0557Jk3N612eb78LWnpXGnAsuBajQ2P83sdVsSw-cCoTYD5d87X_bRfX8wHp52Q6D3YhSn1TUQfClUQ_VS_P70cJjvnCz-MXW7UvAJNlhq3vvruJ6tndFRfizJsby-s6XccW-MvZ9e005X0XB2qhdw_-bO2YKtozqISyXy2_sZsg_MDRrT8SbyubjqdAZd7XyGbk0FZztARH4BTkDAW2Vv0Cf_sHqFyereU_30CPPmBPBpnLVUiLgZ7ekJMjEiPCGH-0W9BXbVEpxl_UOdkgFna_ir1rZt509LnlUb7baw79dVyvWJxQXjXkktKsnAM1-bBLu-BykWU0JFgBYbOXhfa7CNePOf2IPvULVWA219XjNa6pujwI_DQgMPrEkfGFGG83lKHVBBvXD7blr77T1EIq0SS3DxcfrJQ1qzWH-0I90jaOti415fGPLweIrEzmh6YXYdu4uYyi6bnrEBUzzi6D7P5UC8Vi3_tlsNK_N3uFMviixsE-3HkZOghiQG6iAyxA64LT8gUr_UFR10oIlammvMmcKj9odDjGbiIUaL9AVHCchCoxJCBF9k-e-2htuobUIC4UPUOoPq3cFzso6WivD0pyub459z8kxnD0to1_92g';

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
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTI5NTJiYjlhOWUwZjRlYzgzZDYxYTJiOTRiNTllNTFmNzUxYzI2MDk1MTU0NjI0YTY1NGM3YjljYTBkOTU5ZDFmYTFlZTIyNzU1YjIxY2EiLCJpYXQiOiIxNjE1MzM4NDc4LjU2NzMxNyIsIm5iZiI6IjE2MTUzMzg0NzguNTY3MzIzIiwiZXhwIjoiMTY0Njg3NDQ3OC41NTg4NjgiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.L4v-wOjaToiboCvGNDv7xh1T09bGXDdZ1yYVYRwBFIEDOghuPp3clJ4bTKRm0557Jk3N612eb78LWnpXGnAsuBajQ2P83sdVsSw-cCoTYD5d87X_bRfX8wHp52Q6D3YhSn1TUQfClUQ_VS_P70cJjvnCz-MXW7UvAJNlhq3vvruJ6tndFRfizJsby-s6XccW-MvZ9e005X0XB2qhdw_-bO2YKtozqISyXy2_sZsg_MDRrT8SbyubjqdAZd7XyGbk0FZztARH4BTkDAW2Vv0Cf_sHqFyereU_30CPPmBPBpnLVUiLgZ7ekJMjEiPCGH-0W9BXbVEpxl_UOdkgFna_ir1rZt509LnlUb7baw79dVyvWJxQXjXkktKsnAM1-bBLu-BykWU0JFgBYbOXhfa7CNePOf2IPvULVWA219XjNa6pujwI_DQgMPrEkfGFGG83lKHVBBvXD7blr77T1EIq0SS3DxcfrJQ1qzWH-0I90jaOti415fGPLweIrEzmh6YXYdu4uYyi6bnrEBUzzi6D7P5UC8Vi3_tlsNK_N3uFMviixsE-3HkZOghiQG6iAyxA64LT8gUr_UFR10oIlammvMmcKj9odDjGbiIUaL9AVHCchCoxJCBF9k-e-2htuobUIC4UPUOoPq3cFzso6WivD0pyub459z8kxnD0to1_92g';

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
