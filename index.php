<?php 
include 'conexion.php'; 

// Procesar formulario de listas en el mismo index
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_lista'])) {
    $nombre_lista = mysqli_real_escape_string($conexion, $_POST['nombre_lista']);
    $albumes_ids = isset($_POST['albumes']) ? implode(',', $_POST['albumes']) : '';

    if (!empty($nombre_lista) && !empty($albumes_ids)) {
        $query = "INSERT INTO playlists (nombre, descripcion) VALUES ('$nombre_lista', '$albumes_ids')";
        mysqli_query($conexion, $query);
    }
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html> 
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MusicRoom - Inicio</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<header class="header-banner-container">
<img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">
<div class="header-overlay-centro">
<h1 class="titulo-principal">MusicRoom</h1>
<div class="search-box-container">
<input type="text" id="buscadorPrincipal" placeholder="Busca un álbum para puntuar o reseñar...">
</div>
</div>
<nav class="nav-bar">
<a href="index.php">INICIO</a>
<a href="rankings.php">RANKING</a>
<a href="crear.php">CREAR</a>
<a href="fav.php">FAV</a>
<a href="perfil.php">PERFIL</a>
<a href="registro.php">REGISTRO</a>
</nav>
</header>

<main class="main-content">

<?php
// Carga de discos desde la base de datos
$discos = [];
$resultado_discos = mysqli_query($conexion, "SELECT * FROM albums");
if ($resultado_discos) {
    while ($row = mysqli_fetch_assoc($resultado_discos)) {
        $discos[$row['id']] = [$row['nombre'], $row['artista']];
    }
}
?>

<!-- Sección de Álbumes Populares para Rankear -->
<section class="dashboard-section">
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
<h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin: 0; font-weight: 700;"> Álbumes Populares para Rankear</h2>
<a href="rankings.php" style="color: #d1a1a7; text-decoration: none; font-size: 0.9rem; font-weight: 500;">Ver Ranking Completo →</a>
</div>

<div class="flex-container-scroll" id="contenedor-albumes">
<?php
foreach ($discos as $id => $info) {
echo '
<a href="albumportada.php?id='.$id.'" style="text-decoration: none; color: inherit; flex-shrink: 0;" class="item-album-enlace">
<div class="card">
<div class="img-container">
<img src="img/disco'.$id.'.jpg" alt="'.$info[0].'">
</div>
<p class="name">'.$info[0].'</p>
<p class="artist">'.$info[1].'</p>
<div style="margin-top: 6px; color: #d1a1a7; font-size: 0.75rem; font-weight: 600;">★★★★★ 4.8</div>
</div>
</a>';
}
?>
</div>
</section>

<!-- Sección de Crear Listas / Rankings -->
<section class="dashboard-section" style="margin-top: 40px;">
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
<h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin: 0; font-weight: 700;"> Arma tu Lista / Ranking</h2>
<span id="contador-seleccion" style="color: #d1a1a7; font-size: 0.9rem; font-weight: 500;">0 álbumes seleccionados</span>
</div>

<div class="crear-box-inline" style="background: rgba(0,0,0,0.25); padding: 25px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08);">
<form id="formCrearInline" method="POST">
<div style="margin-bottom: 20px;">
<label for="nombre_lista_index" style="color: #fff; display: block; margin-bottom: 8px; font-weight: 500;">Título de tu Lista o Ranking:</label>
<input type="text" id="nombre_lista_index" name="nombre_lista" placeholder="Ej. Mis 10 discos favoritos de R&B en Spanglish..." required style="width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); color: #fff; outline: none;">
</div>

<label style="color: #fff; display: block; margin-bottom: 10px; font-weight: 500;">Selecciona los álbumes para tu lista:</label>
<div class="playlist-grid-inline" style="display: flex; gap: 15px; overflow-x: auto; padding: 10px 0;">
<?php
foreach ($discos as $id => $info) {
echo '
<div class="album-chk-card" onclick="toggleCardIndex(this, '.$id.')">
<img src="img/disco'.$id.'.jpg" alt="'.$info[0].'" style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px; margin-bottom: 6px;">
<p style="color: #fff; font-size: 0.8rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><strong>'.$info[0].'</strong></p>
<small style="color: #d1a1a7; font-size: 0.7rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">'.$info[1].'</small>
<input type="checkbox" name="albumes[]" value="'.$id.'" id="chk_idx_'.$id.'" style="display:none;">
</div>';
}
?>
</div>

<div style="margin-top: 20px; display: flex; align-items: center;">
<button type="submit">Publicar Lista</button>
<button type="button" class="btn-secundario" onclick="limpiarSeleccion()">Limpiar Selección</button>
</div>
</form>
</div>
</section>

<!-- Sección de Listas Guardadas -->
<section class="dashboard-section" style="margin-top: 40px;">
<h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin-bottom: 15px; font-weight: 700;"> Tus Listas y Rankings Publicados</h2>

