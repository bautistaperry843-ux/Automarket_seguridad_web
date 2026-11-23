# Trabajo Práctico — Seguridad Web: Formularios POST y GET

## Descripción del proyecto

**AutoMarket** es una aplicación web desarrollada en PHP que permite consultar vehículos, registrarse, iniciar sesión, enviar consultas y utilizar filtros de búsqueda. Este trabajo corresponde a la **Clase 5** y agrega el procesamiento dinámico de formularios desde el servidor, aplicando validación y sanitización para reducir riesgos de Cross-Site Scripting (XSS).

## Contexto académico

- Asignatura: Programación Web
- Unidad temática: Procesamiento de formularios y seguridad en PHP
- Modalidad: Individual
- Entrega: Repositorio público en GitHub

## Formularios implementados

### Formulario por POST

Se encuentra en `clase5/index.php` y procesa una consulta enviada desde el navegador. Utiliza `$_SERVER['REQUEST_METHOD'] === 'POST'` y recoge los campos:

- Nombre completo.
- Correo electrónico.
- Mensaje o consulta.

El formulario valida que todos los campos estén completos y que el correo tenga un formato válido. Cuando existen errores, conserva los valores escritos por el usuario y muestra un mensaje claro sin permitir que se interprete HTML enviado desde el navegador.

### Formulario por GET

También se encuentra en `clase5/index.php`. Permite realizar una búsqueda rápida mediante el parámetro `q` en la URL.

El valor recibido se procesa con `filter_input()`, se limpia con `trim()`, se limita su longitud y se transforma con `htmlspecialchars()` antes de mostrarse o usarse en la interfaz. El término buscado permanece visible en el campo para conservar la consulta realizada.

## Sanitización y validación

Para el tratamiento de datos se aplicaron las siguientes medidas:

- Lectura controlada con `filter_input()`.
- Eliminación de espacios con `trim()`.
- Validación de correo con `FILTER_VALIDATE_EMAIL`.
- Conversión segura de caracteres especiales con `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`.
- Comprobación de campos vacíos y errores requeridos.
- Límites de longitud en los campos para evitar valores excesivos.
- Persistencia visual de los campos en caso de validación fallida.

Ningún dato recibido desde `$_POST` o `$_GET` se muestra directamente sin pasar por una salida segura.

## Retroalimentación al usuario

La interfaz muestra dos tipos de mensajes:

- Éxito: confirma que el formulario POST fue procesado y que los datos tienen formato válido.
- Error: informa qué campos están vacíos o tienen un formato incorrecto.

Además, el campo de búsqueda conserva su valor tras enviar el formulario GET.

## Tecnologías utilizadas

- PHP 8.x
- HTML5
- CSS3
- JavaScript
- Apache / XAMPP
- Git y GitHub

## Ejecución local

1. Instalá y iniciá Apache desde XAMPP.
2. Copiá el proyecto dentro de `C:\xampp\htdocs\`.
3. Accedé a la demostración de formularios:

```text
http://localhost/Artaza/clase5/index.php
```

4. Probá primero el formulario POST dejando campos vacíos o ingresando un correo inválido.
5. Probá luego el formulario GET escribiendo una búsqueda, incluyendo texto y caracteres especiales para verificar la salida segura.

## Evidencias

Agregar en este apartado las capturas tomadas del sistema en ejecución.

### Procesamiento correcto por POST

![Procesamiento exitoso del formulario POST](docs/screenshots/clase5-post-exitoso.png)

### Validación de campos POST

![Mensajes de error de validación](docs/screenshots/clase5-post-validacion.png)

### Procesamiento seguro por GET

![Búsqueda procesada por método GET](docs/screenshots/clase5-get.png)

### Prueba de sanitización XSS

![Datos ingresados mostrados sin ejecutar HTML o JavaScript](docs/screenshots/clase5-xss.png)

## Seguridad aplicada

La implementación utiliza técnicas básicas recomendadas para prevenir XSS y mejorar el control de los datos enviados por el usuario:

- Escapado de datos antes de representar contenido HTML.
- Validación de correo electrónico en el servidor.
- Verificación de campos obligatorios.
- Separación entre datos recibidos y datos mostrados en la interfaz.
- Uso de entradas controladas y límites de longitud.

## Estructura de la entrega

```text
clase5/
└── index.php

docs/screenshots/
├── clase5-post-exitoso.png
├── clase5-post-validacion.png
├── clase5-get.png
└── clase5-xss.png
```

## Riesgos considerados

- Inyección de HTML o JavaScript desde campos de formulario.
- Ingreso de correos con formato inválido.
- Campos POST vacíos o incompletos.
- Parámetros GET manipulados desde la barra de direcciones.
- Pérdida de datos completados cuando falla una validación.

## Estado de la entrega

El proyecto cuenta con una demostración funcional por POST y por GET dentro de la carpeta `clase5/`, junto con validación de servidor, mensajes de retroalimentación y persistencia de los datos ingresados.