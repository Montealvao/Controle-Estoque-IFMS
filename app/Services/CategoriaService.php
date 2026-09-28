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
    public function update(array $request, int $id): bool
    {
        $categoria = Categoria::findOrFail($id);

        return $categoria->update([
            'nome' => $request['nome'],
            'margem_lucro' => $request['margem_lucro'],
        ]);
    }

    public function delete(int $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();
    }
}
