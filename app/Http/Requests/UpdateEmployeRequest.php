<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeRequest extends FormRequest
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
             'departement_id' => 'required|integer',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required',
            'contact' => 'required',
            'montant_journalier' => 'required',
        ];

    }

    public function messages(): array
    {
        return [
            'email.required' => 'Le champ email est obligatoire',
            'contact.required' => 'Le champ contact est obligatoire',
            'nom.required' => 'Le champ nom est obligatoire',
            'prenom.required' => 'Le champ prénom est obligatoire',
            'montant_journalier.required' => 'Le montant journalier est obligatoire',
            'departement_id.required' => 'Le champ département est obligatoire',
            'departement_id.integer' => 'Le département doit être un entier',
        ];
    }
}
