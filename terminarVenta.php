<?php
if (!isset($_POST["total"])) exit;

session_start();

$total = $_POST["total"];
include_once "base_de_datos.php";

$ahora = date("Y-m-d H:i:s");

// Insertar venta
$sentencia = $base_de_datos->prepare("INSERT INTO tbl_ventas(fecha, total) VALUES (?, ?);");
$sentencia->execute([$ahora, $total]);

// Obtener el ID de la venta recién insertada
$sentencia = $base_de_datos->prepare("SELECT id FROM tbl_ventas ORDER BY id DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id;

$base_de_datos->beginTransaction();

// Insertar productos vendidos
$sentencia = $base_de_datos->prepare("INSERT INTO tbl_productos_vendidos(id_producto, id_venta, cantidad) VALUES (?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE tbl_productos SET stock = stock - ? WHERE id = ?;");

foreach ($_SESSION["carrito"] as $producto) {
    // Actualizar el stock
    $sentenciaExistencia->execute([$producto->cantidad, $producto->id]);

    // Insertar en la tabla de productos vendidos
    $sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
}

$base_de_datos->commit();

// Limpiar carrito después de la venta
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

header("Location: ./vender.php?status=1");
?>
