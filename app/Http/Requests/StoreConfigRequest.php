<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfigRequest extends FormRequest
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
            'type' => 'required|unique:configurations,type',
            'value' => 'required'
        ];
    }


    public function messages()
    {

        return [
            'type.required' => 'Le type de configuration est requis',
            'type.unique' => 'Cette configuration existe déjà',
            'value.required' => 'La valeur est requise',
        ];
    }
}
