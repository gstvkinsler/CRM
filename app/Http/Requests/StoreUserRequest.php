<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[A-Z]/', 
                'regex:/[a-z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*?&]/'
            ],
            'phone_number' => 'required|string|min:10|max:15',
            'documents' => 'required|array',
            'documents.*.type' => 'required|string',
            'documents.*.document' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
            'phone_number.required' => 'O número de telefone é obrigatório.',
            'phone_number.min' => 'O número de telefone deve ter no mínimo 10 caracteres.',
            'phone_number.max' => 'O número de telefone não pode ter mais de 15 caracteres.',
            'documents.required' => 'Os documentos são obrigatórios.',
            'documents.array' => 'Os documentos devem ser um array.',
            'documents.*.type.required' => 'O tipo do documento é obrigatório.',
            'documents.*.document.required' => 'O documento é obrigatório.',
        ];
    }
}
