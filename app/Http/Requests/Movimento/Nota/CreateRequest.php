<?php

namespace App\Http\Requests\Movimento\Nota;

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
            'promocao' => 'required',
            'franquia' => 'required',
            'path_nota' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'promocao.required' => 'A Promoção é requerida',
            'franquia.required' => 'A Fraquia é requerida',
            'path_nota.required' => 'O arquivo da Nota é requerido',
            'path_nota.mimes' => 'Somente imagens do tipo JPEG|JPG|PNG|GIF|SVG são permitidas para o arquivo da Nota',
            'path_nota.max' => 'O tamanho máximo permitido para o arquivo da Nota é de 5Mb.',
        ];
    }
}
