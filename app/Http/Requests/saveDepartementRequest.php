<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|unique:departements,nom',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du département est obligatoire.',
            'nom.unique' => 'Le nom du département existe déjà.',
        ];
    }
}
