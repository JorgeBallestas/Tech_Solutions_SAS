# Sistema de Gestión de RRHH - Paquete 1: Gestión de Colaboradores

## Descripción
Este repositorio contiene la implementación del primer paquete del Sistema de Gestión de RRHH: el módulo de Gestión de Colaboradores. El código ha sido desarrollado siguiendo la metodología TDD (Test-Driven Development) y todos los tests están actualmente en verde.

## Casos de Prueba Implementados (CP-001)

Los siguientes casos de prueba están implementados y pasando correctamente:

| ID | Descripción | Estado |
|----|-------------|--------|
| CP-001-01 | Verificar que se puede crear un nuevo colaborador con datos válidos | Pasa |
| CP-001-02 | Verificar que el sistema rechaza la creación con documento duplicado | Pasa |
| CP-001-03 | Verificar que se puede actualizar la información de un colaborador existente | Pasa |
| CP-001-04 | Verificar que se puede obtener el listado de todos los colaboradores | Pasa |
| CP-001-05 | Verificar que se puede eliminar (soft-delete) un colaborador | Pasa |

## Estructura del Proyecto
app/
├── Models/
│ └── Collaborator.php
├── Services/
│ └── CollaboratorService.php
└── Exceptions/
└── DuplicateDocumentException.php

database/
├── migrations/
│ └── [fecha]_create_collaborators_table.php
├── factories/
│ └── CollaboratorFactory.php
└── seeders/
└── CollaboratorSeeder.php

tests/
├── Unit/
│ └── Models/
│ └── CollaboratorTest.php
├── Feature/
│ └── Services/
│ └── CollaboratorServiceTest.php
└── TestCase.php

text

## Requisitos Previos

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior

## Instalación

```bash
# Clonar el repositorio
git clone [url-del-repositorio]
cd [nombre-del-directorio]

# Instalar dependencias
composer install

# Configurar archivo de entorno
cp .env.example .env
# Editar .env con las credenciales de la base de datos

# Ejecutar migraciones
php artisan migrate
Ejecutar las Pruebas
Para ejecutar todas las pruebas del paquete:

bash
php artisan test --filter Collaborator
Para ejecutar un caso de prueba específico:

bash
php artisan test --filter test_can_create_collaborator_with_valid_data
php artisan test --filter test_cannot_create_collaborator_with_duplicate_document
php artisan test --filter test_can_update_existing_collaborator
php artisan test --filter test_can_list_all_collaborators
php artisan test --filter test_can_soft_delete_collaborator
Comandos Útiles
bash
# Ejecutar tests y detenerse en el primer fallo
php artisan test --stop-on-failure

# Ver cobertura de código (requiere Xdebug)
php artisan test --coverage
Flujo de Trabajo
Este paquete se desarrolló siguiendo el ciclo TDD:

Se escribieron los tests primero (fallaban)

Se implementó la lógica mínima para que pasaran

Se refactorizó manteniendo los tests en verde

El resultado es un código limpio, probado y listo para integrarse con los siguientes paquetes.

Convención de Commits
Los commits en este repositorio siguen la especificación Conventional Commits:

text
feat(collaborators): implementar creación de colaboradores
test(collaborators): agregar test para documento duplicado
refactor(collaborators): extraer validaciones a métodos privados
Próximos Pasos
Este paquete está completo y funcionando. Los siguientes paquetes a desarrollar serán:

Gestión de Contratos (CP-002)

Gestión de Prórrogas (CP-003)

Terminación de Contratos (CP-004)

Tech Solutions SAS
*Paquete 1: Gestión de Colaboradores - Completado*

