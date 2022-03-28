<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use GuzzleHttp\Client;
use Tests\TestCase;
use App\Pessoa;

class ApiControllerTest extends TestCase{
    
    /** Cria uma função de teste inserindo um registro de pessoa */
    public function testCreatePessoa(){

        $dataTest = [
            "nome" => "Jhoni Costa",
            "data_nascimento" => "1991-08-27",
            "endereco" => "Miguel Bertolino Pizzato 2656",
            "telefone" => "41999440442",
            "email" => "jhonirsc@gmail.com"
        ];

        $pessoa = factory(\App\Pessoa::class)->create();
        $response = $this->actingAs($pessoa, 'api')->json('POST', '/api/pessoas',$dataTest);
//        $response = $this->json('POST', '/api/pessoas', $dataTest);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Pessoa Cadastrada"]);
        $response->assertJson(['data' => $dataTeste]);
        
    }

    /** Função de teste para listagem de todo os registros de pessoas  */
    public function testGetPessoa(){
        $response = $this->json('GET', '/api/pessoas', ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure([['id','nome','data_nascimento','endereco','telefone','email']]);
    }
    
    /** Função de teste para update dos registro de pessoas  */
    public function testUpdatePessoa(){
        $response = $this->json('GET', '/api/pessoas');
        $response->assertStatus(200);
        
        $pessoa = $response->getData()[0];
        
        $new = factory(\App\Pessoa::class)->create();
        $update = $this->actingAs($new, 'api')->json('PATCH', '/api/pessoas/'.$pessoa->id,['nome' => "Nome Teste"]);
        $update->assertStatus(200);
        $update->assertJson(['message' => "Dados Atualizados!"]);
    } 
    
    /** Função de teste para remover um registro de pessoa */
    public function testDeleteProduct(){
        $response = $this->json('GET', '/api/pessoas');
        $response->assertStatus(200);

        $pessoa = $response->getData()[0];

        $new = factory(\App\Pessoa::class)->create();
        $delete = $this->actingAs($new, 'api')->json('DELETE', '/api/pessoas/'.$product->id);
        $delete->assertStatus(200);
        $delete->assertJson(['message' => "Pessoa Removida!"]);
    }
}
