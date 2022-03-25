<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model {
    protected $table = "pessoas";

    protected $fillable = ['nome', 'data_nascimento','endereco','telefone','email'];
}
