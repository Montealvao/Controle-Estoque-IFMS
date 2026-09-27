<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Http\Requests\FornecedorRequest;
use App\Services\FornecedorService;

class FornecedorController extends Controller
{
    public function __construct(
        private FornecedorService $fornecedorService
    ) {}


    public function create()
    {
        return view('admin.fornecedores.create');
    }

    public function store(FornecedorRequest $request)
    {
        $this->fornecedorService->create($request->validated());
        return redirect()->route('admin.fornecedores.index')
          ->with('success', 'Fornecedor cadastrado com sucesso.');
    }
}
