<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Models\Categoria;


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

    }


    public function store()
    {
    }

    public function edit()
    {


    }


    public function update()
    {

    }



    public function destroy()
    {

    }
}
