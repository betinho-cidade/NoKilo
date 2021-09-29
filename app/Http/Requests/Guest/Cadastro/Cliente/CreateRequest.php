<?php

namespace App\Http\Requests\Guest\Cadastro\Cliente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class CreateRequest extends FormRequest
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
            'email' => 'required|email|max:191|unique:users,email', //Login de Acesso
            'celular' => 'required|max:11',
            'cpf' => 'required|max:11|unique:users,cpf',
            'data_nascimento' => 'required|date',
            'end_cep' => 'required',
            'end_cidade' => 'required',
            'end_uf' => 'required',
            'end_logradouro' => 'required',
            'end_numero' => 'required',
            'end_bairro' => 'required',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 255 caracteres',
            'email.required' => 'O Login de Acesso (E-mail) é requerido',
            'email.max' => 'O tamanho permitido para o Login de Acesso (E-mail) é de 191 caracteres',
            'email.unique' => 'O Login de Acesso (E-mail) informado já existe',
            'email.email' => 'O Login de Acesso (E-mail) deve ser um e-mail válido',
            'celular.required' => 'O celular é requerido',
            'celular.max' => 'O tamanho permitido para o celular é de 11 caracteres',
            'cpf.required' => 'O CPF é requerido',
            'cpf.max' => 'O tamanho permitido para o CPF é de 11 caracteres',
            'cpf.unique' => 'O CPF informado já existe',
            'data_nascimento.required' => 'A data de nascimento é requerida',
            'data_nascimento.date' => 'A data de nascimento é inválida',
            'end_cep.required' => 'O CEP é requerido',
            'end_cidade.required' => 'A cidade é requerida',
            'end_uf.required' => 'O estado (UF) é requerido',
            'end_logradouro.required' => 'O endereço é requerido',
            'end_numero.required' => 'O número do endereço é requerido',
            'end_bairro.required' => 'O bairro é requerido',
            'password.required' => 'A Senha é requerida',
            'password.min' => 'A Senha deve conter no mínimo 8 caracteres',
            'password_confirm.required' => 'A Senha de Confirmação é requerida',
            'password_confirm.same' => 'A Senha de Confirmação deve ser igual a Senha',
        ];
    }
}
