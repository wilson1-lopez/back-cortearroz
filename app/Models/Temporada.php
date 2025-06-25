<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    protected $table = 'temporadas';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'valor_bulto',
        'usuario_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'valor_bulto' => 'decimal:2'
    ];

    /**
     * Relación con el usuario que registró la temporada
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Scope para temporadas por usuario
     */
    public function scopeByUsuario($query, $usuarioId)
    {
        return $query->where('usuario_id', $usuarioId);
    }

    /**
     * Scope para temporadas en rango de fechas
     */
    public function scopeEnRango($query, $fechaInicio, $fechaFin)
    {
        return $query->where(function ($q) use ($fechaInicio, $fechaFin) {
            $q->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
              ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin])
              ->orWhere(function ($subQ) use ($fechaInicio, $fechaFin) {
                  $subQ->where('fecha_inicio', '<=', $fechaInicio)
                       ->where('fecha_fin', '>=', $fechaFin);
              });
        });
    }
}
