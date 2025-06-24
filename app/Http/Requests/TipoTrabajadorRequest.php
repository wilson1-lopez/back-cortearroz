<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoTrabajadorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:250',
        ];

        // Si es una actualización, permitir que el nombre sea único excepto para el registro actual
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $tipoTrabajadorId = $this->route('tipo_trabajador');
            $rules['nombre'] .= '|unique:tipos_trabajadores,nombre,' . $tipoTrabajadorId;
        } else {
            // Para creación, el nombre debe ser único
            $rules['nombre'] .= '|unique:tipos_trabajadores,nombre';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del tipo de trabajador es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 250 caracteres.',
            'nombre.unique' => 'Ya existe un tipo de trabajador con este nombre.',
        ];
    }
}
