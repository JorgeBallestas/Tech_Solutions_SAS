# Sistema de Gestión de RRHH

## Descripcion
Este repositorio contiene la implementacion del nucleo logico del Sistema de Gestion de RRHH para Tech Solutions SAS. El proyecto ha sido desarrollado siguiendo estrictamente la metodologia TDD (Test-Driven Development) y todos los tests estan actualmente en verde.

El desarrollo se centra exclusivamente en la **logica de negocio del backend** (modelos, servicios y pruebas), sin interfaz grafica de usuario, tal como se especifica en el [Documento de Requisitos del Producto (PRD)](index.html).

Actualmente se han completado los cuatro paquetes del sistema:
- **Paquete 1:** Gestion de Colaboradores (CP-001)
- **Paquete 2:** Gestion de Contratos (CP-002)
- **Paquete 3:** Gestion de Prórrogas (CP-003)
- **Paquete 4:** Terminacion de Contratos (CP-004)

## Stack Tecnologico
- **Framework Backend:** Laravel 11
- **Lenguaje:** PHP 8.2+
- **Base de Datos:** MySQL 8.0+
- **Pruebas:** PHPUnit
- **Autenticacion:** Laravel Breeze
- **Roles y Permisos:** `spatie/laravel-permission`
- **Servidor Web:** Nginx / Apache

## Casos de Prueba Implementados

### Paquete 1: Gestion de Colaboradores (CP-001)

| ID | Descripcion | Estado |
|----|-------------|--------|
| CP-001-01 | Verificar que se puede crear un nuevo colaborador con datos validos | Pasa |
| CP-001-02 | Verificar que el sistema rechaza la creacion con documento duplicado | Pasa |
| CP-001-03 | Verificar que se puede actualizar la informacion de un colaborador existente | Pasa |
| CP-001-04 | Verificar que se puede obtener el listado de todos los colaboradores | Pasa |
| CP-001-05 | Verificar que se puede eliminar (soft-delete) un colaborador | Pasa |

### Paquete 2: Gestion de Contratos (CP-002)

| ID | Descripcion | Estado |
|----|-------------|--------|
| CP-002-01 | Verificar que se puede crear un contrato y asociarlo a un colaborador existente | Pasa |
| CP-002-02 | Verificar que no se puede crear un contrato para un colaborador inexistente | Pasa |
| CP-002-03 | Verificar que los campos de fecha y salario son validados correctamente | Pasa |
| CP-002-04 | Verificar que se puede actualizar un contrato existente | Pasa |

### Paquete 3: Gestion de Prórrogas (CP-003)

| ID | Descripcion | Estado |
|----|-------------|--------|
| CP-003-01 | Verificar que se puede añadir una prórroga (en tiempo o valor) a un contrato de tipo "Fijo" o "Prestacion de Servicios" | Pasa |
| CP-003-02 | Verificar que la fecha de finalizacion del contrato se actualiza correctamente al añadir una prórroga de tiempo | Pasa |
| CP-003-03 | Verificar que el sistema rechaza una prórroga para un contrato con estado "Terminado" o "Finalizado" | Pasa |

### Paquete 4: Terminacion de Contratos (CP-004)

| ID | Descripcion | Estado |
|----|-------------|--------|
| CP-004-01 | Verificar que se puede cambiar el estado de un contrato a "Terminado" | Pasa |
| CP-004-02 | Verificar que se registra correctamente la fecha y el motivo de la terminacion | Pasa |
| CP-004-03 | Verificar que no se puede terminar un contrato que ya ha finalizado | Pasa |

## Estructura del Proyecto
app/
├── Models/
│ ├── Collaborator.php
│ ├── Contract.php
│ ├── ContractExtension.php
│ └── ContractTermination.php
├── Services/
│ ├── CollaboratorService.php
│ ├── ContractService.php
│ ├── ContractExtensionService.php
│ └── ContractTerminationService.php
└── Exceptions/
├── DuplicateDocumentException.php
├── CollaboratorNotFoundException.php
├── InvalidContractStatusException.php
└── ContractAlreadyFinishedException.php

