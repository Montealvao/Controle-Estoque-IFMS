<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService
{
    public function create(array $request): Produto
    {
        return Produto::create([
            'nome' => $request['nome'],
            'embalagem' => $request['embalagem'],
            'qtde_estoque' => $request['qtde_estoque'],
            'codigo_barra' => $request['codigo_barra'],
            'valor_compra' => $request['valor_compra'],
            'valor_venda' => $request['valor_venda'],
            'categoria_id' => $request['categoria_id'],
            'qtde_minima' => $request['qtde_minima'],
            'qtde_maxima' => $request['qtde_maxima']
        ]);
    }

    public function update(array $request, int $id): bool
    {
        $produto = Produto::findOrFail($id);

        return $produto->update([
            'nome' => $request['nome'],
            'embalagem' => $request['embalagem'],
            'qtde_estoque' => $request['qtde_estoque'],
            'codigo_barra' => $request['codigo_barra'],
            'valor_compra' => $request['valor_compra'],
            'valor_venda' => $request['valor_venda'],
            'categoria_id' => $request['categoria_id'],
            'qtde_minima' => $request['qtde_minima'],
            'qtde_maxima' => $request['qtde_maxima']
        ]);
    }
}
