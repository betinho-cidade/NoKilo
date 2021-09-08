<?php

namespace App\Http\Requests\Cadastro\Usuario;

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
        ]);
    }


    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'email' => 'required|email|max:191|unique:users,email,'.$this->usuario->id, //Login de Acesso
            'celular' => 'required|max:11',
            'cpf' => 'required|max:11|unique:users,cpf,'.$this->usuario->id,
            'data_nascimento' => 'required|date',
            'situacao' => 'required',
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
            'perfil.required' => 'O perfil é requerido',
            'situacao.required' => 'A situação é requerida',
            'password.min' => 'A Nova Senha deve conter no mínimo 8 caracteres',
            'password_confirm.min' => 'A Senha de Confirmação deve ter no mínimo 8 caracteres',
            'password_confirm.same' => 'A Senha de Confirmação deve ser igual a Nova Senha',
            'password_confirm.required_with' => 'A Senha de Confirmação deve ser igual a Nova Senha',
        ];
    }
}
