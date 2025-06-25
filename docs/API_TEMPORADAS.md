# API de Temporadas

## Descripción
API para la gestión de temporadas en el sistema de corte de arroz. Permite a usuarios autenticados registrar, consultar, actualizar y eliminar temporadas.

## Autenticación
Todas las rutas requieren autenticación JWT mediante el header:
```
Authorization: Beare### Validación de Solapamiento de Fechas
El sistema verifica automáticamente que no se creen temporadas con fechas que se solapen para el mismo usuario. Si se intenta crear o actualizar una temporada con fechas que se cruzan con otra temporada existente del mismo usuario, se retornará un error.

### Relaciones
Cada temporada está asociada al usuario que la registró mediante la clave foránea `usuario_id`. La respuesta siempre incluye la información básica del usuario relacionado.}
```

## Endpoints

### 1. Listar todas las temporadas
**GET** `/api/temporadas`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nombre": "Temporada 2025-1",
            "fecha_inicio": "2025-01-15",
            "fecha_fin": "2025-04-30",
            "valor_bulto": 25000.00,
            "usuario_id": 1,
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z",
            "usuario": {
                "id": 1,
                "nombre": "Juan",
                "apellido": "Pérez",
                "email": "juan@example.com"
            }
        }
    ],
    "message": "Temporadas obtenidas exitosamente"
}
```

### 2. Registrar nueva temporada
**POST** `/api/temporadas`

**Parámetros:**
```json
{
    "nombre": "Temporada 2025-2",
    "fecha_inicio": "2025-07-01",
    "fecha_fin": "2025-10-31",
    "valor_bulto": 28000.00
}
```

**Validaciones:**
- `nombre`: Obligatorio, string, máximo 250 caracteres
- `fecha_inicio`: Obligatorio, fecha válida, igual o posterior a hoy
- `fecha_fin`: Opcional, fecha válida, posterior a fecha_inicio
- `valor_bulto`: Obligatorio, número, entre 0 y 9999999.99

**Respuesta exitosa (201):**
```json
{
    "success": true,
    "data": {
        "id": 2,
        "nombre": "Temporada 2025-2",
        "fecha_inicio": "2025-07-01",
        "fecha_fin": "2025-10-31",
        "valor_bulto": 28000.00,
        "usuario_id": 1,
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:00:00.000000Z",
        "usuario": {
            "id": 1,
            "nombre": "Juan",
            "apellido": "Pérez",
            "email": "juan@example.com"
        }
    },
    "message": "Temporada registrada exitosamente"
}
```

### 3. Obtener temporada específica
**GET** `/api/temporadas/{id}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "nombre": "Temporada 2025-1",
        "fecha_inicio": "2025-01-15",
        "fecha_fin": "2025-04-30",
        "valor_bulto": 25000.00,
        "usuario_id": 1,
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:00:00.000000Z",
        "usuario": {
            "id": 1,
            "nombre": "Juan",
            "apellido": "Pérez",
            "email": "juan@example.com"
        }
    },
    "message": "Temporada obtenida exitosamente"
}
```

### 4. Actualizar temporada
**PUT** `/api/temporadas/{id}`

**Parámetros:**
```json
{
    "nombre": "Temporada 2025-1 Actualizada",
    "fecha_inicio": "2025-02-01",
    "fecha_fin": "2025-05-31",
    "valor_bulto": 30000.00
}
```

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "nombre": "Temporada 2025-1 Actualizada",
        "fecha_inicio": "2025-02-01",
        "fecha_fin": "2025-05-31",
        "valor_bulto": 30000.00,
        "usuario_id": 1,
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:30:00.000000Z",
        "usuario": {
            "id": 1,
            "nombre": "Juan",
            "apellido": "Pérez",
            "email": "juan@example.com"
        }
    },
    "message": "Temporada actualizada exitosamente"
}
```

### 5. Eliminar temporada
**DELETE** `/api/temporadas/{id}`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Temporada eliminada exitosamente"
}
```

### 6. Obtener temporadas del usuario autenticado
**GET** `/api/temporadas/usuario`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nombre": "Temporada 2025-1",
            "fecha_inicio": "2025-01-15",
            "fecha_fin": "2025-04-30",
            "valor_bulto": 25000.00,
            "usuario_id": 1,
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z",
            "usuario": {
                "id": 1,
                "nombre": "Juan",
                "apellido": "Pérez",
                "email": "juan@example.com"
            }
        }
    ],
    "message": "Temporadas del usuario obtenidas exitosamente"
}
```

### 7. Obtener temporadas en rango de fechas
**POST** `/api/temporadas/rango`

**Parámetros:**
```json
{
    "fecha_inicio": "2025-01-01",
    "fecha_fin": "2025-12-31"
}
```

**Validaciones:**
- `fecha_inicio`: Obligatorio, fecha válida
- `fecha_fin`: Obligatorio, fecha válida, igual o posterior a fecha_inicio

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nombre": "Temporada 2025-1",
            "fecha_inicio": "2025-01-15",
            "fecha_fin": "2025-04-30",
            "valor_bulto": 25000.00,
            "usuario_id": 1,
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z",
            "usuario": {
                "id": 1,
                "nombre": "Juan",
                "apellido": "Pérez",
                "email": "juan@example.com"
            }
        }
    ],
    "message": "Temporadas en el rango obtenidas exitosamente"
}
```

### 8. Buscar temporadas por nombre
**POST** `/api/temporadas/buscar`

**Parámetros:**
```json
{
    "nombre": "2025"
}
```

**Validaciones:**
- `nombre`: Obligatorio, string, mínimo 1 carácter

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nombre": "Temporada 2025-1",
            "fecha_inicio": "2025-01-15",
            "fecha_fin": "2025-04-30",
            "valor_bulto": 25000.00,
            "usuario_id": 1,
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z",
            "usuario": {
                "id": 1,
                "nombre": "Juan",
                "apellido": "Pérez",
                "email": "juan@example.com"
            }
        }
    ],
    "message": "Búsqueda de temporadas completada exitosamente"
}
```

## Respuestas de Error

### Error de validación (400)
```json
{
    "success": false,
    "message": "Error al registrar la temporada: El nombre de la temporada es obligatorio."
}
```

### Usuario no autenticado (401)
```json
{
    "success": false,
    "message": "Usuario no autenticado"
}
```

### Temporada no encontrada (404)
```json
{
    "success": false,
    "message": "Error al obtener la temporada: Temporada no encontrada."
}
```

### Error del servidor (500)
```json
{
    "success": false,
    "message": "Error al obtener las temporadas: [mensaje específico del error]"
}
```

## Características Especiales

### Validación de Solapamiento de Fechas
El sistema verifica automáticamente que no se creen temporadas con fechas que se solapen para el mismo usuario. Si se intenta crear o actualizar una temporada con fechas que se cruzan con otra temporada existente del mismo usuario, se retornará un error.

### Soft Deletes
Las temporadas eliminadas no se borran físicamente de la base de datos, sino que se marcan como eliminadas (soft delete) para mantener la integridad referencial.

### Relaciones
Cada temporada está asociada al usuario que la registró mediante la clave foránea `usuario_id`. La respuesta siempre incluye la información básica del usuario relacionado.
