<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# Classe Controller
use App\Http\Controllers\ApiController;

# Rota para retornar todos os registros de pessoas 
Route::get('/pessoas', [ApiController::class, 'getPessoas']);

# Rota para retornar um registros de pessoas pelo seu numero identificador (id)
Route::get('/pessoas/{id}', [ApiController::class, 'getPessoa']);

# Rota para criar um novo registo de pessoa na agenda
Route::post('pessoas', [ApiController::class, 'createPessoa']);

# Rota para atualizar os dados cadastrais da pessoa
Route::put('/pessoas/{id}', [ApiController::class, 'updatePessoa']);

# Rota para remover os dados da pessoa 
Route::delete('/pessoas/{id}', [ApiController::class, 'deletePessoa']);
