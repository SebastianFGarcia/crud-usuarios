# Laravel 10 CRUD de Usuarios con Vue Frontend
Este es un ejemplo de una aplicación CRUD de Usuarios en Laravel 10 con un frontend en Vue. La aplicación también incluye una tabla de Categorías y utiliza la API de restcountries.com para mostrar países de Sudamérica en el campo de país de los usuarios.

## Instalación
Para instalar la aplicación, clona el repositorio desde GitHub y luego sigue los siguientes pasos:

- Abre la carpeta pruebaGml-api
```bash
  cd pruebaGml-api
```
- Ejecuta composer install para instalar las dependencias de Laravel
```bash
  composer install
```
- Copia el archivo .env.example a .env y configura tus variables de entorno, como la conexión a la base de datos y la configuración del correo electrónico.
- Ejecuta php artisan key:generate para generar una nueva clave de aplicación
```bash
  php artisan key:generate
```
- Ejecuta php artisan migrate para crear las tablas de la base de datos y realizar los seeders
```bash
  php artisan migrate
  php artisan migrate --seed
```
- Abre la carpeta pruebaGml-vue
```bash
  cd pruebaGml-vue
```
- Ejecuta npm install para instalar las dependencias de Vue.js
```bash
  npm install
```
- Ejecuta npm run dev para compilar los archivos de Vue.js y empezar el servidor de desarrollo
```bash
  npm run dev
```

## Uso
La aplicación tiene una interfaz de usuario fácil de usar para realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar) de Usuarios.

## Usuarios
Cuando se crea un nuevo usuario, la aplicación utiliza la API de restcountries.com para mostrar una lista de países de Sudamérica en el campo de país. Cuando se crea un usuario, se le notifica al usuario por correo electrónico que ha sido registrado.

Si un usuario tiene el campo is_admin establecido en true, la aplicación enviará un informe de usuarios por país por correo electrónico.

## Categorías
La sección de Categorías permite realizar operaciones CRUD en la tabla de categorías en los endpoints del api.
