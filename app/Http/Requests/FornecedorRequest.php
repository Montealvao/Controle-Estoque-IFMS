<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'razao_social' => [
                'required',
                'string',
                'max:255',
            ],

            'nome_fantasia' => [
                'required',
                'string',
                'max:255',
            ],

            'endereco' => [
                'required',
                'string',
                'max:255',
            ],

            'fone' => [
                'required',
                'string',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'cnpj' => [
                'required',
                'cnpj',
            ],
        ];
    }
}