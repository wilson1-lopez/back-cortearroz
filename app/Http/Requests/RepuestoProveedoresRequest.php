<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RepuestoProveedoresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'repuesto_id'   => 'required|exists:repuestos,id',
            'proveedor_id'  => 'required|exists:proveedores,id',
            'precio'        => 'required|numeric|min:0.01',
        ];
    }

    public function messages(): array
    {
        return [
            'repuesto_id.required'    => 'El repuesto es obligatorio.',
            'repuesto_id.exists'      => 'El repuesto seleccionado no existe.',
            'proveedor_id.required'   => 'El proveedor es obligatorio.',
            'proveedor_id.exists'     => 'El proveedor seleccionado no existe.',
            'precio.required'         => 'El precio es obligatorio.',
            'precio.numeric'          => 'El precio debe ser un número.',
            'precio.min'              => 'El precio debe ser mayor a 0.',
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
