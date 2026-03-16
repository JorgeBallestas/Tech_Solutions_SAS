# Sistema de Gestión de RRHH

## Descripción
Este repositorio contiene la implementación del núcleo lógico del Sistema de Gestión de RRHH para Tech Solutions SAS. El proyecto ha sido desarrollado siguiendo estrictamente la metodología TDD (Test-Driven Development) y todos los tests están actualmente en verde.

El desarrollo se centra exclusivamente en la **lógica de negocio del backend** (modelos, servicios y pruebas), sin interfaz gráfica de usuario.

Actualmente se han completado tres paquetes:
- **Paquete 1:** Gestión de Colaboradores (CP-001)
- **Paquete 2:** Gestión de Contratos (CP-002)
- **Paquete 3:** Gestión de Prórrogas (CP-003)

## Stack Tecnológico
- **Framework Backend:** Laravel 11
- **Lenguaje:** PHP 8.2+
- **Base de Datos:** MySQL 8.0+
- **Pruebas:** PHPUnit
- **Roles y Permisos:** `spatie/laravel-permission`

## Casos de Prueba Implementados

### Paquete 1: Gestión de Colaboradores (CP-001)

| ID | Descripción | Estado |
|----|-------------|--------|
| CP-001-01 | Verificar que se puede crear un nuevo colaborador con datos válidos | Pasa |
| CP-001-02 | Verificar que el sistema rechaza la creación con documento duplicado | Pasa |
| CP-001-03 | Verificar que se puede actualizar la información de un colaborador existente | Pasa |
| CP-001-04 | Verificar que se puede obtener el listado de todos los colaboradores | Pasa |
| CP-001-05 | Verificar que se puede eliminar (soft-delete) un colaborador | Pasa |

### Paquete 2: Gestión de Contratos (CP-002)

| ID | Descripción | Estado |
|----|-------------|--------|
| CP-002-01 | Verificar que se puede crear un contrato y asociarlo a un colaborador existente | Pasa |
| CP-002-02 | Verificar que no se puede crear un contrato para un colaborador inexistente | Pasa |
| CP-002-03 | Verificar que los campos de fecha y salario son validados correctamente | Pasa |
| CP-002-04 | Verificar que se puede actualizar un contrato existente | Pasa |

### Paquete 3: Gestión de Prórrogas (CP-003)

| ID | Descripción | Estado |
|----|-------------|--------|
| CP-003-01 | Verificar que se puede añadir una prórroga (en tiempo o valor) a un contrato de tipo "Fijo" o "Prestación de Servicios" | Pasa |
| CP-003-02 | Verificar que la fecha de finalización del contrato se actualiza correctamente al añadir una prórroga de tiempo | Pasa |
| CP-003-03 | Verificar que el sistema rechaza una prórroga para un contrato con estado "Terminado" o "Finalizado" | Pasa |

## Estructura del Proyecto
app/
├── Models/
│ ├── Collaborator.php
│ ├── Contract.php
│ └── ContractExtension.php
├── Services/
│ ├── CollaboratorService.php
│ ├── ContractService.php
│ └── ContractExtensionService.php
└── Exceptions/
├── DuplicateDocumentException.php
├── CollaboratorNotFoundException.php
└── InvalidContractStatusException.php

database/
├── migrations/
│ ├── [fecha]_create_collaborators_table.php
│ ├── [fecha]_create_contracts_table.php
│ └── [fecha]_create_contract_extensions_table.php
├── factories/
│ ├── CollaboratorFactory.php
│ ├── ContractFactory.php
│ └── ContractExtensionFactory.php
└── seeders/
├── CollaboratorSeeder.php
├── ContractSeeder.php
└── DatabaseSeeder.php

tests/
├── Unit/
│ ├── Models/
│ │ ├── CollaboratorTest.php
│ │ ├── ContractTest.php
│ │ └── ContractExtensionTest.php
│ └── Services/
│ ├── CollaboratorServiceTest.php
│ ├── ContractServiceTest.php
│ └── ContractExtensionServiceTest.php
├── Feature/
│ └── Services/
│ ├── CollaboratorServiceTest.php
│ ├── ContractServiceTest.php
│ └── ContractExtensionServiceTest.php
└── TestCase.php

text

## Modelo de Datos

### Tablas Principales

**collaborators**
- id (PK)
- first_name
- last_name
- document_type (enum: CC, CE, PPT)
- document_number (unique)
- birth_date
- email
- phone_number
- address
- timestamps

