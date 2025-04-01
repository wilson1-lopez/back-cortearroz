<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{public function authorize(): bool
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
            'google_id' => 'nullable|string|unique:users,google_id,' . $this->id,
            'avatar' => 'nullable|string',
        ];
    }
}

