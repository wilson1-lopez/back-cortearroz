<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepuestoMantenimiento extends Model
{
    use HasFactory;

    protected $table = 'repuestos_mantenimiento';

    protected $fillable = [
        'repuestos_proveedores_id',
        'cantidad',
        'valor',
        'forma_pago',
        'mantenimiento_id',

    ];

    //relacion con mantenimiento
    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class, 'mantenimiento_id');
    }

    //relacion con repuestos_proveedores
    public function repuestos_proveedores()
    {
        return $this->belongsTo(RepuestoProveedores::class, 'repuestos_proveedores_id');
    }
}   


