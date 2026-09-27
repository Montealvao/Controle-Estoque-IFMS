<?php

namespace App\Services;

use App\Models\Fornecedor;

class FornecedorService
{
    public function create(array $request): Fornecedor
    {
        return Fornecedor::create([
            'razao_social' => $request['razao_social'],
            'nome_fantasia' => $request['nome_fantasia'],
            'endereco' => $request['endereco'],
            'fone' => $request['fone'],
            'email' => $request['email'],
            'cnpj' => $request['cnpj'],
        ]);
    }
}