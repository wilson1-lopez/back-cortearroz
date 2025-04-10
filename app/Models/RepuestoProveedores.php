<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RepuestoProveedores extends Model
{


    use HasFactory;

    protected $table = 'repuestos_proveedores';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'repuesto_id',
        'proveedor_id', 
        'precio',
    ];


    // Relaciones
    public function repuesto()
    {
        return $this->belongsTo(Repuesto::class, 'repuesto_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    //relacion con repuestomantenimientos
    public function repuestos_mantenimientos()
    {
        return $this->hasMany(RepuestoMantenimiento::class, 'repuestos_proveedores_id');
    }


}