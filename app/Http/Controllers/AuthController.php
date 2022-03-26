<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller {
    
    /**
     * @info Cria uma nova instancia da classe
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @info Obtem um JWT pelas credenciais fornecidas
     * @return Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validador::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(! $token = auth()->attempt($validator->validated())){
            return response()->json(['error' => 'Não autorizado'], 401);
        }
    }

    /**
     * @info Registra um usuário
     * @return Http\JsonResponse
     */
    public function register(Request $request){
        $validator = Validator::make($require->all(),[
           'name'  => 'required|string|between:2,100',
           'email' => 'required|string|email|max:100|unique:users',
           'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'Usuário logado com sucesso!',
            'user' => $user
        ], 201);
    }
    /**
     * @info Desloga o usuário
     * @return Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'Usuário deslogado com sucesso!']);
    }
    /**
     * @info Atualiza o token
     * @return Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * @info Obtem o usuário autenticado
     * @return Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * @infor Obtem a estrutura do token
     * @param  string $token
     * @return Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
