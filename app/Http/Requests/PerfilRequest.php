<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PerfilRequest extends FormRequest
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
            'name' => 'max:255|unique:users,name,'.Auth::id(),
            'email' => 'max:255|unique:users,email,'.Auth::id(),
            'telefono' => 'max:10||unique:cliente,telefono,'.Auth::id().',id_usuario'
        ];
    }
    public function messages()
    {
        
        return [
            'name.unique' => 'El campo nombre ya está en uso.',
            'name.max' => 'El campo nombre es demasiado largo.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'name.max' => 'El campo email es demasiado largo.',
            'email.unique' => 'El email ya está en uso.',
            'telefono.unique' => 'El teléfono ya está en uso.',
            'telefono.max' => 'Teléfono demasiado largo.'
        ];
    }
}
