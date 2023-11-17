<?php
// Salir si alguno de los datos no está presente
if (

    !isset($_POST["nombre"]) || 
    !isset($_POST["categoria"]) || 
    !isset($_POST["precio"]) || 
    !isset($_POST["stock"]) || 
    !isset($_POST["marca"]) || 
    !isset($_POST["codigo"]) || 
    !isset($_POST["color"])
) {
    exit();
}

// Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";

$idProducto = $_POST["idProducto"];
$nombre = $_POST["nombre"];
$categoria = $_POST["categoria"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$marca = $_POST["marca"];
$codigo = $_POST["codigo"];
$color = $_POST["color"];

$sentencia = $base_de_datos->prepare("INSERT INTO tbl_productos( nombre, categoria, precio, stock, marca, codigo, color) VALUES (?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$nombre, $categoria, $precio, $stock, $marca, $codigo, $color]);

if ($resultado === TRUE) {
    header("Location: ./listar.php");
    exit;
} else {
    echo "Algo salió mal. Por favor verifica que la tabla exista.";
}

include_once "pie.php";
?>
