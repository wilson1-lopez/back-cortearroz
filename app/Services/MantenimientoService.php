<?php

namespace App\Services;

use App\Repositories\Mantenimiento\Interfaces\MantenimientoRepositoryInterface;
use App\Services\RepuestoMantenimientoService;
use App\Services\AccionMantenimientoService;
use App\Services\RepuestoProveedoresService; // Asegúrate de tener este servicio

class MantenimientoService
{    
    protected $repuestoMantenimientoService;
    protected $accionMantenimientoService;
    protected $repuestoProveedorService; // Nuevo

    public function __construct(
        protected MantenimientoRepositoryInterface $mantenimientoRepository,
        RepuestoMantenimientoService $repuestoMantenimientoService,
        AccionMantenimientoService $accionMantenimientoService,
        RepuestoProveedoresService $repuestoProveedorService // Nuevo
    ){
        $this->mantenimientoRepository = $mantenimientoRepository;
        $this->repuestoMantenimientoService = $repuestoMantenimientoService;
        $this->accionMantenimientoService = $accionMantenimientoService;
        $this->repuestoProveedorService = $repuestoProveedorService; // Nuevo
    }

    public function registrarMantenimiento(array $data)
    {
        return $this->mantenimientoRepository->create($data);
    }

    public function registrarMantenimientoCompleto(array $data)
    {
        // Crear el mantenimiento
        $mantenimientoData = [
            'maquina_id' => $data['maquina_id'],
            'fecha' => $data['fecha'],
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'realizado_por' => $data['realizado_por'],
        ];
        $mantenimiento = $this->mantenimientoRepository->create($mantenimientoData);

        // Crear repuesto_proveedores asociados (si existen)
        $repuestoProveedorIds = [];
        if (!empty($data['repuesto_proveedores'])) {
            foreach ($data['repuesto_proveedores'] as $rp) {
                // Se asume que el método retorna el modelo creado o su id
                $repuestoProveedor = $this->repuestoProveedorService->registrarRepuestoProveedores($rp);
                $repuestoProveedorIds[$rp['repuesto_id']] = $repuestoProveedor->id ?? $repuestoProveedor;
            }
        }

        // Crear repuestos_mantenimiento asociados (si existen)
        if (!empty($data['repuesto_mantenimiento'])) {
            foreach ($data['repuesto_mantenimiento'] as $repuesto) {
                $repuesto['mantenimiento_id'] = $mantenimiento->id;
                // Relacionar con repuesto_proveedor si existe
                if (isset($repuestoProveedorIds[$repuesto['repuesto_id']])) {
                    $repuesto['repuestos_proveedores_id'] = $repuestoProveedorIds[$repuesto['repuesto_id']];
                    unset($repuesto['repuesto_proveedor_id']);
                }
                // Asegura que el campo 'valor' esté presente
                if (isset($repuesto['precio_proveedor'])) {
                    $repuesto['valor'] = $repuesto['precio_proveedor'];
                }
                $this->repuestoMantenimientoService->registrarRepuestoMantenimiento($repuesto);
            }
        }

        // Crear acciones asociadas
        if (!empty($data['acciones'])) {
            foreach ($data['acciones'] as $accion) {
                $accion['mantenimiento_id'] = $mantenimiento->id;
                $this->accionMantenimientoService->registrarAccionMantenimiento($accion);
            }
        }

        // Retornar el mantenimiento con relaciones
        return $mantenimiento->load(['repuestos_mantenimientos', 'accionmantenimientos']);
    }

    public function obtenerDetallePorMaquinaId($id)
    {
        $maquina = $this->mantenimientoRepository->obtenerMantenimientosPorMaquinaId($id);

        if (!$maquina) {
            return null;
        }

        $mantenimientos = $maquina->mantenimientos->map(function ($m) {
            $repuestos = $m->repuestos_mantenimientos->map(function ($r) {
                return [
                    'id' => $r->id,
                    'cantidad' => $r->cantidad,
                    'valor' => $r->valor,
                    'forma_pago' => $r->forma_pago,
                    'repuesto' => [
                        'id' => $r->repuestos_proveedores->repuesto->id ?? null,
                        'nombre' => $r->repuestos_proveedores->repuesto->nombre ?? null,
                    ],
                    'proveedor' => [
                        'id' => $r->repuestos_proveedores->proveedor->id ?? null,
                        'nombre' => $r->repuestos_proveedores->proveedor->nombre ?? null,
                    ],
                    'precio_proveedor' => $r->repuestos_proveedores->precio ?? null,
                ];
            });

            // Sumar el valor total de los repuestos (cantidad * valor)
            $totalRepuestos = $m->repuestos_mantenimientos->reduce(function ($carry, $item) {
                return $carry + ((float) $item->valor * (int) $item->cantidad);
            }, 0);

            return [
                'id' => $m->id,
                'fecha' => $m->fecha,
                'nombre' => $m->nombre,
                'descripcion' => $m->descripcion,
                'realizado_por' => $m->realizado_por,
                'acciones' => $m->accionmantenimientos->map(function ($a) {
                    return [
                        'id' => $a->id,
                        'descripcion' => $a->descripcion,
                    ];
                }),
                'repuestos' => $repuestos,
                'total_repuestos' => $totalRepuestos,
            ];
        });

        return [
            'maquina_id' => $maquina->id,
            'maquina_nombre' => $maquina->nombre,
            'mantenimientos' => $mantenimientos,
        ];
    }
}
