<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    use HasFactory;
   protected $table = 'proveedores';
  
    protected $fillable = [

        'usuario_id',
        'nombre',
        'telefono',
        'email',
        'direccion',        
    ];

   //relacion con la tabla repuesto
    public function repuestos()
    {
        return $this->belongsToMany(Repuesto::class, 'repuestos_proveedores', 'proveedor_id', 'repuesto_id')
            ->withPivot('precio');
    }

    //relacion con la tabla users
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}