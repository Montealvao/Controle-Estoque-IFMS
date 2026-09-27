<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Http\Requests\FornecedorRequest;
use App\Services\FornecedorService;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function __construct(
        private FornecedorService $fornecedorService
    ) {}

    public function index(Request $request)
    {
        $busca = $request->busca;

        $fornecedores = Fornecedor::query()
            ->when($busca, function ($query, $busca) {
                $query->where(function ($query) use ($busca) {
                    $query->where('razao_social', 'ilike', "%{$busca}%")
                        ->orWhere('nome_fantasia', 'ilike', "%{$busca}%")
                        ->orWhere('cnpj', 'ilike', "%{$busca}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.fornecedores.index', compact('fornecedores'));
    }

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
