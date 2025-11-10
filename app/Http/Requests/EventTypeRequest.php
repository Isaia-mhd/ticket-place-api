<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventTypeRequest extends FormRequest
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
            'event_id' => 'required|exists:events,id',
            'type' => 'required|string|max:255',
            'price' => 'required|integer|min:0',       // prix en Ariary, jamais négatif
            'quantity' => 'required|integer|min:0',    // quantité disponible, jamais négative
        ];
    }

    public function messages(): array
    {
        return [
            'event_id.required' => "L'événement est obligatoire.",
            'event_id.exists' => "L'événement sélectionné n'existe pas.",
            'type.required' => "Le type de ticket est obligatoire.",
            'type.string' => "Le type de ticket doit être une chaîne de caractères.",
            'type.max' => "Le type de ticket ne peut pas dépasser 255 caractères.",
            'price.required' => "Le prix du ticket est obligatoire.",
            'price.integer' => "Le prix du ticket doit être un nombre entier.",
            'price.min' => "Le prix du ticket ne peut pas être négatif.",
            'quantity.required' => "La quantité de tickets est obligatoire.",
            'quantity.integer' => "La quantité de tickets doit être un nombre entier.",
            'quantity.min' => "La quantité de tickets ne peut pas être négative.",
        ];
    }
}
