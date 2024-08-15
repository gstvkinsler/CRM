<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'sometimes|string|max:30',
            'email' => 'sometimes|string|email|max:255|unique:customers',
            'phone_number' => 'sometimes|string|min:10|max:15',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'phone_number.min' => 'O número de telefone deve ter no mínimo 10 caracteres.',
            'phone_number.max' => 'O número de telefone não pode ter mais de 15 caracteres.',
        ];
    }
}
