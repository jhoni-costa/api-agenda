<?php
/**
 * @author Jhoni Regis Souza da Costa
 * @since 2022-03-24
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class ApiController extends Controller{
    
    /**
     * @info Metodo para retornar todos os registros de pessoas cadastrados
     */
    public function getPessoas(){
        $pessoas = Pessoa::get()->toJson(JSON_PRETTY_PRINT);
        return response($pessoas, 200);
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

    /**
     * @info Metodo para retornar cadastro de pessoa pelo seu identificador (id)
     */
    public function getPessoa($id){
        if(Pessoa::where('id',$id)->exists()){
            $pessoa = Pessoa::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($pessoa,200);
        }else{
            return response()->json(["message"=>"Pessoa não encontrada"],404);
        }
    }
    
    /**
     * @info Metodo para atualizar os dados de uma pessoa pelo seu identificador (id)
     */
    public function updatePessoa(Request $request, $id){
        if(Pessoa::where('id',$id)->exists()){
            $pessoa = Pessoa::find($id);
            $pessoa->nome = is_null($request->nome) ? $pessoa->nome : $request->nome;
            $pessoa->data_nascimento = is_null($request->data_nascimento) ? $pessoa->data_nascimento : $request->data_nascimento;
            $pessoa->endereco = is_null($request->endereco) ? $pessoa->endereco : $request->endereco;
            $pessoa->telefone = is_null($request->telefone) ? $pessoa->telefone : $request->telefone;
            $pessoa->email = is_null($request->email) ? $pessoa->email : $request->email;
            $pessoa->update();
            
            return response()->json(["messege"=>"Dados atualizados com sucesso!"],200);
        }else{
            return response()->json(["messege"=>"Pessoa não encontrada!"],404);
        }
    }
    
    /**
     * @info Metodo para exclusão do registro de uma pessoa
     */
    public function deletePessoa($id){
        if(Pessoa::where('id',$id)->exists()){
            $pessoa = Pessoa::find($id);
            $pessoa->delete();
            
            return response()->json(["message"=>"Dados excluidos com sucesso"],202);
        }else{
            return response()->json(["message"=>"Pessoa não encontrada!"],404);
        }
    }
}
