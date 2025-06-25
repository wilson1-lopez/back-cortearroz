<?php

namespace App\Providers;


use App\Repositories\AccionMantenimiento\AccionMantenimientoRepository;
use App\Repositories\AccionMantenimiento\Interfaces\AccionMantenimientoRepositoryInterface;
use App\Repositories\AuthRepository\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository\AuthRepository;
use App\Repositories\Usuario\UsuarioRepository;
use App\Repositories\Maquina\MaquinaRepository;
use App\Repositories\Usuario\Interfaces\UsuarioRepositoryInterface;
use App\Repositories\Maquina\Interfaces\MaquinaRepositoryInterface;
use App\Repositories\Mantenimiento\Interfaces\MantenimientoRepositoryInterface;
use App\Repositories\Mantenimiento\MantenimientoRepository;
use App\Repositories\Proveedor\Interfaces\ProveedorRepositoyInterface;
use App\Repositories\Proveedor\ProveedorRepository;
use App\Repositories\Repuesto\Interfaces\RepuestoRepositoryInterface;
use App\Repositories\Repuesto\RepuestoRepository;
use App\Repositories\RepuestoProveedores\RepuestoProveedoresRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RepuestoProveedores\Interfaces\RepuestoProveedoresRepositoryInterface;
use App\Repositories\RepuestoMantenimiento\Interfaces\RepuestoMantenimientoRepositoryInterface;
use App\Repositories\RepuestoMantenimiento\RepuestoMantenimientoRepository;
use App\Repositories\Cliente\Interfaces\ClienteRepositoryInterface;
use App\Repositories\Cliente\ClienteRepository;
use App\Repositories\TipoTrabajador\Interfaces\TipoTrabajadorRepositoryInterface;
use App\Repositories\TipoTrabajador\TipoTrabajadorRepository;
use App\Repositories\Trabajador\Interfaces\TrabajadorRepositoryInterface;
use App\Repositories\Trabajador\TrabajadorRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsuarioRepositoryInterface::class, UsuarioRepository::class);
        $this->app->bind(MaquinaRepositoryInterface::class, MaquinaRepository::class);
        $this->app->bind(MantenimientoRepositoryInterface::class, MantenimientoRepository::class);
        $this->app->bind(AccionMantenimientoRepositoryInterface::class, AccionMantenimientoRepository::class);
        $this->app->bind(RepuestoRepositoryInterface::class, RepuestoRepository::class);
        $this->app->bind(RepuestoProveedoresRepositoryInterface::class, RepuestoProveedoresRepository::class);
        //proveedores
        $this->app->bind(ProveedorRepositoyInterface::class, ProveedorRepository::class);

        //RepuestoMantenimiento
        $this->app->bind(RepuestoMantenimientoRepositoryInterface::class, RepuestoMantenimientoRepository::class);

        //Cliente
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);

        //TipoTrabajador
        $this->app->bind(TipoTrabajadorRepositoryInterface::class, TipoTrabajadorRepository::class);

        //Trabajador
        $this->app->bind(TrabajadorRepositoryInterface::class, TrabajadorRepository::class);

        //login
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
