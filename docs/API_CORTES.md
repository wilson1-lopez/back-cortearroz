# API de Cortes

## Descripción
API para la gestión de cortes en el sistema de corte de arroz. Permite a usuarios autenticados registrar, consultar, actualizar y eliminar cortes, así como asignar máquinas y trabajadores a los mismos.

## Autenticación
Todas las rutas requieren autenticación JWT mediante el header:
```
Authorization: Bearer {token}
```

## Endpoints

### 1. Listar todos los cortes
**GET** `/api/cortes`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "fecha_inicio": "2025-07-01",
            "fecha_fin": "2025-07-15",
            "valor_bulto": 25000.00,
            "descripcion": "Corte de arroz temporada verano",
            "cliente_id": 1,
            "temporada_id": 1,
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z",
            "cliente": {
                "id": 1,
                "nombre": "Juan Pérez",
                "email": "juan@example.com"
            },
            "temporada": {
                "id": 1,
                "nombre": "Temporada 2025-1",
                "fecha_inicio": "2025-01-15",
                "fecha_fin": "2025-04-30"
            },
            "maquinas": [
                {
                    "id": 1,
                    "nombre": "Cosechadora ABC",
                    "modelo": "2023"
                }
            ],
            "trabajadores": [
                {
                    "id": 1,
                    "nombre": "Carlos",
                    "apellido": "López",
                    "pivot": {
                        "precio_acordado": 150000.00
                    }
                }
            ]
        }
    ],
    "message": "Cortes obtenidos exitosamente"
}
```

### 2. Registrar nuevo corte
**POST** `/api/cortes`

**Parámetros:**
```json
{
    "fecha_inicio": "2025-07-01",
    "fecha_fin": "2025-07-15",
    "valor_bulto": 25000.00,
    "descripcion": "Corte de arroz temporada verano",
    "cliente_id": 1,
    "temporada_id": 1,
    "maquinas": [1, 2],
    "trabajadores": [
        {
            "trabajador_id": 1,
            "precio_acordado": 150000.00
        },
        {
            "trabajador_id": 2,
            "precio_acordado": 120000.00
        }
    ]
}
```

**Validaciones:**
- `fecha_inicio`: Obligatorio, fecha válida, igual o posterior a hoy
- `fecha_fin`: Opcional, fecha válida, posterior a fecha_inicio
- `valor_bulto`: Obligatorio, número, entre 0 y 9999999.99
- `descripcion`: Opcional, string, máximo 250 caracteres
- `cliente_id`: Obligatorio, debe existir en la tabla clientes
- `temporada_id`: Obligatorio, debe existir en la tabla temporadas
- `maquinas`: Opcional, arreglo de IDs de máquinas existentes
- `trabajadores`: Opcional, arreglo con trabajador_id y precio_acordado

**Respuesta exitosa (201):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "fecha_inicio": "2025-07-01",
        "fecha_fin": "2025-07-15",
        "valor_bulto": 25000.00,
        "descripcion": "Corte de arroz temporada verano",
        "cliente_id": 1,
        "temporada_id": 1,
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:00:00.000000Z",
        "cliente": { ... },
        "temporada": { ... },
        "maquinas": [ ... ],
        "trabajadores": [ ... ]
    },
    "message": "Corte registrado exitosamente"
}
```

### 3. Obtener corte específico
**GET** `/api/cortes/{id}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "fecha_inicio": "2025-07-01",
        "fecha_fin": "2025-07-15",
        "valor_bulto": 25000.00,
        "descripcion": "Corte de arroz temporada verano",
        "cliente_id": 1,
        "temporada_id": 1,
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:00:00.000000Z",
        "cliente": { ... },
        "temporada": { ... },
        "maquinas": [ ... ],
        "trabajadores": [ ... ]
    },
    "message": "Corte obtenido exitosamente"
}
```

### 4. Actualizar corte
**PUT** `/api/cortes/{id}`

