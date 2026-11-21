# Blog Semana de Sistemas 2026 · SDS26 Green IoT

Blog para documentar las actividades de la Semana de Sistemas 2026 de la carrera de Ingeniería de Sistemas Informáticos (Universidad de El Salvador, FMO).

**Integrantes**

| Nombre | Carné |
|---|---|
| Jairo Alexander Argueta Alvarenga | AA23027 |
| Yanira Verenice Martínez Aguilar | MA22013 |

## Tecnologías

- Laravel 12 (PHP 8.4), Blade y Eloquent
- PostgreSQL 17
- Tailwind CSS 4 con Vite
- Docker y Docker Compose (Apache, PHP, Node 24, PostgreSQL y pgAdmin)

## Credenciales

| Acceso | Usuario | Contraseña |
|---|---|---|
| **Panel de administración (admin)** | `admin@ues.edu.sv` | `12345` |
| Integrante 1 | `aa23027@ues.edu.sv` | `12345` |
| Integrante 2 | `ma22013@ues.edu.sv` | `12345` |
| pgAdmin | `admin@example.com` | `admin123` |
| PostgreSQL | `postgres` | `root123` |

Son contraseñas de demostración, solo para ejecutar el proyecto en un entorno local.

## Direcciones

| Qué | URL |
|---|---|
| Blog público | http://blog-sds26-tpi.localhost:8083 |
| Inicio de sesión / panel | http://blog-sds26-tpi.localhost:8083/login |
| Índice de proyectos del servidor | http://localhost:8083 |
| pgAdmin | http://localhost:8087 |

## Requisitos

- Docker y Docker Compose (en Windows, con WSL 2 y Ubuntu)
- Git
- Puertos libres: `8083`, `5173`, `5433` y `8087`

## Instalación

Todos los comandos se ejecutan en una terminal de Ubuntu (WSL), salvo los marcados como **dentro del contenedor**.

### 1. Clonar y levantar los contenedores

```bash
git clone https://github.com/Jairo0610/blog-sds26-tpi.git
cd blog-sds26-tpi
id -u; id -g
```

El archivo `.env` de la raíz trae `HOST_UID=1000` y `HOST_GID=1000`. Si los números que mostró `id` son otros, edítalo antes de continuar. Luego:

```bash
docker compose up -d --build
docker compose ps
```

Deben aparecer `servidor_laravel`, `servidor_postgres` y `servidor_pgadmin` en estado *running*. La primera construcción tarda unos minutos.

### 2. Configurar la aplicación (dentro del contenedor)

```bash
docker exec -it -u www-data servidor bash
cd /var/www/html/blog-sds26-tpi

composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
npm install
npm run build

exit
```

El `.env.example` ya viene configurado para PostgreSQL (`DB_HOST=db`, base de datos `db_blog_sds26`).

### 3. Crear la base de datos y cargar los datos

Primero crea la base de datos vacía:

```bash
docker exec servidor_postgres createdb -U postgres db_blog_sds26
```


Descomprime el `.zip` de la entrega. Debe contener el archivo `db_blog_sds26.sql` y la carpeta `posts/`. Desde la carpeta donde descomprimiste, ejecuta:

```bash
docker exec -i servidor_postgres psql -U postgres -d db_blog_sds26 < db_blog_sds26.sql

mkdir -p /ruta/al/repo/www/blog-sds26-tpi/storage/app/public
cp -r posts /ruta/al/repo/www/blog-sds26-tpi/storage/app/public/
```

Reemplaza `/ruta/al/repo` por la ruta donde clonaste el proyecto. La carpeta debe llamarse `posts`, porque la base de datos guarda rutas como `posts/galeria/archivo.jpg`. No ejecutes `migrate` ni `--seed`: el respaldo ya incluye las tablas y los datos.


### 4. Abrir el sitio

Entra a http://blog-sds26-tpi.localhost:8083. Para administrar, ve a `/login` con las credenciales de la tabla de arriba.

## Funcionalidades

**Sitio público**
- Inicio con presentación del evento, ponencias y programa por día.
- Listado de publicaciones con filtro por categoría y paginación.
- Detalle de la publicación con texto, autores, galería de imágenes y visor ampliado. Cada imagen indica de qué integrante es la evidencia.
- Los borradores no son visibles al público.

**Panel de administración** (requiere inicio de sesión)
- Crear, editar y eliminar publicaciones con autores, categoría, imagen principal y estado (borrador o publicada).
- Agregar evidencias al crear una publicación y administrar la galería al editarla.
- CRUD de categorías.
- Indicador de evidencias por integrante en cada publicación.
