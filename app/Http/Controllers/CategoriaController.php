<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;


class CategoriaController extends Controller
{
    public function __construct(
        private CategoriaService $categoriaService
    ) {
    }

    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }


    public function create()
    {
        return view('categoria.create');
    }


    public function store(CategoriaRequest $request)
    {
        $this->categoriaService->create($request->validated());
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria cadastrado com sucesso.');
    }

    public function edit(int $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }


    public function update(CategoriaRequest $request, int $id)
    {
        $this->categoriaService->update($request->validated(), $id);
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria editado com sucesso.');
    }



    public function destroy()
    {

    }
}
