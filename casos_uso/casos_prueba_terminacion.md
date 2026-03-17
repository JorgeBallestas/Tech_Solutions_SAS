# Casos de Prueba -- Terminación de Contratos

## Caso 1: Cambiar Estado de Contrato a Terminado

### 1. ID del Caso de Prueba

**CP-TER-001**

### 2. Título de la Prueba

Verificar que se puede cambiar el estado de un contrato a Terminado

### 3. Módulo / Característica

**Contratos / Terminación / Cambiar_Estado**

### 4. Descripción

Esta prueba verifica que un usuario autenticado pueda cambiar el estado de un contrato activo a estado Terminado.

### 5. Precondiciones

- El usuario debe estar registrado en la base de datos.
- El usuario debe estar autenticado.
- Debe existir un contrato activo.
- El contrato no debe estar finalizado previamente.

### 6. Pasos para la Ejecución

1. El usuario inicia sesión.
2. El usuario accede al módulo de contratos.
3. El usuario selecciona un contrato activo.
4. El usuario hace clic en **Terminar contrato**.
5. El usuario ingresa la información requerida.
6. El usuario confirma la operación.
7. El usuario guarda los cambios.

### 7. Datos de Entrada

- ID del contrato: (ID existente)
- Estado actual: Activo
- Nuevo estado: Terminado

### 8. Resultado Esperado

- El estado del contrato cambia a **Terminado**.
- Se actualiza el campo **status** en la base de datos.
- El campo **updated_at** se actualiza correctamente.
- El contrato no permite nuevas prórrogas ni modificaciones.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**


## Caso 2: Registro de Fecha y Motivo de Terminación

### 1. ID del Caso de Prueba

**CP-TER-002**

### 2. Título de la Prueba

Verificar que se registra correctamente la fecha y el motivo de la terminación

### 3. Módulo / Característica

**Contratos / Terminación / Registrar_Datos**

### 4. Descripción

Esta prueba verifica que al terminar un contrato el sistema registre correctamente la fecha de terminación y el motivo asociado.

### 5. Precondiciones

- El usuario debe estar registrado en la base de datos.
- El usuario debe estar autenticado.
- Debe existir un contrato activo.

### 6. Pasos para la Ejecución

1. El usuario inicia sesión.
2. El usuario selecciona un contrato activo.
3. El usuario hace clic en **Terminar contrato**.
4. El usuario ingresa el motivo de terminación.
5. El usuario confirma la operación.
6. El usuario guarda los cambios.

### 7. Datos de Entrada

- ID del contrato: (ID existente)
- Fecha de terminación: (fecha actual del sistema)
- Motivo: Finalización del proyecto
- Observación: Cumplimiento del objeto contractual

### 8. Resultado Esperado

- Se guarda la fecha de terminación en el contrato.
- Se guarda el motivo de terminación.
- Se registra la información correctamente en la base de datos.
- El contrato cambia a estado **Terminado**.
- Se mantiene trazabilidad del evento.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**


## Caso 3: Rechazo de Terminación de Contrato ya Finalizado

### 1. ID del Caso de Prueba

**CP-TER-003**

### 2. Título de la Prueba

Verificar que no se puede terminar un contrato que ya ha finalizado

### 3. Módulo / Característica

**Contratos / Terminación / Validaciones**

### 4. Descripción

Esta prueba verifica que el sistema no permita terminar un contrato que ya se encuentre en estado Terminado o Finalizado.

### 5. Precondiciones

- El usuario debe estar registrado en la base de datos.
- El usuario debe estar autenticado.
- Debe existir un contrato con estado Terminado o Finalizado.

### 6. Pasos para la Ejecución

1. El usuario inicia sesión.
2. El usuario selecciona un contrato finalizado.
3. El usuario intenta ejecutar la opción **Terminar contrato**.
4. El usuario confirma la operación.

### 7. Datos de Entrada

- ID del contrato: (ID existente)
- Estado actual: Finalizado
- Intento de nuevo estado: Terminado

### 8. Resultado Esperado

- El sistema rechaza la operación.
- Se muestra mensaje:

**"El contrato ya se encuentra finalizado"**

- No se realizan cambios en la base de datos.
- No se crean registros duplicados de terminación.

### 9. Resultado Real

*(Para ser completado durante la ejecución)*

### 10. Estado

**( Pasa / Falla )**