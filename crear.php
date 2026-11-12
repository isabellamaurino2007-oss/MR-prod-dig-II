<?php 
include 'conexion.php'; 

$mensaje_exito = "";
$mensaje_error = "";

// Procesar el formulario de creación de playlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_playlist'])) {
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $albumes_seleccionados = trim($_POST['selectedAlbums'] ?? '');

    if (!empty($nombre)) {
        $descripcion_completa = $descripcion . (!empty($albumes_seleccionados) ? " | Canciones/Álbumes: " . $albumes_seleccionados : "");

        $stmt = $conexion->prepare("INSERT INTO playlists (nombre, descripcion) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $nombre, $descripcion_completa);
            $stmt->execute();
            $stmt->close();
            $mensaje_exito = "¡Playlist creada y guardada con éxito!";
        } else {
            $mensaje_error = "Error al guardar en la base de datos.";
        }
    } else {
        $mensaje_error = "Por favor, ingresa un nombre para la playlist.";
    }
}
?>
<!DOCTYPE html> 
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MusicRoom - Crear Playlist</title>
<link rel="stylesheet" href="style.css">
<style>
    /* Estética general y acomodación de medidas para el header fijo */
    body {
        margin: 0;
        padding-top: 320px !important;
        background-color: #1a0406;
        color: #fff;
        font-family: 'Montserrat', sans-serif;
    }

    .main-content {
        position: relative;
        z-index: 10;
        padding: 30px 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .builder-container {
        background: rgba(0,0,0,0.4);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.08);
        margin-bottom: 40px;
    }

    .builder-container input[type="text"],
    .builder-container textarea {
        width: 100%;
        padding: 12px 15px;
        background-color: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: #ffffff;
        font-size: 1rem;
        margin-bottom: 15px;
        box-sizing: border-box;
        font-family: inherit;
        outline: none;
    }

    .builder-container input[type="text"]:focus,
    .builder-container textarea:focus {
        border-color: #ffd700;
    }

    /* Autocompletado y selección múltiple perfectamente medidos */
    .autocomplete-wrapper {
        position: relative;
        margin-bottom: 15px;
    }

    .autocomplete-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #2b080c;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0 0 8px 8px;
        max-height: 150px;
        overflow-y: auto;
        z-index: 999;
        display: none;
    }

    .autocomplete-item {
        padding: 10px 15px;
        cursor: pointer;
        color: #e0e0e0;
        font-size: 0.95rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .autocomplete-item:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #ffd700;
    }

    .selected-chips-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        background-color: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 15px;
        min-height: 45px;
        box-sizing: border-box;
    }

    .chip {
        background-color: rgba(255, 215, 0, 0.15);
        color: #ffd700;
        border: 1px solid rgba(255, 215, 0, 0.3);
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chip-remove {
        cursor: pointer;
        color: #d1a1a7;
        font-weight: bold;
    }

    .chip-remove:hover {
        color: #ffffff;
    }

    .btn-primary {
        background-color: #ffd700;
        color: #1a0406;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-primary:hover {
        background-color: #e6c200;
    }
</style>
</head>

<body>
<header class="header-banner-container" style="position: absolute; top: 0; left: 0; width: 100%;">
<img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">
<div class="header-overlay-centro">
<h1 class="titulo-principal">MusicRoom</h1>
<div class="search-box-container">
<input type="text" id="buscadorPrincipal" placeholder="Busca para agregar a tu playlist...">
</div>
</div>
<nav class="nav-bar">
<a href="index.php">INICIO</a>
<a href="rankings.php">RANKING</a>
<a href="crear.php" class="active">CREAR</a>
<a href="fav.php">FAV</a>
<a href="perfil.php">PERFIL</a>
<a href="registro.php">REGISTRO</a>
</nav>
</header>

<main class="main-content">

    <?php if (!empty($mensaje_exito)): ?>
        <div style="background: rgba(30, 51, 34, 0.9); color: #4caf50; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #2e5235;">
            <?php echo $mensaje_exito; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($mensaje_error)): ?>
        <div style="background: rgba(51, 30, 30, 0.9); color: #f44336; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #522e2e;">
            <?php echo $mensaje_error; ?>
        </div>
    <?php endif; ?>

    <section class="builder-container">
        <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin-top: 0; margin-bottom: 20px; font-weight: 700;">Crear Nueva Playlist</h2>
        
        <form action="" method="POST">
            <!-- Nombre de la Playlist -->
            <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">Nombre de la Playlist:</label>
            <input type="text" name="nombre" placeholder="Ej. Mis favoritos de R&B" required>

            <!-- Buscador Interactivo con Autocompletado -->
            <label style="display: block; color: #d1a1a7; font-size: 0.9rem; margin-bottom: 5px;">Buscar y agregar canciones o álbumes:</label>
            <div class="autocomplete-wrapper">
                <input type="text" id="albumSearchInput" placeholder="Empieza a escribir el artista o álbum..." autocomplete="off">
                <div id="autocompleteList" class="autocomplete-list"></div>
            </div>

            <!-- Contenedor visual de selecciones múltiples -->
            <label style="display: block; color: #d1a1a7; font-size: 0.9rem; margin-bottom: 5px;">Canciones / Álbumes seleccionados:</label>
            <div id="selectedChipsContainer" class="selected-chips-container">
                <span id="placeholderText" style="color: rgba(255,255,255,0.4); font-size: 0.9rem; align-self: center;">Ningún elemento seleccionado aún...</span>
            </div>

            <!-- Input oculto para enviar los datos al servidor -->
            <input type="hidden" id="selectedAlbumsInput" name="selectedAlbums">

            <!-- Descripción -->
            <label style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">Descripción:</label>
            <textarea name="descripcion" rows="4" placeholder="Describe tu playlist..."></textarea>
            
            <div style="display: flex; gap: 15px; align-items: center; margin-top: 15px;">
                <button type="submit" name="guardar_playlist" class="btn-primary">Guardar Playlist</button>
            </div>
        </form>
    </section>

