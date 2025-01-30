<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreHostRequest extends FormRequest
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
            'client_id' => ['required', 'integer', 'exists:clients,user_id'],
            'host_description' => ['required', 'string'],
            'job' => ['required', 'string', 'max:255'],
            'iban' => ['nullable', 'string', 'max:34'],
            'nif' => ['nullable', 'string', 'max:20'],
            'rate' => ['nullable', 'integer', 'min:0', 'max:5'],
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'client_id' => $this->clientId,
            'host_description' => $this->hostDescription,
        ]);
    }
    
    public function messages(): array
    {
        return [
            'client_id.required' => 'O campo "client_id" é obrigatório.',
            'client_id.integer' => 'O "client_id" deve ser um número inteiro.',
            'client_id.exists' => 'O "client_id" não corresponde a um cliente válido.',
            'host_description.required' => 'A descrição do host é obrigatória.',
            'job.required' => 'O campo "job" é obrigatório.',
            'job.max' => 'O campo "job" não pode ter mais de 255 caracteres.',
            'iban.max' => 'O IBAN não pode ter mais de 34 caracteres.',
            'nif.max' => 'O NIF não pode ter mais de 20 caracteres.',
            'rate.integer' => 'A classificação deve ser um número inteiro.',
            'rate.min' => 'A classificação mínima é 0.',
            'rate.max' => 'A classificação máxima é 5.',
        ];
    }
}
