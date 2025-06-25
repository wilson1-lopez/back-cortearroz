<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $table = 'trabajadores';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'cedula',
        'direccion',
        'tipo_id',
        'usuario_id',
    ];

    /**
     * Relación con TipoTrabajador
     */
    public function tipo()
    {
        return $this->belongsTo(TipoTrabajador::class, 'tipo_id');
    }

    /**
     * Relación con User
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
