<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'client_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'languages' => 'nullable|string',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'client_name' => $this->clientName,
            'phone_number' => $this->phoneNumber,
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Insira um e-mail válido.',
            'email.unique' => 'Este e-mail já está registado.',
            'password.required' => 'A password é obrigatória.',
            'password.min' => 'A password deve ter pelo menos 8 caracteres.',
            'client_name.required' => 'O nome do cliente é obrigatório.',
            'phone_number.required' => 'O número de telefone é obrigatório.',
        ];
    }
}
