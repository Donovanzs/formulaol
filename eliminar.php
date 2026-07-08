<?php
include("conexion.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM productos WHERE id='$id'";

    if(mysqli_query($conexion, $sql)){
        header("Location: index.php");
        exit();
    }else{
        echo "Error al eliminar el producto.";
    }

}else{
    echo "ID no recibido.";
}
?>