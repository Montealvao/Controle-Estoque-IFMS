<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function __construct(
        private ProdutoService $produtoService
    ) {
    }

    public function index()
    {
        $produtos = Produto::with('categoria')->get();

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('name')->get();
        return view('produtos.create', compact('categorias'));
    }

    public function store(ProdutoRequest $request)
    {
        $this->produtoService->create($request->validated());
        return redirect()->route('produtos.index');
    }

    public function show(Produto $produto)
    {
        //
    }

    public function edit(Produto $produto)
    {
        //
    }

    public function update(Request $request, Produto $produto)
    {
        //
    }

    public function destroy(Produto $produto)
    {
        //
    }
}
