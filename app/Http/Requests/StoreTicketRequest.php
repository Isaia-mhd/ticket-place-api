<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'quantity' => 'sometimes|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_type_id.required' => "Le type de ticket est obligatoire.",
            'ticket_type_id.exists' => "Le type de ticket sélectionné n'existe pas.",
            'quantity.integer' => "La quantité doit être un nombre entier.",
            'quantity.min' => "La quantité doit être au moins 1.",
        ];
    }
}
