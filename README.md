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

Todos los comandos se ejecutan en una terminal de Ubuntu (WSL), dentro de la carpeta del repositorio. El repositorio ya incluye el respaldo de la base de datos (`www/blog-sds26-tpi/db_blog_sds26.sql`) y las imágenes de las publicaciones (`entrega/posts`), así que no hace falta descargar nada más.

### Opción A: un solo comando (recomendada)

```bash
git clone https://github.com/Jairo0610/blog-sds26-tpi.git
cd blog-sds26-tpi
bash iniciar.sh
```

El script levanta los contenedores, instala dependencias, compila los estilos, crea la base de datos, carga el respaldo y copia las imágenes. La primera vez tarda unos minutos. Al terminar muestra las direcciones y el usuario para entrar. Se puede ejecutar varias veces sin problema.

### Opción B: paso a paso

**1. Levantar los contenedores**

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

Deben aparecer `servidor_laravel`, `servidor_postgres` y `servidor_pgadmin` en estado *running*.

**2. Configurar la aplicación**

```bash
docker exec -it -u www-data servidor_laravel bash
cd /var/www/html/blog-sds26-tpi

composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
npm install
npm run build

exit
```

**3. Crear la base de datos y cargar los datos**

```bash
docker exec servidor_postgres createdb -U postgres db_blog_sds26
docker exec -i servidor_postgres psql -U postgres -d db_blog_sds26 < www/blog-sds26-tpi/db_blog_sds26.sql
```

Al cargar el respaldo puede aparecer el aviso `unrecognized configuration parameter "transaction_timeout"`. Es inofensivo: los datos se cargan igual. No ejecutes `migrate` ni `--seed`, porque el respaldo ya trae las tablas y los datos.

**4. Copiar las imágenes**

```bash
mkdir -p www/blog-sds26-tpi/storage/app/public
cp -r entrega/posts www/blog-sds26-tpi/storage/app/public/
```

La carpeta debe llamarse `posts`, porque la base de datos guarda rutas como `posts/galeria/archivo.jpg`.

### Abrir el sitio

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
