<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
  use HasFactory;
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'maquina_id', 
        'fecha', 
        'nombre', 
        'descripcion', 
        'realizado_por'
    ];

    
    
 // un mantenimiento pertenece a una maquina
     
 public function maquina()
 {
     return $this->belongsTo(Maquina::class, 'maquina_id');
 }

 //un mantenimiento tiene muchos accionmantenimientos
 public function accionmantenimientos()
 {
     return $this->hasMany(AccionMantenimiento::class, 'mantenimiento_id');
 }

 //relacion con repuestos_mantenimientos
 public function repuestos_mantenimientos()
 {
     return $this->hasMany(RepuestoMantenimiento::class, 'mantenimiento_id');
 }
}
