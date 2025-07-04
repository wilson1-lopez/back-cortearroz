<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RepuestoRequest extends FormRequest
{
    /** 
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */ 
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *  
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
           // 'proveedor_id' => 'required|exists:proveedores,id',
            'precio' => 'nullable|numeric|min:0.01'
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