**contracts**
- id (PK)
- collaborator_id (FK a collaborators.id)
- contract_type (enum: Fijo, Indefinido, Prestación de Servicios)
- start_date
- end_date (nullable para indefinidos)
- position (cargo)
- salary (decimal)
- status (enum: Activo, Terminado, Finalizado)
- timestamps

**contract_extensions**
- id (PK)
- contract_id (FK a contracts.id)
- extension_type (enum: Tiempo, Valor)
- new_end_date (nullable)
- additional_value (decimal, nullable)
- description
- created_at

**contract_terminations** (próximo paquete)
- id (PK)
- contract_id (FK a contracts.id, one-to-one)
- termination_date
- reason (text)
- created_at

### Relaciones
- Un **Collaborator** puede tener muchos **Contracts**.
- Un **Contract** pertenece a un **Collaborator**.
- Un **Contract** puede tener muchas **Contract_Extensions**.
- Un **Contract** puede tener una **Contract_Termination**.

## Requisitos Previos

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior
- Extensiones de PHP requeridas por Laravel

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
Ejecutar todas las pruebas
bash
php artisan test
Ejecutar pruebas por paquete
bash
# Paquete 1: Colaboradores
php artisan test --filter Collaborator

# Paquete 2: Contratos
php artisan test --filter Contract

# Paquete 3: Prórrogas
php artisan test --filter Extension
Resultados de las pruebas

Paquete 1 - Colaboradores:

text
✓ puede crear un colaborador con datos validos
✓ rechaza creacion cuando documento o email estan duplicados
✓ puede actualizar colaborador existente
✓ puede obtener listado de colaboradores
✓ puede eliminar colaborador con soft delete
Paquete 2 - Contratos:

text
✓ prueba verificar que se puede crear un contrato y asociarlo a un colaborador existente
✓ prueba verificar que no se puede crear un contrato para un colaborador inexistente
✓ prueba verificar que los campos de fecha y salario son validados correctamente
✓ prueba verificar que se puede actualizar un contrato existente
Paquete 3 - Prórrogas:

text
✓ prueba verificar que se puede añadir una prórroga en tiempo o valor a un contrato de tipo fijo o prestación de servicios
✓ prueba verificar que la fecha de finalización del contrato se actualiza correctamente al añadir una prórroga de tiempo
✓ prueba verificar que el sistema rechaza una prórroga para un contrato con estado terminado o finalizado
Comandos Útiles
bash
# Ejecutar tests y detenerse en el primer fallo
php artisan test --stop-on-failure

# Ver cobertura de código (requiere Xdebug)
php artisan test --coverage

# Ejecutar tests en paralelo
php artisan test --parallel
Flujo de Trabajo (Git Flow)
El desarrollo sigue estrictamente el flujo de trabajo Git Flow:

main: Código de producción estable

develop: Rama principal de desarrollo

feature/*: Ramas para nuevas funcionalidades

release/*: Ramas para preparar lanzamientos

hotfix/*: Ramas para correcciones urgentes

Convención de Commits
Los mensajes de los commits siguen la especificación Conventional Commits:

text
feat(Collaborators): Implementa CRUD para Colaboradores con TDD
test(contracts): agregar test para validación de fechas
feat(extensions): implementar lógica de prórrogas de tiempo
refactor(extensions): extraer validaciones a métodos privados
Entregables Finales
 Repositorio de GitHub completo

 Documentación de casos de prueba

 Seeders para poblar la base de datos con datos de ejemplo

Próximos Pasos
Este repositorio tiene tres paquetes completados y funcionando. El siguiente paquete a desarrollar será:

Paquete 4: Terminación de Contratos (CP-004)
ID	Descripción	Estado
CP-004-01	Verificar que se puede cambiar el estado de un contrato a "Terminado"	Pendiente
CP-004-02	Verificar que se registra correctamente la fecha y el motivo de la terminación	Pendiente
CP-004-03	Verificar que no se puede terminar un contrato que ya ha finalizado	Pendiente
Flujo Principal:

El usuario localiza el contrato activo que desea terminar

Selecciona la opción "Terminación Anticipada"

El sistema solicita la fecha de terminación y un campo para justificar el motivo

El usuario confirma la acción

El sistema actualiza el estado del contrato a "Terminado" y guarda la información de la terminación

Tech Solutions SAS © 2026
*Paquetes 1, 2 y 3: Colaboradores, Contratos y Prórrogas - Completados*
Versión: 1.1 | Fecha: 12 de Febrero de 2026