<div id="contenedor-playlists-index">
<?php
$query_playlists = mysqli_query($conexion, "SELECT * FROM playlists");

if (!$query_playlists || mysqli_num_rows($query_playlists) === 0) {
    echo '
    <div style="background: rgba(0,0,0,0.2); padding: 30px; border-radius: 12px; text-align: center; border: 1px dashed rgba(255,255,255,0.15);">
    <p style="color: #d1a1a7; font-size: 1.1rem; margin-bottom: 5px; font-weight: 500;">Aún no has publicado listas ni rankings</p>
    <p style="color: #999; font-size: 0.85rem;">Crea tu primer ranking seleccionando tus álbumes favoritos arriba </p>
    </div>';
} else {
    while ($playlist = mysqli_fetch_assoc($query_playlists)) {
        echo '
        <div style="background: rgba(0,0,0,0.25); padding: 20px; border-radius: 12px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.08);">
            <h3 style="color: #fff; margin-bottom: 12px; font-size: 1.1rem; font-weight: 600;"> '.$playlist['nombre'].'</h3>
            <div style="display: flex; gap: 15px; overflow-x: auto; padding: 5px 0;">';
        
        $ids_albumes = explode(',', $playlist['descripcion']);
        foreach ($ids_albumes as $id_album) {
            $id_album = trim($id_album);
            if (isset($discos[$id_album])) {
                $d_info = $discos[$id_album];
                echo '
                <div style="flex: 0 0 140px; background: rgba(255,255,255,0.05); padding: 10px; border-radius: 8px; text-align: center;">
                    <img src="img/disco'.$id_album.'.jpg" alt="'.$d_info[0].'" style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px; margin-bottom: 6px;">
                    <p style="color: #fff; font-size: 0.8rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><strong>'.$d_info[0].'</strong></p>
                    <small style="color: #d1a1a7; font-size: 0.7rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">'.$d_info[1].'</small>
                </div>';
            }
        }

        echo '</div>
        </div>';
    }
}
?>
</div>
</section>

</main>

<div id="toast-notificacion">
<span></span> <span id="toast-texto">¡Lista publicada con éxito!</span>
</div>

<script>
const discosData = {};
<?php
foreach($discos as $id => $info) {
echo "discosData[$id] = { nombre: ".json_encode($info[0]).", artista: ".json_encode($info[1]).", img: 'img/disco$id.jpg' };\n";
}
?>

function actualizarContador() {
let seleccionados = document.querySelectorAll('input[name="albumes[]"]:checked').length;
let contadorEl = document.getElementById('contador-seleccion');
if (contadorEl) {
contadorEl.textContent = seleccionados === 1 ? "1 álbum seleccionado" : `${seleccionados} álbumes seleccionados`;
}
}

function toggleCardIndex(cardElement, id) {
let checkbox = document.getElementById('chk_idx_' + id);
checkbox.checked = !checkbox.checked;
if (checkbox.checked) {
cardElement.style.borderColor = "#ffffff";
cardElement.style.background = "rgba(255,255,255,0.18)";
cardElement.style.transform = "scale(1.03)";
} else {
cardElement.style.borderColor = "transparent";
cardElement.style.background = "rgba(255,255,255,0.05)";
cardElement.style.transform = "scale(1)";
}
actualizarContador();
}

function limpiarSeleccion() {
document.querySelectorAll('input[name="albumes[]"]').forEach(cb => {
cb.checked = false;
let card = cb.closest('.album-chk-card');
if(card) {
card.style.borderColor = "transparent";
card.style.background = "rgba(255,255,255,0.05)";
card.style.transform = "scale(1)";
}
});
document.getElementById('nombre_lista_index').value = "";
actualizarContador();
}

document.addEventListener("DOMContentLoaded", () => {
const secciones = document.querySelectorAll('.dashboard-section');
const observer = new IntersectionObserver((entries) => {
entries.forEach(entry => {
if (entry.isIntersecting) {
entry.target.classList.add('visible');
}
});
}, { threshold: 0.1 });
secciones.forEach(sec => observer.observe(sec));

const inputBuscador = document.getElementById("buscadorPrincipal");
if (inputBuscador) {
inputBuscador.addEventListener("input", function() {
const filtro = this.value.toLowerCase().trim();
const tarjetas = document.querySelectorAll(".flex-container-scroll > .item-album-enlace");
tarjetas.forEach(tarjeta => {
const texto = tarjeta.textContent.toLowerCase();
if (filtro === "" || texto.includes(filtro)) {
tarjeta.style.display = "";
setTimeout(() => tarjeta.style.opacity = "1", 10);
} else {
tarjeta.style.opacity = "0";
setTimeout(() => tarjeta.style.display = "none", 300);
}
});
});
}
});
</script>

</body>
</html>
<?php mysqli_close($conexion); ?>