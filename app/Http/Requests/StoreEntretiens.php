<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntretiens extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required|unique:interviews,time,' . $this->input('date'),
            'cand_id' => 'required|exists:candidatures,id',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'La date est requise.',
            'time.required' => 'L\'heure est requise.',
            'time.unique' => 'Le temps est déjà pris pour cette date.',
            'cand_id.required' => 'Le candidat est requis.',
            'cand_id.exists' => 'Le candidat sélectionné n\'existe pas.',
        ];
    }
}
