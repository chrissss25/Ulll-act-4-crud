<?php

# Salir si alguno de los datos no está presente
if (
   
    !isset($_POST["nombre"]) ||
    !isset($_POST["categoria"]) ||
    !isset($_POST["precio"]) ||
    !isset($_POST["stock"]) ||
    !isset($_POST["marca"]) ||
    !isset($_POST["codigo"]) ||
    !isset($_POST["color"])
) exit();

# Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";

$nombre = $_POST["nombre"];
$categoria = $_POST["categoria"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$marca = $_POST["marca"];
$codigo = $_POST["codigo"];
$color = $_POST["color"];
$id = $_POST["id"];  // Añadí la línea para mantener la variable $id

$sentencia = $base_de_datos->prepare("UPDATE tbl_productos SET  nombre = ?, categoria = ?, precio = ?, stock = ?, marca = ?, codigo = ?, color = ? WHERE id = ?;");
$resultado = $sentencia->execute([$nombre, $categoria, $precio, $stock, $marca, $codigo, $color, $id]);

if ($resultado === TRUE) {
    header("Location: ./listar.php");
    exit;
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
}
?>
