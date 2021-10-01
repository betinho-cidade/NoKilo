<?php

namespace App\Http\Requests\Cadastro\Cliente;

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
            'cpf' => Str::of($this->cpf)->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'celular' => Str::of($this->celular)->replaceMatches('/[^z0-9]++/', '')->__toString(),
            'end_cep' => Str::of($this->end_cep)->replaceMatches('/[^z0-9]++/', '')->__toString(),
        ]);
    }


    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'email' => 'required|email|max:191|unique:users,email,'.$this->user->id, //Login de Acesso
            'celular' => 'required|max:11',
            'cpf' => 'required|max:11|unique:users,cpf,'.$this->user->id,
            'data_nascimento' => 'required|date',
            'end_cep' => 'required|max:8',
            'end_cidade' => 'required|max:60',
            'end_uf' => 'required|max:2',
            'end_logradouro' => 'required|max:80',
            'end_numero' => 'required|max:20',
            'end_bairro' => 'required|max:60',
            'end_complemento' => 'max:40',
            'password' => 'nullable|min:8',
            'password_confirm' => 'nullable|required_with:password|min:8|same:password',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 255 caracteres',
            'email.required' => 'O Login de Acesso é requerido',
            'email.max' => 'O tamanho permitido para o Login de Acesso é de 191 caracteres',
            'email.unique' => 'O Login de Acesso informado já existe',
            'email.email' => 'O Login de Acesso deve ser um e-mail válido',
            'celular.required' => 'O celular é requerido',
            'celular.max' => 'O tamanho permitido para o celular é de 11 caracteres',
            'cpf.required' => 'O CPF é requerido',
            'cpf.max' => 'O tamanho permitido para o CPF é de 11 caracteres',
            'cpf.unique' => 'O CPF informado já existe',
            'data_nascimento.required' => 'A data de nascimento é requerida',
            'data_nascimento.date' => 'A data de nascimento é inválida',
            'end_cep.required' => 'O CEP é requerido',
            'end_cep.max' => 'O tamanho permitido para o CEP é de 8 caracteres',
            'end_cidade.required' => 'A cidade é requerida',
            'end_cidade.max' => 'O tamanho permitido para a Cidade é de 60 caracteres',
            'end_uf.required' => 'O estado (UF) é requerido',
            'end_uf.max' => 'O tamanho permitido para a UF é de 2 caracteres',
            'end_logradouro.required' => 'O endereço é requerido',
            'end_logradouro.max' => 'O tamanho permitido para o Logradouro é de 80 caracteres',
            'end_numero.required' => 'O número do endereço é requerido',
            'end_numero.max' => 'O tamanho permitido para o Número é de 20 caracteres',
            'end_bairro.required' => 'O bairro é requerido',
            'end_bairro.max' => 'O tamanho permitido para o Bairro é de 60 caracteres',
            'end_comolemento.max' => 'O tamanho permitido para o Complemento é de 40 caracteres',
            'password.min' => 'A Nova Senha deve conter no mínimo 8 caracteres',
            'password_confirm.min' => 'A Senha de Confirmação deve ter no mínimo 8 caracteres',
            'password_confirm.same' => 'A Senha de Confirmação deve ser igual a Nova Senha',
            'password_confirm.required_with' => 'A Senha de Confirmação deve ser igual a Nova Senha',
        ];
    }
}
