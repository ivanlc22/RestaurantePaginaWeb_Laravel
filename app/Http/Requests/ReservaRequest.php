<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
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
            'fecha' => 'required|after:today',
            'hora' => 'required',
            'num_personas' => 'required|integer|min:1|max:20',
            'id_local' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'Introduce la fecha de tu reserva',
            'fecha.after' => 'Introduce una fecha valida',
            'hora.required' => 'Introduce la hora de tu reserva',
            'num_personas.required' => 'Introduce cuantos sereis en la reserva',
            'num_personas.min' => 'La reserva minima es para 1 persona',
            'num_personas.max' => 'Para reservas de mas de 20 personas contacte con el local directamente',
            'id_local.required' => 'Introduce el local donde quieras reservar',
        ];
    }
}
