# Test

API REST para administrar un arbol de localizaciones.

## Inicio

Este proyecto fue desarrollado en Laravel 5.4 y MySql.

### Prerequisitos de Laravel 5.4


- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension


### Installing

Clonar el repositorio

- $ git clone https://github.com/juaninho10/test.git

Instalar Composer

- $ composer install

Crear y configurar una Base de Datos

- Crear un archivo .env (copiar y renombrar .env.example) y configurar los credenciales de la base de datos.

Ejecutar las Migraciones y arrancar el servidor http://localhost:8000/

- $ php artisan migrate
- $ php artisan db:seed (Crea un usuario en la BDD para la autenticacion y pruebas)
```
email: usuario@localhost.com
password: 123456

```
- $ php artisan serve


## API

El proyecto consta de 6 rutas de las cuales 2 necesitan autenticación (Crear y Borrar localizaciones).

## 1. Autenticación.

Para poder autenticarse el usuario debe estar creado en la base de datos.

#### http://localhost:8000/api/login

Parametro obligatorios

```
email
password
```
El email y el password envíados a esta ruta generan un token para un usuario previamente cargado en la base de datos.

Una vez generado el token se envía en los Headers con la petición, como por ejemplo:

Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvbG9naW4iLCJpYXQiOjE1MjI0NDYxMjMsImV4cCI6MTUyMjQ0OTcyMywibmJmIjoxNTIyNDQ2MTIzLCJqdGkiOiJ2dUEweVlidll2bnJKRTkzIn0.3sAIqpL7hXXoSTAvW7pm5nnmtaUo85UQX55M90lplMU


## 2. Agregar una localización.

Requiere autenticación

#### http://localhost:8000/api/add

Parametros obligatorios

```
parent_id: (Un número entero)
name: (texto)
slug: (texto)

```
PARENT_ID: Es el identificador de un nodo padre, cuando se va a agregar un PAIS debe ser 0, para el resto de entidades debe ser el id del nodo padre.

NAME: Se refiere al nombre de la entidad territotial. (PAIS, ESTADO, PROVINCIA, CIUDAD).

SLUG: Es el nombre propio de la entidad. (ARGENTINA,VENEZUELA,BUENOS AIRES, WASHINGTON)

| id  | parent_id  | name  | slug  |
| ------------ | ------------ | ------------ | ------------ |
| 1  | 0  | PAIS  | ARGENTINA  |
| 2 | 1  | PROVINCIA  | BUENOS AIRES  |
| 3  | 2  | CIUDAD  | ARRECIFES  |
| 4  | 0  | PAIS  | ESTADOS UNIDOS  |
| 5  | 4  | ESTADO  | CALIFORNIA  |
| 6  | 5  | CONDADO  | LOS ANGELES  |
|  7 | 6  | CIUDAD  | PASADENA  |

Así se vería este arbol de ejemplo

![Alt text](/public/img/locationsTree.png)

## 3. Mostrar todas las localizaciónes.

No Requiere autenticación

#### http://localhost:8000/api/locations

Retorna un arbol con todas las localizaciones.

## 4. Buscar localizaciónes por nombre.

No Requiere autenticación

#### http://localhost:8000/api/search/{slug}

Parametro obligatorios

```
slug: (texto)

```
Retorna las localizaciones con nombres coincidentes con la cadena de texto "Slug".

## 5. Obtener hijos de una localización.

No Requiere autenticación

#### http://localhost:8000/api/childs/{id}

Parametro obligatorios

```
Id: (Númerico)
```
Retorna los hijos de una localización existente con un Id conocido.

## 6. Borrar una localización.

Requiere autenticación

#### http://localhost:8000/api/delete/{id}

Parametro obligatorios

```
Id: (Númerico)

```
Elimina la localización y los hijos de una localización existente con un Id conocido.


## Authors

* **Juan Meaño** - 
