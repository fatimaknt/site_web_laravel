<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeConfigRequest extends FormRequest
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
            'type' => 'required|unique:configurations,type',
            'value' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'type.required' => 'The type field is required.',
            'type.in' => 'The selected type is invalid.',
            'value.required' => 'The value field is required.',
            'value.string' => 'The value must be a string.',
            'value.max' => 'The value may not be greater than 255 characters.',
        ];
    }
}