**Parámetros:**
```json
{
    "fecha_inicio": "2025-07-02",
    "fecha_fin": "2025-07-16",
    "valor_bulto": 28000.00,
    "descripcion": "Corte de arroz temporada verano actualizado",
    "cliente_id": 1,
    "temporada_id": 1,
    "maquinas": [1, 3],
    "trabajadores": [
        {
            "trabajador_id": 1,
            "precio_acordado": 160000.00
        }
    ]
}
```

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": { ... },
    "message": "Corte actualizado exitosamente"
}
```

### 5. Eliminar corte
**DELETE** `/api/cortes/{id}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Corte eliminado exitosamente"
}
```

### 6. Obtener cortes por cliente
**GET** `/api/cortes/cliente/{clienteId}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [ ... ],
    "message": "Cortes del cliente obtenidos exitosamente"
}
```

### 7. Obtener cortes por temporada
**GET** `/api/cortes/temporada/{temporadaId}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [ ... ],
    "message": "Cortes de la temporada obtenidos exitosamente"
}
```

### 8. Obtener cortes activos
**GET** `/api/cortes/activos`

Retorna cortes que no tienen fecha_fin o cuya fecha_fin es futura.

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [ ... ],
    "message": "Cortes activos obtenidos exitosamente"
}
```

### 9. Obtener cortes en rango de fechas
**POST** `/api/cortes/rango`

**Parámetros:**
```json
{
    "fecha_inicio": "2025-07-01",
    "fecha_fin": "2025-07-31"
}
```

**Validaciones:**
- `fecha_inicio`: Obligatorio, fecha válida
- `fecha_fin`: Obligatorio, fecha válida, igual o posterior a fecha_inicio

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [ ... ],
    "message": "Cortes en el rango obtenidos exitosamente"
}
```

### 10. Buscar cortes por descripción
**POST** `/api/cortes/buscar`

**Parámetros:**
```json
{
    "descripcion": "verano"
}
```

**Validaciones:**
- `descripcion`: Obligatorio, string, mínimo 1 carácter

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [ ... ],
    "message": "Búsqueda de cortes completada exitosamente"
}
```

### 11. Obtener cortes por cliente y temporada
**GET** `/api/cortes/cliente/{clienteId}/temporada/{temporadaId}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [ ... ],
    "message": "Cortes del cliente y temporada obtenidos exitosamente"
}
```

## Respuestas de Error

### Error de validación (400)
```json
{
    "success": false,
    "message": "Error al registrar el corte: La fecha de inicio es obligatoria."
}
```

### Usuario no autenticado (401)
```json
{
    "success": false,
    "message": "Usuario no autenticado"
}
```

### Corte no encontrado (404)
```json
{
    "success": false,
    "message": "Error al obtener el corte: Corte no encontrado."
}
```

### Error del servidor (500)
```json
{
    "success": false,
    "message": "Error al obtener los cortes: [mensaje específico del error]"
}
```

## Características Especiales

### Validación de Solapamiento de Fechas
El sistema verifica automáticamente que no se creen cortes con fechas que se solapen para el mismo cliente y temporada. Si se intenta crear o actualizar un corte con fechas que se cruzan con otro corte existente del mismo cliente y temporada, se retornará un error.

### Relaciones Many-to-Many
Los cortes pueden tener múltiples máquinas y trabajadores asignados:
- **Máquinas**: Relación simple many-to-many a través de la tabla `maquinas_cortes`
- **Trabajadores**: Relación many-to-many con información adicional (`precio_acordado`) a través de la tabla `trabajadores_corte`

### Gestión de Relaciones en el Registro
Al crear o actualizar un corte, puedes incluir máquinas y trabajadores en la misma petición. El sistema se encarga de:
1. Crear/actualizar el corte principal
2. Asignar las máquinas especificadas
3. Asignar los trabajadores con sus precios acordados
4. Retornar el corte completo con todas las relaciones cargadas

### Estructura de Datos Relacionales
Cada corte incluye automáticamente:
- **Cliente**: Información completa del cliente asociado
- **Temporada**: Información completa de la temporada asociada  
- **Máquinas**: Lista de máquinas asignadas al corte
- **Trabajadores**: Lista de trabajadores con el precio acordado en la tabla pivot

### Scopes Disponibles
- `byCliente($clienteId)`: Filtrar cortes por cliente
- `byTemporada($temporadaId)`: Filtrar cortes por temporada
- `enRango($fechaInicio, $fechaFin)`: Filtrar cortes en rango de fechas
- `activos()`: Cortes sin fecha fin o con fecha fin futura
