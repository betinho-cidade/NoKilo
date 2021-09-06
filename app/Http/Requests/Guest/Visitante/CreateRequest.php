<?php

namespace App\Http\Requests\Guest\Visitante;

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
            'nome' => 'required|max:300',
            'email_membro' => 'nullable|email|max:500',
            'cpf' => 'nullable|max:11|unique:membros,cpf',
            'sexo' => 'required',
            'celular' => 'required|max:11',
            'data_nascimento' => 'required|date',
            'naturalidade' => 'required|max:300',
            'conjuge' => 'max:300',
            'data_casamento' => 'nullable|date',
            'profissao' => 'max:300',
            'nome_pai' => 'max:300',
            'nome_mae' => 'required|max:300',
            'end_cep' => 'max:8',
            'end_cidade' => 'max:60',
            'end_uf' => 'max:2',
            'end_logradouro' => 'max:80',
            'end_numero' => 'max:20',
            'end_bairro' => 'max:60',
            'end_complemento' => '|max:40',
            'data_batismo' => 'nullable|date',
            'pastor_batismo' => 'max:300',
            'igreja_batismo' => 'max:300',
            'data_profissao_fe' => 'nullable|date',
            'pastor_profissao_fe' => 'max:300',
            'igreja_profissao_fe' => 'max:300',
        ];
    }

    public function messages()
    {
        return [

            'nome.required' => 'O nome é requerido',
            'nome.max' => 'O tamanho permitido para o nome é de 300 caracteres',
            'email_membro.email' => 'O E-mail do Membro é inválido',
            'email_membro.max' => 'O tamanho permitido para o E-mail d Membro é de 500 caracteres',
            'cpf.max' => 'O tamanho permitido para o CPF d Membro é de 11 dígitos',
            'cpf.unique' => 'O CPF informado já existe',
            'sexo.required' => 'O sexo é requerido',
            'celular.required' => 'O celular é requerido',
            'celular.max' => 'O tamanho permitido para o celular é de 11 dígitos',
            'data_nascimento.required' => 'A data de nascimento é requerida',
            'data_nascimento.date' => 'A data de nascimento é inválida',
            'naturalidade.required' => 'A naturalidade é requerida',
            'naturalidade.max' => 'O tamanho permitido para a naturalidade é de 300 caracteres',
            'conjuge.max' => 'O tamanho permitido para o cônjuge é de 300 caracteres',
            'data_casamento.date' => 'A data de casamento é inválida',
            'profissao.max' => 'O tamanho permitido para a profissão é de 300 caracteres',
            'nome_pai.max' => 'O tamanho permitido para o nome do pai é de 300 caracteres',
            'nome_mae.required' => 'O nome da mãe é requerido',
            'nome_mae.max' => 'O tamanho permitido para o nome da mãe é de 300 caracteres',
            'end_cep.max' => 'O tamanho permitido para o cep é de 8 dígitos',
            'end_cidade.max' => 'O tamanho permitido para a cidade é de 60 caracteres',
            'end_uf.max' => 'O tamanho permitido para a UF é de 2 caracteres',
            'end_logradouro.max' => 'O tamanho permitido para a rua é de 80 caracteres',
            'end_numero.max' => 'O tamanho permitido para o número é de 20 caracteres',
            'end_bairro.max' => 'O tamanho permitido para o bairro é de 60 caracteres',
            'end_complemento.max' => 'O tamanho permitido para o complemento é de 40 caracteres',
            'data_batismo.date' => 'A data de batismo é inválida',
            'pastor_batismo.max' => 'O tamanho permitido para o Pastor de Batismo é de 300 caracteres',
            'igreja_batismo.max' => 'O tamanho permitido para a Igreja de Batismo é de 300 caracteres',
            'data_profissao_fe.date' => 'A data de profissão de fé é inválida',
            'pastor_profissao_fe.max' => 'O tamanho permitido para o pastor da profissão de fé é de 300 caracteres',
            'igreja_profissao_fe.max' => 'O tamanho permitido para a Igreja da profissão de fé é de 300 caracteres',
        ];
    }
}
