<?php
include("conexion.php");

$id=$_GET['id'];

if(isset($_POST['guardar'])){

    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $cantidad=$_POST['cantidad'];

    $sql="UPDATE productos
          SET nombre='$nombre',
              precio='$precio',
              cantidad='$cantidad'
          WHERE id='$id'";

    mysqli_query($conexion,$sql);

    header("Location: index.php");
exit();
}

$sql="SELECT * FROM productos WHERE id='$id'";
$resultado=mysqli_query($conexion,$sql);
$fila=mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html>
<body>

<h2>Editar Producto</h2>

<form method="POST">

Nombre:
<input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>"><br><br>

Precio:
<input type="text" name="precio" value="<?php echo $fila['precio']; ?>"><br><br>

Cantidad:
<input type="number" name="cantidad" value="<?php echo $fila['cantidad']; ?>"><br><br>

<input type="submit" name="guardar" value="Guardar">

</form>

</body>
</html>