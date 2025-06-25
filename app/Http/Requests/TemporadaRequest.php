<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemporadaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // La autorización se maneja en el middleware JWT
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:250',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'valor_bulto' => 'required|numeric|min:0|max:9999999.99'
        ];

        // Si es una actualización (PUT/PATCH), hacer algunas validaciones más flexibles
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['nombre'] = 'sometimes|required|string|max:250';
            $rules['fecha_inicio'] = 'sometimes|required|date';
            $rules['fecha_fin'] = 'sometimes|nullable|date|after:fecha_inicio';
            $rules['valor_bulto'] = 'sometimes|required|numeric|min:0|max:9999999.99';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la temporada es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 250 caracteres.',
            
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a hoy.',
            
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            
            'valor_bulto.required' => 'El valor por bulto es obligatorio.',
            'valor_bulto.numeric' => 'El valor por bulto debe ser un número.',
            'valor_bulto.min' => 'El valor por bulto debe ser mayor o igual a 0.',
            'valor_bulto.max' => 'El valor por bulto no puede exceder 9999999.99.'
        ];
    }
}
