<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class createCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|unique:categories,nom',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'la catégorie est requis',
            'nom.unique' => 'Cette catégorie existe est déjà.'
        ];
    }

}
