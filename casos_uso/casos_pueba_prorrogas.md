# Casos de Prueba -- Gestión de Prórrogas de Contratos

## Caso 1: Añadir Prórroga a un Contrato Válido

### 1. ID del Caso de Prueba

**CP-PRO-001**

### 2. Título de la Prueba

Verificar que se puede añadir una prórroga (en tiempo o valor) a un
contrato de tipo Fijo o Prestación de Servicios

### 3. Módulo / Característica

**Contratos / Prórrogas / Crear_Prórroga**

### 4. Descripción

Esta prueba verifica que un usuario autenticado pueda registrar una
prórroga en tiempo o en valor para un contrato activo de tipo Fijo o
Prestación de Servicios.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   Debe existir un contrato en la base de datos.
-   El contrato debe ser tipo Fijo o Prestación de Servicios.
-   El contrato debe estar en estado Activo.

### 6. Pasos para la Ejecución

1.  El usuario inicia sesión.
2.  El usuario navega al módulo de contratos.
3.  El usuario selecciona un contrato activo.
4.  El usuario accede a la opción de prórrogas.
5.  El usuario hace clic en **Nueva Prórroga**.
6.  El usuario completa el formulario con datos válidos.
7.  El usuario guarda la prórroga.

### 7. Datos de Entrada

**Escenario A: Prórroga de tiempo**

-   ID del contrato: (ID existente)
-   Tipo de prórroga: Tiempo
-   Nueva fecha de finalización: 01/09/2027
-   Motivo: Extensión del proyecto

**Escenario B: Prórroga de valor**

-   ID del contrato: (ID existente)
-   Tipo de prórroga: Valor
-   Incremento de valor: 500000
-   Motivo: Ajuste presupuestal

### 8. Resultado Esperado

-   Se crea un nuevo registro de prórroga en la base de datos.
-   La prórroga queda asociada correctamente al contrato mediante
    **contract_id**.
-   Los datos ingresados se guardan correctamente.
-   El contrato permanece en estado Activo.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**

## Caso 2: Actualización de Fecha por Prórroga de Tiempo

### 1. ID del Caso de Prueba

**CP-PRO-002**

### 2. Título de la Prueba

Verificar que la fecha de finalización del contrato se actualiza
correctamente al añadir una prórroga de tiempo

### 3. Módulo / Característica

**Contratos / Prórrogas / Actualizar_Fechas**

### 4. Descripción

Esta prueba verifica que al registrar una prórroga de tiempo, el sistema
actualice correctamente la fecha de finalización del contrato.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   Debe existir un contrato activo.
-   El contrato debe permitir prórrogas.

### 6. Pasos para la Ejecución

1.  El usuario inicia sesión.
2.  El usuario selecciona un contrato activo.
3.  El usuario registra una prórroga de tiempo.
4.  El usuario guarda los cambios.
5.  El usuario consulta nuevamente la información del contrato.

### 7. Datos de Entrada

-   ID del contrato: (ID existente)
-   Fecha fin actual: 01/03/2027
-   Nueva fecha fin: 01/09/2027
-   Motivo: Continuidad del servicio

### 8. Resultado Esperado

-   La fecha de finalización del contrato se actualiza correctamente.
-   El campo **end_date** refleja la nueva fecha.
-   El campo **updated_at** se actualiza automáticamente.
-   Se registra el historial de la prórroga.
-   No se pierden los datos anteriores del contrato.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**

## Caso 3: Rechazo de Prórroga en Contrato Finalizado

### 1. ID del Caso de Prueba

**CP-PRO-003**

### 2. Título de la Prueba

Verificar que el sistema rechaza una prórroga para un contrato con
estado Terminado o Finalizado

### 3. Módulo / Característica

**Contratos / Prórrogas / Validaciones**

### 4. Descripción

Esta prueba verifica que el sistema no permita registrar prórrogas en
contratos que ya se encuentren en estado Terminado o Finalizado.

### 5. Precondiciones

-   El usuario debe estar registrado en la base de datos.
-   El usuario debe estar autenticado.
-   Debe existir un contrato con estado Terminado o Finalizado.

### 6. Pasos para la Ejecución

1.  El usuario inicia sesión.
2.  El usuario selecciona un contrato finalizado.
3.  El usuario intenta registrar una prórroga.
4.  El usuario guarda la operación.

### 7. Datos de Entrada

-   ID del contrato: (ID existente)
-   Estado del contrato: Finalizado
-   Tipo de prórroga: Tiempo
-   Nueva fecha propuesta: 01/12/2027
-   Motivo: Extensión tardía

### 8. Resultado Esperado

-   El sistema rechaza la creación de la prórroga.
-   Se muestra un mensaje indicando: **"No se pueden registrar prórrogas
    en contratos finalizados"**
-   No se guarda información en la base de datos.
-   No se modifica la información del contrato.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**