database/
├── migrations/
│ ├── [fecha]_create_collaborators_table.php
│ ├── [fecha]_create_contracts_table.php
│ ├── [fecha]_create_contract_extensions_table.php
│ └── [fecha]_create_contract_terminations_table.php
├── factories/
│ ├── CollaboratorFactory.php
│ ├── ContractFactory.php
│ ├── ContractExtensionFactory.php
│ └── ContractTerminationFactory.php
└── seeders/
├── CollaboratorSeeder.php
├── ContractSeeder.php
└── DatabaseSeeder.php

tests/
├── Unit/
│ ├── Collaborator/
│ │ └── CollaboratorModelTest.php
│ ├── Contract/
│ │ ├── ContractModelTest.php
│ │ ├── ContractExtensionTest.php
│ │ └── ContractTerminationTest.php
│ └── Services/
│ ├── CollaboratorServiceTest.php
│ ├── ContractServiceTest.php
│ ├── ContractExtensionServiceTest.php
│ └── ContractTerminationServiceTest.php
├── Feature/
│ └── Services/
│ ├── CollaboratorServiceTest.php
│ ├── ContractServiceTest.php
│ ├── ContractExtensionServiceTest.php
│ └── ContractTerminationServiceTest.php
└── TestCase.php

text

## Modelo de Datos

### Tablas Principales

**users** (Gestionada por Laravel)
- id (PK)
- name
- email (unique)
- password
- timestamps

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
- contract_type (enum: Fijo, Indefinido, Prestacion de Servicios)
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

**contract_terminations**
- id (PK)
- contract_id (FK a contracts.id, one-to-one)
- termination_date
- reason (text)
- created_at

### Relaciones
- Un Collaborator puede tener muchos Contracts.
- Un Contract pertenece a un Collaborator.
- Un Contract puede tener muchas Contract_Extensions.
- Un Contract puede tener una Contract_Termination.
- Un User tiene un rol (gestionado por spatie/laravel-permission).

## Requisitos Previos

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior
- Extensiones de PHP requeridas por Laravel

## Instalacion

```bash
# Clonar el repositorio
git clone https://github.com/JorgeBallestas/Tech_Solutions_SAS.git
cd Tech_Solutions_SAS

# Instalar dependencias
composer install

# Configurar archivo de entorno
cp .env.example .env

# Editar .env con las credenciales de la base de datos

# Generar clave de la aplicacion
php artisan key:generate

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
php artisan test --filter ContractModelTest

# Paquete 3: Prórrogas
php artisan test --filter Extension

# Paquete 4: Terminaciones
php artisan test --filter ContractTerminationTest
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
✓ prueba verificar que se puede añadir una prórroga en tiempo o valor a un contrato de tipo fijo o prestacion de servicios
✓ prueba verificar que la fecha de finalizacion del contrato se actualiza correctamente al añadir una prórroga de tiempo
✓ prueba verificar que el sistema rechaza una prórroga para un contrato con estado terminado o finalizado
Paquete 4 - Terminaciones:

text
✓ prueba verificar que se puede cambiar el estado de un contrato a terminado
✓ prueba verificar que se registra correctamente la fecha y el motivo de la terminacion
✓ prueba verificar que no se puede terminar un contrato que ya ha finalizado

Flujo de Trabajo (Git Flow)
El desarrollo sigue estrictamente el flujo de trabajo Git Flow especificado en el PRD:

main: Codigo de produccion estable.

develop: Rama principal de desarrollo.

feature/*: Ramas para nuevas funcionalidades.

Entregables Finales
Segun lo especificado en el PRD, este repositorio incluye:

Repositorio de GitHub completo

Documentacion de casos de prueba

Seeders para poblar la base de datos con datos de ejemplo

Proyecto Completado
Este repositorio tiene los cuatro paquetes completados y funcionando, cumpliendo con todos los casos de prueba especificados en el PRD:

Paquete	Modulo	Estado
CP-001	Gestion de Colaboradores	Completado
CP-002	Gestion de Contratos	Completado
CP-003	Gestion de Prorrogas	Completado
CP-004	Terminacion de Contratos	Completado

Autor
Jorge Alberto Ballestas Morales

Perfil: Estudiante de Analisis y Desarrollo de Software - SENA

Correo Electronico: ballestasjorge66@gmail.com

Licencia
Proyecto de uso academico y educativo.

Tech Solutions SAS 2026
*Paquetes 1, 2, 3 y 4: Colaboradores, Contratos, Prorrogas y Terminaciones - Completados*
Version: 1.1 | Fecha: 12 de Febrero de 2026
