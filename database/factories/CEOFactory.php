<?php

use App\CEO;
use Faker\Generator as Faker;

$factory->define(CEO::class, function (Faker $faker) {
    return [
        'nome' => $faker->nome,
        'data_nascimento' => $faker->data_nascimento,
        'endereco' => $faker->endereco,
        'telefone' => $faker->telefone,
        'email' => $faker->email
    ];
});