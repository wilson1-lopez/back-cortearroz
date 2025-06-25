<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorteRequest extends FormRequest
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
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'valor_bulto' => 'required|numeric|min:0|max:9999999.99',
            'descripcion' => 'nullable|string|max:250',
            'cliente_id' => 'required|integer|exists:clientes,id',
            'temporada_id' => 'required|integer|exists:temporadas,id',
            'maquinas' => 'nullable|array',
            'maquinas.*' => 'integer|exists:maquinas,id',
            'trabajadores' => 'nullable|array',
            'trabajadores.*.trabajador_id' => 'required_with:trabajadores|integer|exists:trabajadores,id',
            'trabajadores.*.precio_acordado' => 'required_with:trabajadores|numeric|min:0|max:9999999.99'
        ];

        // Si es una actualización (PUT/PATCH), hacer algunas validaciones más flexibles
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['fecha_inicio'] = 'sometimes|required|date';
            $rules['fecha_fin'] = 'sometimes|nullable|date|after:fecha_inicio';
            $rules['valor_bulto'] = 'sometimes|required|numeric|min:0|max:9999999.99';
            $rules['cliente_id'] = 'sometimes|required|integer|exists:clientes,id';
            $rules['temporada_id'] = 'sometimes|required|integer|exists:temporadas,id';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a hoy.',
            
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            
            'valor_bulto.required' => 'El valor por bulto es obligatorio.',
            'valor_bulto.numeric' => 'El valor por bulto debe ser un número.',
            'valor_bulto.min' => 'El valor por bulto debe ser mayor o igual a 0.',
            'valor_bulto.max' => 'El valor por bulto no puede exceder 9999999.99.',
            
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 250 caracteres.',
            
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.integer' => 'El ID del cliente debe ser un número entero.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            
            'temporada_id.required' => 'La temporada es obligatoria.',
            'temporada_id.integer' => 'El ID de la temporada debe ser un número entero.',
            'temporada_id.exists' => 'La temporada seleccionada no existe.',
            
            'maquinas.array' => 'Las máquinas deben ser un arreglo.',
            'maquinas.*.integer' => 'Cada ID de máquina debe ser un número entero.',
            'maquinas.*.exists' => 'Una de las máquinas seleccionadas no existe.',
            
            'trabajadores.array' => 'Los trabajadores deben ser un arreglo.',
            'trabajadores.*.trabajador_id.required_with' => 'El ID del trabajador es obligatorio.',
            'trabajadores.*.trabajador_id.integer' => 'El ID del trabajador debe ser un número entero.',
            'trabajadores.*.trabajador_id.exists' => 'Uno de los trabajadores seleccionados no existe.',
            'trabajadores.*.precio_acordado.required_with' => 'El precio acordado es obligatorio para cada trabajador.',
            'trabajadores.*.precio_acordado.numeric' => 'El precio acordado debe ser un número.',
            'trabajadores.*.precio_acordado.min' => 'El precio acordado debe ser mayor o igual a 0.',
            'trabajadores.*.precio_acordado.max' => 'El precio acordado no puede exceder 9999999.99.'
        ];
    }
}
