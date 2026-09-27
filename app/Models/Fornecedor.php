<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'endereco',
        'fone',
        'email',
        'cnpj'
    ];
}
