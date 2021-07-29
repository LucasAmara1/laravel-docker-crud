<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'preco' => 'required',
            'fabricante' => 'required',
            'descricao' => 'required',
            'tarja' => 'required',
            'imagem' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'preco.required' => 'O campo preço é obrigatório.',
            'fabricante.required' => 'O campo fabricante é obrigatório.',
            'tarja.required' => 'O campo tarja é obrigatório.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'imagem.image' => 'A imagem deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser um arquivo do tipo: jpeg, png, jpg.',
            'imagem.max' => 'A imagem não deve ter mais de 2048 KB.'
        ];
    }
}
