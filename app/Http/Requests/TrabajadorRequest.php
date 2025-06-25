<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class TrabajadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Obtener el ID del trabajador desde la ruta para las actualizaciones
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $trabajadorId = $this->route('trabajador'); // Ahora usamos 'trabajador' como parámetro
            if ($trabajadorId) {
                $this->merge(['trabajador_id' => $trabajadorId]);
            }
        }
        
        // Debug temporal
        $this->debugValidation();
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
            'apellido' => 'required|string|max:250',
            'telefono' => 'nullable|string|max:250',
            'cedula' => 'nullable|string|max:250',
            'direccion' => 'nullable|string|max:250',
            'tipo_id' => 'required|exists:tipos_trabajadores,id',
        ];

        // Manejar validación de unicidad de cédula
        if ($this->filled('cedula')) {
            if ($this->isMethod('put') || $this->isMethod('patch')) {
                // Para actualización, excluir el registro actual
                $trabajadorId = $this->input('trabajador_id');
                
                if ($trabajadorId) {
                    $rules['cedula'] .= '|unique:trabajadores,cedula,' . $trabajadorId;
                } else {
                    $rules['cedula'] .= '|unique:trabajadores,cedula';
                }
            } else {
                // Para creación, la cédula debe ser única
                $rules['cedula'] .= '|unique:trabajadores,cedula';
            }
        }

        return $rules;
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 250 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no puede exceder los 250 caracteres.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no puede exceder los 250 caracteres.',
            'cedula.string' => 'La cédula debe ser una cadena de texto.',
            'cedula.max' => 'La cédula no puede exceder los 250 caracteres.',
            'cedula.unique' => 'La cédula ya está registrada.',
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'direccion.max' => 'La dirección no puede exceder los 250 caracteres.',
            'tipo_id.required' => 'El tipo de trabajador es obligatorio.',
            'tipo_id.exists' => 'El tipo de trabajador seleccionado no existe.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Errores de validación.',
            'errors' => $validator->errors()
        ], 422));
    }

    /**
     * Método temporal para debugging - eliminar después de probar
     */
    public function debugValidation()
    {
        Log::info('Debugging TrabajadorRequest', [
            'method' => $this->method(),
            'route_params' => $this->route()->parameters(),
            'trabajador_id_from_route' => $this->route('trabajador'),
            'trabajador_id_merged' => $this->input('trabajador_id'),
            'cedula' => $this->input('cedula'),
            'is_update' => $this->isMethod('put') || $this->isMethod('patch')
        ]);
    }
}
