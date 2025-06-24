<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:250',
            'telefono' => 'nullable|string|max:250',
            'email' => 'nullable|string|email|max:250',
            'direccion' => 'nullable|string|max:250',
            //'usuario_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El telefono es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'direccion.required' => 'La direccion es obligatorio.',
           // 'usuario_id.required' => 'El usuario es obligatorio.',
            'usuario_id.exists' => 'El usuario seleccionado no existe.',
            

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
