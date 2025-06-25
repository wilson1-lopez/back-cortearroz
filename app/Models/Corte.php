<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;

    protected $table = 'cortes';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'valor_bulto',
        'descripcion',
        'cliente_id',
        'temporada_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'valor_bulto' => 'decimal:2'
    ];

    /**
     * Relación con el cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /**
     * Relación con la temporada
     */
    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'temporada_id');
    }

    /**
     * Relación muchos a muchos con máquinas
     */
    public function maquinas()
    {
        return $this->belongsToMany(Maquina::class, 'maquinas_cortes', 'corte_id', 'maquina_id')
                    ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con trabajadores
     */
    public function trabajadores()
    {
        return $this->belongsToMany(Trabajador::class, 'trabajadores_corte', 'corte_id', 'trabajador_id')
                    ->withPivot('precio_acordado')
                    ->withTimestamps();
    }

    /**
     * Scope para cortes por cliente
     */
    public function scopeByCliente($query, $clienteId)
    {
        return $query->where('cliente_id', $clienteId);
    }

    /**
     * Scope para cortes por temporada
     */
    public function scopeByTemporada($query, $temporadaId)
    {
        return $query->where('temporada_id', $temporadaId);
    }

    /**
     * Scope para cortes en rango de fechas
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

    /**
     * Scope para cortes activos (sin fecha fin o fecha fin futura)
     */
    public function scopeActivos($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('fecha_fin')
              ->orWhere('fecha_fin', '>=', now()->toDateString());
        });
    }
}
