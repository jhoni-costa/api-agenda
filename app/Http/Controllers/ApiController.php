<?php
/**
 * @author Jhoni Regis Souza da Costa
 * @since 2022-03-24
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class ApiController extends Controller{
    
    public function getPessoas(){

    }
    
    /**
     * @info Metodo para criar um novo cadatro de pessoa
     */
    public function createPessoa(Request $request){
        $pessoa = new Pessoa;
        $pessoa->nome = $request->nome;
        $pessoa->data_nascimento = $request->data_nascimento;
        $pessoa->endereco = $request->endereco;
        $pessoa->telefone = $request->telefone;
        $pessoa->email = $request->email;

        $pessoa->save();

        return response()->json(["message"=>"Pessoa cadastrada com sucesso!"],201);
    }

    public function getPessoa($id){

    }

    public function updatePessoa(Request $request, $id){

    }

    public function deletePessoa($id){

    }
}
