<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'unique:produtos', 'min:3', 'max:100'],
            'qtde_estoque' => ['integer'],
            'codigo_barra' => ['required', 'unique:produtos', 'size:13'],
            'valor_compra' => ['required', 'numeric', 'min:0'],
            'valor_venda' => ['required', 'numeric', 'min:0'],
            'categoria_id' => ['exists:App\Models\Categoria,id'],
            'qtde_minima' => ['nullable', 'integer'],
            'qtde_maxima' => ['nullable', 'integer']

        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Este nome de produto já está cadastrado.',
            'nome.min' => 'O nome deve possuir no mínimo 3 caracteres.',
            'nome.max' => 'O nome não pode possuir mais de 100 caracteres.',

            'qtde_estoque.integer' => 'A quantidade em estoque deve ser um número inteiro.',

            'codigo_barra.required' => 'O código de barras é obrigatório.',
            'codigo_barra.unique' => 'Este código de barras já está cadastrado.',
            'codigo_barra.size' => 'O código de barras deve possuir exatamente 13 caracteres.',

            'valor_compra.required' => 'O valor de compra é obrigatório.',
            'valor_compra.numeric' => 'O valor de compra deve ser um número válido.',
            'valor_compra.min' => 'O valor de compra não pode ser negativo.',

            'valor_venda.required' => 'O valor de venda é obrigatório.',
            'valor_venda.numeric' => 'O valor de venda deve ser um número válido.',
            'valor_venda.min' => 'O valor de venda não pode ser negativo.',

            'categoria_id.exists' => 'A categoria selecionada não é válida ou não existe.',

            'qtde_minima.integer' => 'A quantidade mínima deve ser um número inteiro.',

            'qtde_maxima.integer' => 'A quantidade máxima deve ser um número inteiro.',
        ];
    }
}
