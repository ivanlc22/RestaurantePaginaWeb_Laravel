<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255|',
            'password_confirmation' => 'required_with:password|string|max:255|same:password',
            'direccion' => 'required|string|max:255|',
            'telefono' => 'required|numeric|max:9999999999|unique:cliente,telefono'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'El campo nombre ya está en uso.',
            'name.max' => 'El campo nombre es demasiado largo.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El campo email es demasiado largo.',
            'email.unique' => 'El email ya está en uso.',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide.',
            'telefono.unique' => 'El campo teléfono ya esta en uso',
            'telefono.max' => 'Teléfono demasiado largo.',
        ];
    }
}
