<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departement_id' => 'required|exists:departements,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employes,email',
            'contact' => 'required|string|max:20|unique:employes,contact',
            'montant_journalier' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'departement_id.required' => 'Le champ département est obligatoire',
            'departement_id.exists' => 'Le département sélectionné est invalide',
            'nom.required' => 'Le champ nom est obligatoire',
            'prenom.required' => 'Le champ prénom est obligatoire',
            'email.required' => 'Le champ email est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé',
            'contact.required' => 'Le champ contact est obligatoire',
            'contact.unique' => 'Ce contact est déjà utilisé',
            'montant_journalier.required' => 'Le montant journalier est obligatoire',
            'montant_journalier.numeric' => 'Le montant journalier doit être un nombre',
            'montant_journalier.min' => 'Le montant journalier doit être positif',
        ];
    }
}
