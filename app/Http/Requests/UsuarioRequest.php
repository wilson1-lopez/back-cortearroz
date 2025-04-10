<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuarioRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|max:250',
            'direccion' => 'nullable|string|max:250',
           'email' => 'required|string|email|max:250|unique:users,email,' . $this->route('user'),
            'password' => 'nullable|string|min:6',
           'google_id' => 'nullable|string|unique:users,google_id,' . $this->route('user'),
            'avatar' => 'nullable|string',
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

