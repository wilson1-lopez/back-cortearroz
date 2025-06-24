# API de Clientes - Documentación

## Descripción
Esta API permite gestionar los clientes de los dueños de máquinas cortadoras de arroz. Cada usuario puede registrar y administrar sus propios clientes.

## Endpoints Disponibles

### Autenticación
Todos los endpoints requieren autenticación JWT. Incluir el token en el header:
```
Authorization: Bearer {token}
```

### 1. Obtener todos los clientes del usuario autenticado
```
GET /api/clientesusuario
```

**Respuesta exitosa:**
```json
[
    {
        "id": 1,
        "nombre": "Juan",
        "apellido": "Pérez",
        "telefono": "3001234567",
        "cedula": "12345678",
        "direccion": "Calle 123 #45-67",
        "usuario_id": 1,
        "created_at": "2025-01-01T10:00:00.000000Z",
        "updated_at": "2025-01-01T10:00:00.000000Z"
    }
]
```

### 2. Crear un nuevo cliente
```
POST /api/clientes
```

**Cuerpo de la solicitud:**
```json
{
    "nombre": "Juan",
    "apellido": "Pérez",
    "telefono": "3001234567",
    "cedula": "12345678",
    "direccion": "Calle 123 #45-67"
}
```

**Campos obligatorios:**
- `nombre` (string, máx. 250 caracteres)
- `apellido` (string, máx. 250 caracteres)

**Campos opcionales:**
- `telefono` (string, máx. 250 caracteres)
- `cedula` (string, máx. 250 caracteres)
- `direccion` (string, máx. 250 caracteres)

**Respuesta exitosa (201):**
```json
{
    "id": 1,
    "nombre": "Juan",
    "apellido": "Pérez",
    "telefono": "3001234567",
    "cedula": "12345678",
    "direccion": "Calle 123 #45-67",
    "usuario_id": 1,
    "created_at": "2025-01-01T10:00:00.000000Z",
    "updated_at": "2025-01-01T10:00:00.000000Z"
}
```

### 3. Obtener un cliente específico
```
GET /api/clientes/{id}
```

**Respuesta exitosa (200):**
```json
{
    "id": 1,
    "nombre": "Juan",
    "apellido": "Pérez",
    "telefono": "3001234567",
    "cedula": "12345678",
    "direccion": "Calle 123 #45-67",
    "usuario_id": 1,
    "created_at": "2025-01-01T10:00:00.000000Z",
    "updated_at": "2025-01-01T10:00:00.000000Z"
}
```

### 4. Actualizar un cliente
```
PUT /api/clientes/{id}
```

**Cuerpo de la solicitud:**
```json
{
    "nombre": "Juan Carlos",
    "apellido": "Pérez García",
    "telefono": "3009876543",
    "cedula": "87654321",
    "direccion": "Carrera 456 #78-90"
}
```

**Respuesta exitosa (200):**
```json
{
    "id": 1,
    "nombre": "Juan Carlos",
    "apellido": "Pérez García",
    "telefono": "3009876543",
    "cedula": "87654321",
    "direccion": "Carrera 456 #78-90",
    "usuario_id": 1,
    "created_at": "2025-01-01T10:00:00.000000Z",
    "updated_at": "2025-01-01T10:30:00.000000Z"
}
```

### 5. Eliminar un cliente
```
DELETE /api/clientes/{id}
```

**Respuesta exitosa (200):**
```json
{
    "message": "Cliente eliminado correctamente"
}
```

### 6. Obtener todos los clientes (admin)
```
GET /api/clientes
```

**Respuesta exitosa (200):**
```json
[
    {
        "id": 1,
        "nombre": "Juan",
        "apellido": "Pérez",
        "telefono": "3001234567",
        "cedula": "12345678",
        "direccion": "Calle 123 #45-67",
        "usuario_id": 1,
        "created_at": "2025-01-01T10:00:00.000000Z",
        "updated_at": "2025-01-01T10:00:00.000000Z"
    }
]
```

## Errores Comunes

### Error de Validación (422)
```json
{
    "message": "Errores de validación.",
    "errors": {
        "nombre": [
            "El nombre es obligatorio."
        ],
        "apellido": [
            "El apellido es obligatorio."
        ]
    }
}
```

### Cliente no encontrado (404)
```json
{
    "message": "Cliente no encontrado"
}
```

### Error de servidor (400)
```json
{
    "error": "No se pudo actualizar el cliente",
    "message": "Descripción del error específico"
}
```

## Arquitectura

La funcionalidad sigue la arquitectura establecida en el proyecto:

1. **Modelo**: `App\Models\Cliente`
2. **Controlador**: `App\Http\Controllers\ClienteController`
3. **Servicio**: `App\Services\ClienteService`
4. **Repositorio**: `App\Repositories\Cliente\ClienteRepository`
5. **Interfaz**: `App\Repositories\Cliente\Interfaces\ClienteRepositoryInterface`
6. **Request**: `App\Http\Requests\ClienteRequest`
7. **Rutas**: `routes/api/clientes.php`

## Relaciones

- Un cliente pertenece a un usuario (`usuario_id`)
- Un usuario puede tener muchos clientes
