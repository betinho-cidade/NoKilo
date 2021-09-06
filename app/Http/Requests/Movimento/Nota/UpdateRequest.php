<?php

namespace App\Http\Requests\Movimento\Nota;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'franquia' => 'required',
            'data_nota' => 'required_if:situacao,A|nullable|date',
            'valor' => 'required_if:situacao,A|nullable|regex:/^\d+(\.\d{1,2})?$/',
            'situacao' => 'required',
            'motivo_reprovacao' => 'required_if:situacao,R|nullable|max:500',
        ];
    }

    public function messages()
    {
        return [
            'franquia.required' => 'A Fraquia é requerida',
            'situacao.required' => 'A Situaçao é requerida',
            'data_nota.required_if' => 'A Data da Nota é requerida para que a mesma seja APROVADA',
            'data_nota.date' => 'A Data da Nota é inválida',
            'valor.required_if' => 'O Valor da Nota é requerido para que a mesma seja APROVADA',
            'valor.regex' => 'O Valor da Nota é inválido. Formato 99.99',
            'motivo_reprovacao.required_if' => 'O Motivo de Reprovação é requerido para que a Nota seja REPROVADA',
            'motivo_reprovacao.max' => 'O tamanho permitido para o Motivo de Reprovação é de 500 caracteres',
        ];
    }

}
