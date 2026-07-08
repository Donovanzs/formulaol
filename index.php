<?php
include("conexion.php");

if (isset($_POST['agregar'])) {
    $nombre = trim($_POST['nombre']);
    $precio = trim($_POST['precio']);
    $cantidad = trim($_POST['cantidad']);

    if ($nombre !== '') {
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $precio = mysqli_real_escape_string($conexion, $precio);
        $cantidad = mysqli_real_escape_string($conexion, $cantidad);

        $sql_insert = "INSERT INTO productos (nombre, precio, cantidad) VALUES ('$nombre', '$precio', '$cantidad')";
        mysqli_query($conexion, $sql_insert);

        header("Location: index.php");
        exit();
    }
}

$registros = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $registros;

$sql = "SELECT * FROM productos LIMIT $inicio, $registros";
$resultado = mysqli_query($conexion, $sql);

$total = mysqli_query($conexion, "SELECT * FROM productos");
$num_total = mysqli_num_rows($total);
$paginas = ceil($num_total / $registros);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventario de Artículos</title>
</head>
<body>

<h2>Agregar artículo</h2>
<form method="POST" action="index.php">
    <label>Nombre del artículo:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Precio:</label><br>
    <input type="text" name="precio" required><br><br>

    <label>Cantidad:</label><br>
    <input type="number" name="cantidad" min="0" required><br><br>

    <input type="submit" name="agregar" value="Agregar artículo">
</form>

<hr> 

<h2>Lista de artículos</h2>
<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Artículo</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Acciones</th>
</tr>

<?php
while ($fila = mysqli_fetch_assoc($resultado)) {
?>
<tr>
    <td><?php echo htmlspecialchars($fila['id']); ?></td>
    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
    <td><?php echo htmlspecialchars($fila['precio']); ?></td>
    <td><?php echo htmlspecialchars($fila['cantidad']); ?></td>
    <td>
        <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a> |
        <a href="eliminar.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Eliminar artículo?')">Eliminar</a>
    </td>
</tr>
<?php
}
?>

</table>

<br>

<?php
for ($i = 1; $i <= $paginas; $i++) {
    echo "<a href='index.php?pagina=$i'>$i</a> ";
}
?>

</body>
</html>