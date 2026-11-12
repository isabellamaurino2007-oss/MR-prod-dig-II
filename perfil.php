<?php 
// 1. Incluimos la conexión a la base de datos al inicio de todo
include 'conexion.php'; 
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicRoom - Mi Perfil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos alineados con la identidad visual de MusicRoom */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1a0406;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .perfil-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .perfil-header-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            align-items: center;
            gap: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            backdrop-filter: blur(10px);
            margin-bottom: 40px;
        }

        .perfil-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #d1a1a7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #2b080c;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(209, 161, 167, 0.3);
        }

        .perfil-info h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            margin: 0 0 10px 0;
            color: #fff;
        }

        .perfil-info p {
            color: #d1a1a7;
            margin: 0;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .seccion-titulo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }

        .playlists-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .playlist-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .playlist-card:hover {
            transform: translateY(-4px);
            border-color: rgba(209, 161, 167, 0.4);
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }

        .playlist-card h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            margin: 0 0 10px 0;
            color: #fff;
        }

        .playlist-card p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            margin: 0;
            line-height: 1.4;
        }

        .sin-playlists {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 16px;
            border: 1px dashed rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.95rem;
        }
    </style>
</head>

<body>

    <header class="header-banner-container">
        <img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">

        <div class="header-overlay-centro">
            <!-- Título del banner idéntico al de fav.php -->
            <h1 class="titulo-principal">MusicRoom</h1>
        </div>
        <nav class="nav-bar">
            <a href="index.php">INICIO</a>
            <a href="rankings.php">RANKING</a>
            <a href="crear.php">CREAR</a>
            <a href="fav.php">FAV</a>
            <a href="perfil.php" class="active">PERFIL</a>
            <a href="registro.php">REGISTRO</a>
        </nav>
    </header>

    <main class="perfil-container">
        
        <!-- Tarjeta de presentación del usuario -->
        <div class="perfil-header-card">
            <div class="perfil-avatar">IM</div>
            <div class="perfil-info">
                <h1>Isabella Maurino</h1>
                <p><span style="color: #ffd700;"></span> Amante del R&B, Reggae & Spanglish | Curadora de música</p>
            </div>
        </div>

        <!-- Sección de Playlists extraídas de la Base de Datos -->
        <section>
            <h2 class="seccion-titulo">Mis Playlists Creadas</h2>

            <div class="playlists-grid">
                <?php 
                // Consultamos las playlists ordenadas de la más nueva a la más antigua
                $resultado = $conexion->query("SELECT * FROM playlists ORDER BY id DESC");

                if ($resultado && $resultado->num_rows > 0) {
                    while($playlist = $resultado->fetch_assoc()) {
                        echo '<div class="playlist-card">';
                        echo '<h3>' . htmlspecialchars($playlist['nombre']) . '</h3>';
                        echo '<p>' . htmlspecialchars($playlist['descripcion']) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="sin-playlists">Aún no has creado ninguna playlist. ¡Crea una desde la sección CREAR!</div>';
                }
                ?>
            </div>
        </section>

    </main>

</body>

</html>