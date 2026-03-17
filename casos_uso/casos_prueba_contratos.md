# Casos de Prueba -- Gestión de Contratos

## Caso 1: Crear un Contrato con Datos Válidos

### 1. ID del Caso de Prueba

**CP-CON-001**

### 2. Título de la Prueba

Verificar que se puede crear un contrato y asociarlo a un colaborador
existente

### 3. Módulo / Característica

**Contratos / Crear_Contrato**

### 4. Descripción

Esta prueba verifica que un usuario autenticado pueda crear un nuevo
contrato y asociarlo exitosamente a un colaborador existente.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   El colaborador debe existir en la base de datos.
-   El colaborador no debe tener un contrato activo del mismo tipo
    (opcional según reglas de negocio).

### 6. Pasos para la Ejecución

1.  El usuario inicia sesión.
2.  El usuario navega al perfil de un colaborador existente.
3.  El usuario accede a la pestaña de contratos.
4.  El usuario hace clic en **Nuevo Contrato**.
5.  El usuario completa el formulario con datos válidos.
6.  El usuario guarda el contrato.

### 7. Datos de Entrada

-   ID del Colaborador: (ID existente)
-   Tipo de contrato: Fijo
-   Fecha de inicio: 01/03/2026
-   Fecha de fin: 01/03/2027
-   Cargo: Desarrollador Backend
-   Salario: 3500000
-   Estado: Activo

### 8. Resultado Esperado

-   **Base de Datos:** Se crea un nuevo contrato en la tabla
    **contracts**.
-   El contrato queda asociado correctamente al colaborador mediante
    **collaborator_id**.
-   Todos los campos se guardan con los valores ingresados.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**


## Caso 2: Contrato para Colaborador Inexistente

### 1. ID del Caso de Prueba

**CP-CON-002**

### 2. Título de la Prueba

Verificar que no se puede crear un contrato para un colaborador
inexistente

### 3. Módulo / Característica

**Contratos / Validar_Colaborador**

### 4. Descripción

Esta prueba verifica que el sistema no permita crear un contrato
asociado a un ID de colaborador que no existe en la base de datos.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   El ID del colaborador proporcionado no debe existir en la base de
    datos.

### 6. Pasos para la Ejecución

1.  El usuario debe estar autenticado.
2.  El usuario intenta crear un contrato utilizando un ID de colaborador
    inexistente.

### 7. Datos de Entrada

-   ID del Colaborador: 99999 (inexistente)
-   Tipo de contrato: Fijo
-   Fecha de inicio: 01/03/2026
-   Fecha de fin: 01/03/2027
-   Cargo: Desarrollador Backend
-   Salario: 3500000

### 8. Resultado Esperado

-   El sistema rechaza la creación del contrato.
-   Muestra mensaje: **"El colaborador seleccionado no existe"**.
-   No se guarda información en la tabla **contracts**.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**



## Caso 3: Validación de Campos de Fecha y Salario

### 1. ID del Caso de Prueba

**CP-CON-003**

### 2. Título de la Prueba

Verificar que los campos de fecha y salario son validados correctamente

### 3. Módulo / Característica

**Contratos / Validar_Campos**

### 4. Descripción

Esta prueba verifica que el sistema valide correctamente los campos de
fecha y salario al crear o actualizar un contrato.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   El colaborador debe existir en la base de datos.

### 6. Pasos para la Ejecución

1.  El usuario debe estar autenticado.
2.  El usuario intenta crear un contrato con datos inválidos.

### 7. Datos de Entrada (Escenarios de Prueba)

**Escenario A: Fecha de inicio mayor a fecha de fin** - Fecha de inicio:
01/03/2027 - Fecha de fin: 01/03/2026

**Escenario B: Fecha de inicio en el pasado remoto** - Fecha de inicio:
01/01/2000 - Fecha de fin: 01/01/2001

**Escenario C: Salario negativo** - Salario: -500000

**Escenario D: Salario cero** - Salario: 0

**Escenario E: Salario con formato incorrecto** - Salario: "tres
millones"

**Escenario F: Fecha de fin para contrato indefinido** - Tipo de
contrato: Indefinido - Fecha de fin: null

### 8. Resultado Esperado

-   El sistema rechaza la creación del contrato en todos los escenarios.
-   Muestra mensajes de error específicos.
-   No se guarda información en la base de datos.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**


## Caso 4: Actualizar un Contrato Existente

### 1. ID del Caso de Prueba

**CP-CON-004**

### 2. Título de la Prueba

Verificar que se puede actualizar un contrato existente

### 3. Módulo / Característica

**Contratos / Actualizar_Contrato**

### 4. Descripción

Esta prueba verifica que un usuario autenticado pueda actualizar la
información de un contrato existente.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   Debe existir un contrato en la base de datos.
-   El colaborador asociado al contrato debe existir.

### 6. Pasos para la Ejecución

1.  El usuario debe estar autenticado.
2.  El usuario navega al perfil del colaborador.
3.  El usuario accede a la pestaña de contratos.
4.  El usuario selecciona un contrato existente.
5.  El usuario modifica algunos campos.
6.  El usuario guarda los cambios.

### 7. Datos de Entrada

-   ID del Contrato: (ID existente)
-   Nuevo cargo: Desarrollador Backend Senior
-   Nuevo salario: 4500000
-   Nueva fecha de fin: 01/03/2028 (si aplica)
-   Nuevo estado: Activo

### 8. Resultado Esperado

-   **Base de Datos:** Se actualiza la información en la tabla
    **contracts**.
-   Los campos modificados reflejan los nuevos valores.
-   El contrato sigue asociado al mismo colaborador.
-   El campo **updated_at** se actualiza correctamente.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**


