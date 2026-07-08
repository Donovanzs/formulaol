<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "inventario";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>