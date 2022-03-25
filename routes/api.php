<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# Classe Controller
use App\Http\Controllers\ApiController;

Route::get('/pessoas', 'ApiController@getPessoas');
Route::get('/pessoas/{id}', 'ApiController@getPessoa');

# Rota para criar um novo registo de pessoa na agenda
Route::post('pessoas', [ApiController::class, 'createPessoa']);

Route::put('/pessoas/{id}', 'ApiController@updatePessoas');
Route::delete('/pessoas/{id}', 'ApiController@deletePessoas');
