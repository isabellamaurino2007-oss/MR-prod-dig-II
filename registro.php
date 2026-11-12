<?php
include 'conexion.php';

$mensaje = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los datos del formulario
    $nombre_usuario = $conexion->real_escape_string($_POST['nombre_usuario']);
    $email = $conexion->real_escape_string($_POST['email']);
    $password = $conexion->real_escape_string($_POST['password']); // Nota: recuerda usar password_hash en un futuro para mayor seguridad

    // Insertamos en la tabla usuario (usamos comillas invertidas en `nombre-usuario` por el guion medio)
    $sql = "INSERT INTO usuario (`nombre-usuario`, email, password) VALUES ('$nombre_usuario', '$email', '$password')";

    if ($conexion->query($sql) === TRUE) {
        $mensaje = "¡Registro exitoso! Ya puedes iniciar sesión.";
    } else {
        $error = "Hubo un error al registrarse: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicRoom - Registro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="header-banner-container">
        <img src="img/banner.jpg" alt="Banner MusicRoom" class="banner-img-fondo">

        <div class="header-overlay-centro">
            <h1 class="titulo-principal">MusicRoom</h1>
        </div>

        <nav class="nav-bar">
    <a href="index.php">INICIO</a>
    <a href="rankings.php">RANKING</a>
    <a href="crear.php">CREAR</a>
    <a href="fav.php">FAV</a>
    <a href="perfil.php">PERFIL</a>
    <a href="registro.php">REGISTRO</a> <!-- Enlace añadido -->
</nav>
    </header>

    <main class="main-content" style="display: flex; justify-content: center; align-items: center; min-height: 50vh;">
        <div style="background: rgba(0,0,0,0.4); padding: 30px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.08); width: 100%; max-width: 400px;">
            <h2 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #fff; margin-bottom: 20px; text-align: center; font-weight: 700;"> Regístrate</h2>

            <?php if (!empty($mensaje)): ?>
                <div style="background: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #d4edda; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 0.9rem;">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div style="background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #f8d7da; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 0.9rem;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST">
                <div style="margin-bottom: 15px;">
                    <label for="nombre_usuario" style="color: #fff; display: block; margin-bottom: 6px; font-weight: 500;">Nombre de usuario:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" required style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); color: #fff; outline: none;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="email" style="color: #fff; display: block; margin-bottom: 6px; font-weight: 500;">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); color: #fff; outline: none;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password" style="color: #fff; display: block; margin-bottom: 6px; font-weight: 500;">Contraseña:</label>
                    <input type="password" id="password" name="password" required style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); color: #fff; outline: none;">
                </div>

                <button type="submit" style="width: 100%; background: #d1a1a7; color: #2b080c; border: none; padding: 12px; border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 1rem;">Registrarse</button>
            </form>
        </div>
    </main>

</body>

</html>