# Caso de Prueba Gestión de Colaboradores

## Caso 1 : Crear un Colaborador con Datos Válidos

## 1. ID del Caso de Prueba

**CP-COL-001**

## 2. Título de la Prueba

Verificar que se puede crear un colaborador con datos válidos

## 3. Módulo / Característica

Colaboradores/Crear_Colaborador

## 4. Descripción

Esta prueba verifica que un usuario autenticado pueda crear un nuevo colaborador exitosamente.

## 5. Precondiciones

1. El usuario debe estar registrado en la base de datos.
2. El colaborador debe tener la mayoría de edad.
3. El usuario debe estar autenticado.
4. El colaborador no debe estar en la base de datos.

## 6. Pasos para la Ejecución

1. El usuario inicia sesión
2. El usuario debe estar en el apartado de colaboradores.
3. El usuario debe crear un nuevo colaborador exitosamente.

## 7. Datos de Entrada

* Nombre: Jorge
* Apellido: Ballestas
* Tipo de documento: (CC)
* Número: (1082491229)
* Fecha de nacimiento: (20/08/2005)
* Correo: [ballestasjorge66@gmail.com](mailto:ballestasjorge66@gmail.com)
* Teléfono: 3215624027
* Dirección: calle 16 # 9-79

## 8. Resultado Esperado

1. Base de Datos: Se crea un nuevo colaborador en la tabla collaborators.

## 9. Resultado Real

**(Para ser completado durante la ejecución)**

## 10. Estado

* ( Pasa / falla )

---

## Caso 2 : Documento o correo del Colaborador Duplicado

## 1. ID del Caso de Prueba

CP-COL-002

## 2. Título de la Prueba

Verificación de rechazo por documento duplicado o correo duplicado

## 3. Módulo / Característica

Colaboradores/Rechazo_Colaborador

## 4. Descripción

Esta prueba verifica que el sistema no permita crear un colaborador con un número de documento o correo ya registrado.

## 5. Precondiciones

1. El usuario debe estar registrado en la base de datos.
2. El colaborador debe tener la mayoría de edad.
3. El usuario debe estar autenticado.
4. Existe un colaborador registrado con el número de documento ingresado.

## 6. Pasos para la Ejecución

1. El usuario debe estar autenticado.
2. El usuario debe estar en el apartado de colaboradores.
3. El usuario intenta crear un nuevo colaborador con datos duplicados.

## 7. Datos de Entrada

* Nombre: Jorge
* Apellido: Ballestas
* Tipo de documento: (CC)
* Número: (duplicado)
* Fecha de nacimiento: (20/08/2005)
* Correo: (duplicado)
* Teléfono: 3215624027
* Dirección: calle 16 # 9-79

## 8. Resultado Esperado

1. El sistema rechaza el registro.

2. Muestra mensaje: Documento ya registrado.

3. No se guarda información en la base de datos.

## 9. Resultado Real

**(Para ser completado durante la ejecución)**

## 10. Estado

* ( Pasa / falla )

---

## Caso 3 : Actualizar información de un colaborador

## 1. ID del Caso de Prueba

CP-COL-003

## 2. Título de la Prueba

Verificar que se pueda actualizar la información de un colaborador existente

## 3. Módulo / Característica

Colaboradores/Actualizar_Colaborador

## 4. Descripción

Esta prueba verifica que un usuario autenticado pueda actualizar los datos de un colaborador existente.

## 5. Precondiciones

1. El usuario debe estar registrado en la base de datos.
2. El usuario debe estar autenticado.
3. El colaborador debe existir en la base de datos.

## 6. Pasos para la Ejecución

1. El usuario debe estar autenticado.
2. El usuario debe estar en el apartado de colaboradores.
3. El usuario debe actualizar la información del colaborador.

## 7. Datos de Entrada

* Teléfono: 3000000000
* Dirección: calle 20 # 10-50

## 8. Resultado Esperado

1. Base de Datos: Se actualiza la información del colaborador en la tabla collaborators.

## 9. Resultado Real

**(Para ser completado durante la ejecución)**

## 10. Estado

* ( Pasa / falla )

---

## Caso 4 : Obtener listado de colaboradores

## 1. ID del Caso de Prueba

CP-COL-004

## 2. Título de la Prueba

Verificar que se pueda obtener el listado de colaboradores

## 3. Módulo / Característica

Colaboradores/Listar_Colaboradores

## 4. Descripción

Esta prueba verifica que un usuario autenticado pueda obtener el listado de todos los colaboradores registrados.

## 5. Precondiciones

1. El usuario debe estar registrado en la base de datos.
2. El usuario debe estar autenticado.
3. Deben existir colaboradores registrados en la base de datos.

## 6. Pasos para la Ejecución

1. El usuario debe estar autenticado.
2. El usuario debe estar en el apartado de colaboradores.
3. El usuario consulta el listado de colaboradores.

## 7. Datos de Entrada

No aplica.

## 8. Resultado Esperado

1. Base de Datos: El sistema muestra todos los colaboradores registrados.

## 9. Resultado Real

**(Para ser completado durante la ejecución)**

## 10. Estado

* ( Pasa / falla )

---

## Caso 5 : Eliminar o desactivar un colaborador

## 1. ID del Caso de Prueba

CP-COL-005

## 2. Título de la Prueba

Verificar que se pueda eliminar o desactivar un colaborador

## 3. Módulo / Característica

Colaboradores/Eliminar_Colaborador

## 4. Descripción

Esta prueba verifica que un usuario autenticado pueda eliminar o desactivar un colaborador existente.

## 5. Precondiciones

1. El usuario debe estar registrado en la base de datos.
2. El usuario debe estar autenticado.
3. El colaborador debe existir en la base de datos.

## 6. Pasos para la Ejecución

1. El usuario debe estar autenticado.
2. El usuario debe estar en el apartado de colaboradores.
3. El usuario elimina o desactiva el colaborador.

## 7. Datos de Entrada

* ID del colaborador existente.

## 8. Resultado Esperado

1. Base de Datos: El colaborador se elimina o se desactiva en la tabla collaborators.

## 9. Resultado Real

**(Para ser completado durante la ejecución)**

## 10. Estado

* ( Pasa / falla )

---
