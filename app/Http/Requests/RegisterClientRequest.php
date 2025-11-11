<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClientRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "Le nom est obligatoire.",
            'name.string' => "Le nom doit être une chaîne de caractères.",
            'name.max' => "Le nom ne peut pas dépasser 255 caractères.",

            'email.required' => "L'email est obligatoire.",
            'email.email' => "L'email doit être une adresse valide.",
            'email.max' => "L'email ne peut pas dépasser 255 caractères.",
            'email.unique' => "Cet email est déjà utilisé.",

            'phone.string' => "Le téléphone doit être une chaîne de caractères.",
            'phone.max' => "Le téléphone ne peut pas dépasser 20 caractères.",
            'phone.unique' => "Ce numéro de téléphone est déjà utilisé.",

            'password.required' => "Le mot de passe est obligatoire.",
            'password.string' => "Le mot de passe doit être une chaîne de caractères.",
            'password.min' => "Le mot de passe doit contenir au moins 6 caractères.",
            'password.confirmed' => "La confirmation du mot de passe ne correspond pas.",
        ];
    }
}
