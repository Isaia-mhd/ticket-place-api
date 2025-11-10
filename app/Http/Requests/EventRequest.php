<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'venue' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date', 'after_or_equal:today'],
            'gate_open_time' => ['required', 'date_format:H:i'],
            'start_time' => ['required', 'date_format:H:i'],
            'capacity' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'string', 'max:100'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'venue.required' => 'Le lieu de l’événement est obligatoire.',

            'event_date.required' => 'La date de l’événement est obligatoire.',
            'event_date.date' => 'La date de l’événement n’est pas valide.',
            'event_date.after_or_equal' => 'La date doit être aujourd’hui ou dans le futur.',

            'gate_open_time.required' => 'L’heure d’ouverture des portes est obligatoire.',
            'gate_open_time.date_format' => 'L’heure d’ouverture doit être au format HH:MM.',

            'start_time.date_format' => 'L’heure de début doit être au format HH:MM.',
            'end_time.date_format' => 'L’heure de fin doit être au format HH:MM.',
            'end_time.after' => 'L’heure de fin doit être après l’heure de début.',

            'capacity.required' => 'La capacité est obligatoire.',
            'capacity.integer' => 'La capacité doit être un nombre.',
            'capacity.min' => 'La capacité doit être positive.',

            'type.required' => 'Le type d’événement est obligatoire.',

            'image.required' => 'L’image de l’événement est obligatoire.',
        ];
    }
}
