<?php

namespace App\Http\Requests\Cadastro\Franquia;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'end_cep' => Str::of($this->end_cep)->replaceMatches('/[^z0-9]++/', '')->__toString(),
        ]);
    }


    public function rules()
    {

        return [
            'usuario' => 'nullable|unique:franquias,user_id,'.$this->franquia->id,
            'nome' => 'required|max:300',
            'end_cep' => 'required|max:8',
            'end_cidade' => 'required|max:60',
            'end_uf' => 'required|max:2',
            'end_logradouro' => 'required|max:80',
            'end_numero' => 'required|max:20',
            'end_bairro' => 'required|max:60',
            'end_complemento' => '|max:40',
        ];
    }

    public function messages()
    {
        return [
            'usuario.unique' => 'O responsável escolhido já está vinculado a uma outra empresa',
            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 300 caracteres',
            'end_cep.max' => 'O tamanho permitido para o cep é de 8 dígitos',
            'end_cep.required' => 'O Cep é requerido',
            'end_cidade.max' => 'O tamanho permitido para a cidade é de 60 caracteres',
            'end_cidade.required' => 'A Cidade é requerida',
            'end_uf.max' => 'O tamanho permitido para a UF é de 2 caracteres',
            'end_uf.required' => 'A UF é requerida',
            'end_logradouro.max' => 'O tamanho permitido para a rua é de 80 caracteres',
            'end_logradouro.required' => 'O Endereço é requerido',
            'end_numero.max' => 'O tamanho permitido para o número é de 20 caracteres',
            'end_numero.required' => 'O número é requerido',
            'end_bairro.max' => 'O tamanho permitido para o bairro é de 60 caracteres',
            'end_bairro.required' => 'O bairro é requerido',
            'end_complemento.max' => 'O tamanho permitido para o complemento é de 40 caracteres',
        ];
    }

}
