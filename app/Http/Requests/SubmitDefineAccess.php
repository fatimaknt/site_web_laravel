<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitDefineAccess extends FormRequest
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
            'code'=>"required|exists:reset_code_passwords,code",
            "password"=>"required|same:confirm_password",
            "confirm_password"=>"required|same:password",
        ];
    }
    public function messages()
    {
        return [
            'code.required'=>'le code est requis',
            'code.exists'=>'Ce code n\' est pas valide',
            'password.same'=> 'Les mots de passe ne correspondent pas.',
            'password.required'=> 'Le mots de passe est requis.',
           'confirm_password.required'=> 'La confirmation du mot de  passe est requis',
           'confirm_password.same'=> 'La confirmation du mot de  passe ne correspondent pas au password.',
        ];
    }
}