</main>

<!-- Lógica de Autocompletado y Selección Múltiple -->
<script>
    const catalogoAlbumes = [
        "The Weeknd - Starboy",
        "The Weeknd - After Hours",
        "Brent Faiyaz - Wasteland",
        "Brent Faiyaz - Sonder Son",
        "Ángela Torres - La Niña de Fuego",
        "Harry Styles - Harry's House",
        "Harry Styles - Fine Line",
        "Sade - Love Deluxe",
        "Sade - Diamond Life",
        "Drake - Certified Lover Boy",
        "Billie Eilish - HIT ME HARD AND SOFT",
        "Taylor Swift - Midnights",
        "Charly García - Clics Modernos",
        "Fito Páez - El Amor Después del Amor",
        "Amy Winehouse - Back to Black"
    ];

    let albumesElegidos = [];

    const searchInput = document.getElementById('albumSearchInput');
    const autocompleteList = document.getElementById('autocompleteList');
    const selectedAlbumsInput = document.getElementById('selectedAlbumsInput');
    const selectedChipsContainer = document.getElementById('selectedChipsContainer');
    const placeholderText = document.getElementById('placeholderText');

    function actualizarChips() {
        selectedChipsContainer.innerHTML = '';
        
        if (albumesElegidos.length === 0) {
            selectedChipsContainer.appendChild(placeholderText);
            selectedAlbumsInput.value = '';
            return;
        }

        albumesElegidos.forEach((album, index) => {
            const chip = document.createElement('div');
            chip.classList.add('chip');
            chip.innerHTML = `<span>${album}</span> <span class="chip-remove" onclick="removerAlbum(${index})">&times;</span>`;
            selectedChipsContainer.appendChild(chip);
        });

        selectedAlbumsInput.value = albumesElegidos.join(', ');
    }

    window.removerAlbum = function(index) {
        albumesElegidos.splice(index, 1);
        actualizarChips();
    }

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        autocompleteList.innerHTML = '';

        if (query.length === 0) {
            autocompleteList.style.display = 'none';
            return;
        }

        const filtered = catalogoAlbumes.filter(item => 
            item.toLowerCase().includes(query) && !albumesElegidos.includes(item)
        );

        if (filtered.length > 0) {
            autocompleteList.style.display = 'block';
            filtered.forEach(album => {
                const item = document.createElement('div');
                item.classList.add('autocomplete-item');
                item.innerText = album;
                
                item.addEventListener('click', function() {
                    albumesElegidos.push(album);
                    actualizarChips();
                    searchInput.value = '';
                    autocompleteList.style.display = 'none';
                });

                autocompleteList.appendChild(item);
            });
        } else {
            autocompleteList.style.display = 'none';
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target !== searchInput) {
            autocompleteList.style.display = 'none';
        }
    });
</script>

</body>
</html>
<?php mysqli_close($conexion); ?>