<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'direccion',
        'email',
        'password',
        'google_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     
 // Implementación de métodos JWT
 public function getJWTIdentifier()
 {
     return $this->getKey(); // ID del usuario
 }

 public function getJWTCustomClaims()
 {
     return [
        'nombre' => $this->nombre,
        'email' => $this->email
     ]; 
 }






    //Un usuario tiene muchas máquinas.
    
    public function maquinas()
    {
        return $this->hasMany(Maquina::class, 'usuario_id');
    }

    //relacion con proveedores
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'usuario_id');
    }

    //relacion con repuestos 
    public function repuestos()
    {
        return $this->hasMany(Repuesto::class, 'usuario_id');
    }

    //relacion con clientes
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'usuario_id');
    }
}
