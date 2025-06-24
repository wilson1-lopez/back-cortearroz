# API de Tipos de Trabajadores

Esta documentación describe los endpoints disponibles para gestionar los tipos de trabajadores en el sistema.

## Endpoints Disponibles

### 1. Obtener todos los tipos de trabajadores
- **URL**: `GET /api/tipos-trabajadores`
- **Descripción**: Obtiene una lista de todos los tipos de trabajadores ordenados alfabéticamente
- **Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Tipos de trabajadores obtenidos correctamente",
    "data": [
        {
            "id": 1,
            "nombre": "Operador de Máquina",
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z"
        }
    ]
}
```

### 2. Crear un nuevo tipo de trabajador
- **URL**: `POST /api/tipos-trabajadores`
- **Descripción**: Crea un nuevo tipo de trabajador
- **Cuerpo de la petición**:
```json
{
    "nombre": "Supervisor de Campo"
}
```
- **Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Tipo de trabajador creado exitosamente",
    "data": {
        "id": 2,
        "nombre": "Supervisor de Campo",
        "created_at": "2025-06-24T10:15:00.000000Z",
        "updated_at": "2025-06-24T10:15:00.000000Z"
    }
}
```

### 3. Obtener un tipo de trabajador específico
- **URL**: `GET /api/tipos-trabajadores/{id}`
- **Descripción**: Obtiene los detalles de un tipo de trabajador específico
- **Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Tipo de trabajador obtenido correctamente",
    "data": {
        "id": 1,
        "nombre": "Operador de Máquina",
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:00:00.000000Z"
    }
}
```

### 4. Actualizar un tipo de trabajador
- **URL**: `PUT /api/tipos-trabajadores/{id}`
- **Descripción**: Actualiza los datos de un tipo de trabajador existente
- **Cuerpo de la petición**:
```json
{
    "nombre": "Operador de Máquina Especializado"
}
```
- **Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Tipo de trabajador actualizado exitosamente",
    "data": {
        "id": 1,
        "nombre": "Operador de Máquina Especializado",
        "created_at": "2025-06-24T10:00:00.000000Z",
        "updated_at": "2025-06-24T10:30:00.000000Z"
    }
}
```

### 5. Eliminar un tipo de trabajador
- **URL**: `DELETE /api/tipos-trabajadores/{id}`
- **Descripción**: Elimina un tipo de trabajador del sistema
- **Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Tipo de trabajador eliminado exitosamente"
}
```

### 6. Buscar tipos de trabajadores por nombre
- **URL**: `GET /api/tipos-trabajadores/search?nombre={termino_busqueda}`
- **Descripción**: Busca tipos de trabajadores que contengan el término especificado en su nombre
- **Parámetros de consulta**:
  - `nombre` (string, requerido): Término de búsqueda
- **Ejemplo**: `GET /api/tipos-trabajadores/search?nombre=operador`
- **Respuesta exitosa**:
```json
{
    "success": true,
    "message": "Búsqueda realizada correctamente",
    "data": [
        {
            "id": 1,
            "nombre": "Operador de Máquina",
            "created_at": "2025-06-24T10:00:00.000000Z",
            "updated_at": "2025-06-24T10:00:00.000000Z"
        }
    ]
}
```

## Validaciones

### Campos requeridos para crear/actualizar:
- **nombre**: Requerido, máximo 250 caracteres, debe ser único

### Mensajes de error:
- `nombre.required`: "El nombre del tipo de trabajador es obligatorio."
- `nombre.string`: "El nombre debe ser una cadena de texto."
- `nombre.max`: "El nombre no puede tener más de 250 caracteres."
- `nombre.unique`: "Ya existe un tipo de trabajador con este nombre."

## Códigos de Estado HTTP

- `200`: Operación exitosa
- `201`: Recurso creado exitosamente
- `400`: Error en la petición (datos inválidos)
- `404`: Recurso no encontrado
- `422`: Error de validación
- `500`: Error interno del servidor

## Ejemplos de uso con cURL

### Crear un tipo de trabajador:
```bash
curl -X POST http://localhost:8000/api/tipos-trabajadores \
  -H "Content-Type: application/json" \
  -d '{"nombre": "Mecánico Especializado"}'
```

### Obtener todos los tipos de trabajadores:
```bash
curl -X GET http://localhost:8000/api/tipos-trabajadores
```

### Buscar tipos de trabajadores:
```bash
curl -X GET "http://localhost:8000/api/tipos-trabajadores/search?nombre=mecánico"
```
