
# MusicRoom 🎵

## Descripción del proyecto

MusicRoom es un sitio web dinámico desarrollado como proyecto académico. Su objetivo es ofrecer un espacio para descubrir, explorar, organizar y compartir música.

La plataforma permite a los usuarios interactuar con diferentes secciones relacionadas con el mundo musical, consultar rankings, crear listas personalizadas y guardar sus canciones o álbumes favoritos.

El sitio fue desarrollado utilizando tecnologías de desarrollo web y una arquitectura cliente-servidor, conectada a una base de datos relacional.

## Tecnologías utilizadas

- **HTML5:** estructura del contenido del sitio.
- **CSS3:** diseño visual y estilos de la interfaz.
- **PHP:** desarrollo de la lógica y funcionalidades dinámicas.
- **MySQL:** almacenamiento y gestión de la información.
- **JavaScript:** interacciones del lado del cliente.

## Estructura del sitio

MusicRoom está organizado en diferentes secciones:

- **Inicio:** página principal del sitio.
- **Ranking:** permite explorar rankings musicales.
- **Crear:** sección destinada a la creación de listas o contenido musical.
- **Fav:** espacio para guardar y consultar elementos favoritos.
- **Perfil:** sección destinada a la información del usuario.

## Funcionamiento técnico

El sitio utiliza PHP para procesar la información y establecer la comunicación entre el servidor y la base de datos MySQL.

La información se almacena en tablas relacionales, lo que permite consultar, registrar y administrar los datos utilizados por las diferentes secciones de la plataforma.

### Navegación

El usuario puede desplazarse entre las distintas secciones mediante el menú de navegación principal. Cada sección cuenta con su propio archivo PHP, encargado de mostrar el contenido correspondiente.

### Formularios

Los formularios permiten ingresar información desde la interfaz del sitio. Los datos son enviados al servidor para su procesamiento mediante PHP y, cuando corresponde, se almacenan en la base de datos.

### Base de datos

Se utiliza MySQL para almacenar y organizar la información del proyecto. La conexión con la base de datos permite realizar operaciones de consulta, inserción, modificación y eliminación de registros, según las funcionalidades implementadas.

## Instalación y ejecución local

Para ejecutar MusicRoom en un entorno local, se necesita contar con un servidor compatible con PHP y MySQL, como XAMPP.

1. Descargar o clonar el repositorio de GitHub.
2. Colocar la carpeta del proyecto dentro del directorio `htdocs` de XAMPP.
3. Iniciar los servicios Apache y MySQL.
4. Ingresar a phpMyAdmin.
5. Crear la base de datos e importar el archivo `.sql` incluido en el repositorio.
6. Configurar los datos de conexión a MySQL.
7. Abrir el navegador e ingresar a:

   `http://localhost/sitiomusic/`

## Estructura de archivos

El proyecto se organiza mediante archivos PHP y recursos externos:

- `index.php`: página de inicio.
- `rankings.php`: sección de rankings musicales.
- `crear.php`: sección de creación de contenido.
- `fav.php`: sección de favoritos.
- `perfil.php`: sección de perfil.
- `style.css`: hoja de estilos principal.
- `img/`: carpeta que contiene los recursos gráficos e imágenes.
- `*.sql`: archivo de exportación de la base de datos.

## Objetivo académico

Este proyecto tiene como finalidad aplicar los conocimientos adquiridos durante la cursada sobre desarrollo web dinámico, arquitectura cliente-servidor, programación con PHP y gestión de bases de datos relacionales mediante MySQL.

Además, busca integrar el diseño de interfaces con el desarrollo de funcionalidades que permitan generar una experiencia de navegación interactiva.

## Autor

Proyecto desarrollado individualmente para la carrera de Diseño Digital de Imagen y Sonido de la Universidad de Palermo.
