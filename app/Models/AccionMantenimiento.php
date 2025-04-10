<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccionMantenimiento extends Model
{
  use HasFactory;

  protected $table = 'acciones_mantenimiento';
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mantenimiento_id', 
        'descripcion'
    ];

    
    
 // cada accion de mantenimiento pertenece a un mantenimiento
     
 public function mantenimiento()
 {
     return $this->belongsTo(Mantenimiento::class, 'mantenimiento_id');
 }
}
