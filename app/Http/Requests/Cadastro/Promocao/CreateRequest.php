<?php

namespace App\Http\Requests\Cadastro\Promocao;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'nome' => 'required|max:500',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date',
            'situacao' => 'required',
            'pontuacao' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 500 caracteres',
            'data_inicio.required' => 'A Data Início é requerida',
            'data_inicio.date' => 'A Data Início não é válida',
            'data_fim.date' => 'A Data Fim não é válida',
            'situacao.required' => 'A Situação é requerida',
            'pontuacao.required' => 'A Pontuação é requerida',
            'pontuacao.integer' => 'A Pontuação é inválida',
        ];
    }
}
