<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RepuestoMantenimientoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mantenimiento_id' => 'required|exists:mantenimientos,id',
            'repuestos_proveedores_id' => 'required|exists:repuestos_proveedores,id',
            'cantidad' => 'required|numeric|min:1',
            'valor' => 'required|numeric|min:0.01',
            'forma_pago' => 'required|string|max:250',

        ];
    }

    public function messages(): array
    {
        return [
            'mantenimiento_id.required' => 'El mantenimiento es obligatorio.',
            'mantenimiento_id.exists' => 'El mantenimiento seleccionado no existe.',
            'repuestos_proveedores_id.required' => 'El repuesto es obligatorio.',
            'repuestos_proveedores_id.exists' => 'El repuesto seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.numeric' => 'La cantidad debe ser un número.',
            'cantidad.min' => 'La cantidad debe ser mayor a 0.',
            'valor.required' => 'El valor es obligatorio.',
            'valor.numeric' => 'El valor debe ser un número.',
            'valor.min' => 'El valor debe ser mayor a 0.',
            'forma_pago.required' => 'La forma de pago es obligatoria.',
            'forma_pago.string' => 'La forma de pago debe ser una cadena de texto.',
            'forma_pago.max' => 'La forma de pago debe tener máximo 250 caracteres.',


        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Errores de validación.',
            'errors' => $validator->errors()
        ], 422));
    }
}
