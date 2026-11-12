<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "musicroom_db";

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar si hubo algún error de conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Opcional para asegurar tildes y caracteres especiales en español
$conexion->set_charset("utf8mb4");
?>