# Blog de excursiones

## Descripción
Proyecto realizado para la asignatura SIBW, en la Universidad de Granada. Se trata de un blog en el que los usuarios pueden ver eventos y comentarlos.
Los usuarios tienen restringido el acceso a la funcionalidad según su rol, así he creado las interfaces necesarias para poder administrar la aplicación. Las rutas están protegidas utilizando un control de sesiones en el servidor web. Además, la web es responsive y se utilizan URL limpias.

### Tipos de usuarios
* Registrado: el usuario puede ver los eventos y puede comentar en ellos.
* Moderador: además, puede editar y borrar comentarios.
* Gestor: además, puede gestionar los eventos.
* Super: podrá realizar cualquier acción y editar los roles de los usuarios así como eliminarlos.

## Instalación

### Prerrequisitos
Necesita tener instalado Docker en su ordenador.

### Cambiar los archivos de configuración
El archivo .env contiene los puertos que utilizan los servicios de la aplicación. Asegúrese de que no están en uso. Además, recuerde cambiar las contraseñas y usuario de la BD. El archivo .connection.env que se encuentra en www/php/model contiene la cadena de conexión que se empleará para registrar la información en la BD. Asegúrese de que existe y tiene permisos para editar las tablas (CRUD).

### Crear las imágenes

```
docker-compose up
```

## Iniciar la aplicación
Visite la página localhost:<HOST_MACHINE_UNSECURE_HOST_PORT> en su navegador.

## Tecnologías empleadas
- HTML
- CSS
- Javascript
- PHP
- Twig
- Mysql
- Docker

## Demo

### Administrador - PC 
![Demo admin](demo/Admin.gif)

### Usuario registrado - Móvil
![Demo móvil](demo/Movil.gif)


