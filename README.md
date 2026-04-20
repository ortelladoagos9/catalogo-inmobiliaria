# Sistema de Gestión de Propiedades Inmobiliarias

## Descripción general del sistema

Este proyecto consiste en una aplicación web desarrollada para la gestión integral de propiedades inmobiliarias.  
Permite administrar propiedades, direcciones, responsables y auditorías del sistema, asegurando trazabilidad completa de las acciones realizadas por los usuarios.

El sistema fue desarrollado utilizando **Laravel 11**, con un enfoque en buenas prácticas, arquitectura limpia y experiencia de usuario moderna.  
Además, cuenta con un diseño **100% responsive**, adaptable a distintos dispositivos.

---

## Funcionalidades implementadas

- ✔️ Autenticación de usuarios (login, registro, logout)
- ✔️ Gestión completa de propiedades (CRUD)
- ✔️ Carga y eliminación de imágenes por propiedad
- ✔️ Gestión de direcciones (calle, número, localidad, provincia)
- ✔️ Relación con responsables de propiedad
- ✔️ Manejo de estados (activo/inactivo)
- ✔️ Eliminación lógica (soft delete)
- ✔️ Sistema de auditoría completo:
    - Registro de creación, edición y eliminación
    - Visualización de valores anteriores y nuevos
    - Identificación de usuario, fecha y acción
- ✔️ Envío de notificaciones por correo (asincrónico con colas)

- ✔️ Validaciones tanto en frontend como backend
- ✔️ Filtros para búsquedas rápidas y paginación
- ✔️ Interfaz moderna con Tailwind CSS
- ✔️ Diseño responsive (mobile + desktop)

---

## Perfiles de usuario y permisos

### Administrador
- Acceso completo al sistema
- Crear, editar y eliminar propiedades
- Ver auditorías del sistema
- Gestionar todos los registros

### Operario
- Crear y editar propiedades (excepto editar precio)
- No puede eliminar registros definitivamente
- No tiene acceso al módulo de auditorías

---

## Instrucciones para correr el proyecto localmente

### Requisitos

- PHP 8.2
- Composer 2.8.5
- Node.js v22.17.0
- SQL Server Management Studio 20
- Laravel 11

---

### Configuración inicial

### 1. Clonar el repositorio:

```bash
git clone <url-del-repositorio>
cd <nombre-del-proyecto>
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node

```bash
npm install
```

### 4. Configurar variables de entorno

```bash
cp .env.example .env
```

### IMPORTANTE

* Configurar correctamente la conexión a la base de datos en el archivo `.env`
* Configurar las credenciales de correo (Gmail) para el envío de notificaciones

---

## Base de datos

Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

### Nota

* El seeder incluye usuarios de prueba
* Es necesario reemplazar los correos por cuentas reales para poder recibir notificaciones

---

## Ejecución del proyecto

Se deben levantar **3 procesos en simultáneo**:

### 1. Servidor de Laravel

```bash
php artisan serve
```

### 2. Worker de colas (envío de mails)

```bash
php artisan queue:work
```

### 3. Compilación de assets

```bash
npm run dev
```

---

## Notificaciones

El sistema envía correos electrónicos utilizando **colas (queues)**, lo que permite mejorar el rendimiento evitando bloquear la ejecución principal del sistema.

## Verificación de email

El sistema cuenta con verificación de correo electrónico al momento de registrar nuevos usuarios.

### Funcionamiento

* Al registrarse, el usuario recibe un correo con un enlace de verificación.
* Hasta que no verifique su email, no podrá acceder a las rutas protegidas.
* Se utiliza el middleware `verified` de Laravel para restringir el acceso.

---

### Configuración

Es necesario configurar correctamente el envío de correos en el archivo `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@gmail.com
MAIL_PASSWORD=tu_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_correo@gmail.com
MAIL_FROM_NAME="Inmobiliaria"
```

---

### Importante (Gmail)

Para que funcione correctamente:

* No se debe usar la contraseña normal del correo
* Es necesario generar una **App Password** desde la cuenta de Google:
  https://myaccount.google.com/apppasswords
* Requiere tener activada la verificación en dos pasos

## Tecnologías utilizadas

* Laravel 11
* PHP 8.2
* SQL Server
* Tailwind CSS
* Laravel Breeze (autenticación)
* OwenIt Laravel Auditing (auditoría)
* Sistema de colas (Queue)
