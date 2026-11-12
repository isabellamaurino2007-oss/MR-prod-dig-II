<?php 
include 'conexion.php'; 

$mensaje_exito = "";
$mensaje_error = "";

// Procesar el formulario cuando se envía y guardar en la tabla 'ranking' de phpMyAdmin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publicar_lista'])) {
    $album = trim($_POST['selectedAlbums'] ?? '');
    $estrellas = intval($_POST['rating'] ?? 5);
    $opinion = trim($_POST['opinion'] ?? '');

    if (!empty($album)) {
        $stmt = $conexion->prepare("INSERT INTO ranking (album, estrellas, opinion) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sis", $album, $estrellas, $opinion);
            $stmt->execute();
            $stmt->close();
            $mensaje_exito = "¡Guardado con éxito en la base de datos!";
        } else {
            $mensaje_error = "Error al guardar en la base de datos.";
        }
    } else {
        $mensaje_error = "Por favor, selecciona un álbum del buscador.";
    }
}
?>
<!DOCTYPE html> 
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MusicRoom - Rankings</title>
<link rel="stylesheet" href="style.css">
<style>
    /* Estética intacta manteniendo el espacio debajo del header fijo */
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

    /* Autocompletado */
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
        z-index: 99;
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

    /* Sistema de Calificación de 5 Estrellas */
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 5px;
        margin-bottom: 15px;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 1.8rem;
        color: #552229;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffd700;
    }

    .builder-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-top: 15px;
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

    .btn-secondary {
        background-color: transparent;
        color: #d1a1a7;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: color 0.2s, border-color 0.2s;
    }

    .btn-secondary:hover {
        color: #ffffff;
        border-color: #ffd700;
    }

    /* Tabla de Rankings Publicados */
    .ranking-table-container {
        background: rgba(0,0,0,0.4);
        border-radius: 16px;
        padding: 25px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .ranking-table {
        width: 100%;
        border-collapse: collapse;
    }

    .ranking-table th {
        text-align: left;
        padding: 12px;
        color: #d1a1a7;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .ranking-table td {
        padding: 14px 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        font-size: 0.95rem;
        vertical-align: top;
    }

    .rank-number {
        font-weight: bold;
        color: #ffd700;
        width: 40px;
    }
</style>
</head>

<body>
<header class="header-banner-container" style="position: absolute; top: 0; left: 0; width: 100%;">
<img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">
<div class="header-overlay-centro">
<h1 class="titulo-principal">MusicRoom</h1>
<div class="search-box-container">
<input type="text" id="buscadorPrincipal" placeholder="Busca un álbum para puntuar o reseñar...">
</div>
</div>
<nav class="nav-bar">
<a href="index.php">INICIO</a>
<a href="rankings.php" class="active">RANKING</a>
<a href="crear.php">CREAR</a>
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

    <!-- Sección del Creador de Listas / Rankings -->
    <section class="builder-container">
        <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin-top: 0; margin-bottom: 20px; font-weight: 700;">Arma tu Ranking de Álbum</h2>
        
        <form action="" method="POST">
            <!-- Buscador con Autocompletado de Álbumes -->
            <label style="display: block; color: #d1a1a7; font-size: 0.9rem; margin-bottom: 5px;">Busca y selecciona un álbum:</label>
            <div class="autocomplete-wrapper">
                <input type="text" id="albumSearchInput" placeholder="Empieza a escribir el artista o álbum..." autocomplete="off">
                <div id="autocompleteList" class="autocomplete-list"></div>
            </div>

            <!-- Campo que recibe el álbum seleccionado automáticamente -->
            <label style="display: block; color: #d1a1a7; font-size: 0.9rem; margin-bottom: 5px;">Álbum seleccionado:</label>
            <input type="text" id="selectedAlbumsInput" name="selectedAlbums" placeholder="El álbum seleccionado aparecerá aquí..." readonly required style="background-color: rgba(0,0,0,0.5); color: #ffd700; cursor: not-allowed;">

            <!-- Sistema de Calificación de 5 Estrellas -->
            <label style="display: block; color: #d1a1a7; font-size: 0.9rem; margin-bottom: 8px;">Calificación en estrellas:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" checked><label for="star5" title="5 estrellas">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 estrellas">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 estrellas">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 estrellas">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 estrella">★</label>
            </div>

            <!-- Cuadro de Opinión -->
            <textarea name="opinion" rows="3" placeholder="Escribe tu opinión o reseña sobre este álbum..."></textarea>
            
            <div class="builder-actions">
                <button type="submit" name="publicar_lista" class="btn-primary">Guardar en Ranking</button>
                <button type="button" class="btn-secondary" onclick="limpiarSeleccion()">Limpiar Todo</button>
            </div>
        </form>
    </section>

    <!-- Sección: Tabla de Rankings Guardados leída directo de phpMyAdmin -->
    <section class="ranking-table-container">
        <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin-top: 0; margin-bottom: 20px; font-weight: 700;">Rankings Guardados</h2>
        
        <table class="ranking-table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Álbum</th>
                    <th>Estrellas</th>
                    <th>Opinión</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta directa a la tabla 'ranking' de tu base de datos
                $resultado_rankings = mysqli_query($conexion, "SELECT * FROM ranking ORDER BY id DESC");

                if ($resultado_rankings && mysqli_num_rows($resultado_rankings) > 0): 
                    while ($row = mysqli_fetch_assoc($resultado_rankings)): 
                ?>
                        <tr>
                            <td class="rank-number"><?php echo $row['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['album']); ?></strong></td>
                            <td style="color: #ffd700;">
                                <?php echo str_repeat('★', intval($row['estrellas'])); ?> 
                                <span style="color: #fff; font-weight: bold;"><?php echo intval($row['estrellas']); ?>.0</span>
                            </td>
                            <td style="color: rgba(255,255,255,0.8); font-style: italic;">
                                "<?php echo htmlspecialchars($row['opinion']); ?>"
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: rgba(255,255,255,0.4); padding: 25px;">Aún no hay registros guardados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

</main>

<!-- Lógica de Autocompletado en JavaScript -->
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

    const searchInput = document.getElementById('albumSearchInput');
    const autocompleteList = document.getElementById('autocompleteList');
    const selectedAlbumsInput = document.getElementById('selectedAlbumsInput');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        autocompleteList.innerHTML = '';

        if (query.length === 0) {
            autocompleteList.style.display = 'none';
            return;
        }

        const filtered = catalogoAlbumes.filter(album => album.toLowerCase().includes(query));

        if (filtered.length > 0) {
            autocompleteList.style.display = 'block';
            filtered.forEach(album => {
                const item = document.createElement('div');
                item.classList.add('autocomplete-item');
                item.innerText = album;
                
                item.addEventListener('click', function() {
                    selectedAlbumsInput.value = album;
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

    function limpiarSeleccion() {
        searchInput.value = '';
        selectedAlbumsInput.value = '';
        const opinionArea = document.querySelector('textarea[name="opinion"]');
        if(opinionArea) opinionArea.value = '';
        autocompleteList.style.display = 'none';
    }
</script>

</body>
</html>
<?php mysqli_close($conexion); ?>