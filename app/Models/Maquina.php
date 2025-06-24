<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
  use HasFactory;
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'usuario_id',
    ];

    
    
 // una maquina pertenece a un propietario
 
     
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    //una maquina puede tener muchos mantenimientos
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'maquina_id');
    }
}
