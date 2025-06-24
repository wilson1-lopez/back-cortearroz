<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
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
        'usuario_id',
    ];

    //lo relacionamos con usuarios
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    //lo relacionamos con proveedores
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'repuestos_proveedores', 'repuesto_id', 'proveedor_id')
            ->withPivot('precio');
    }

}

