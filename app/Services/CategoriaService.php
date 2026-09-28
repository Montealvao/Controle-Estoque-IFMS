<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{
    public function create(array $request): Categoria
    {
        return Categoria::create([
            'nome'->$request['nome'],
            'margem_lucro'->$request['margem_lucro'],
        ]);
    }
    public function update()
    {

    }
    public function delete()
    {

    }
}
