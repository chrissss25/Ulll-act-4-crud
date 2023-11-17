<?php
if (!isset($_POST["codigo"])) {
    return;
}

$codigo = trim($_POST["codigo"]); // Limpiar espacios al principio y al final del código
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM tbl_productos WHERE codigo = ? LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./vender.php?status=4");
    exit;
}

# Si no hay existencia...
if ($producto->stock < 1) {
    header("Location: ./vender.php?status=5");
    exit;
}

session_start();

# Buscar producto dentro del carrito
$indice = false;

foreach ($_SESSION["carrito"] as $i => $item) {
    $itemCodigo = trim($item->codigo); // Limpiar espacios al principio y al final del código en el carrito
    if ($itemCodigo === $codigo) {
        $indice = $i;
        break;
    }
}

# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->cantidad = 1;
    $producto->total = $producto->precio * $producto->cantidad;
    array_push($_SESSION["carrito"], $producto);
} else {
    # Si ya existe, actualizamos la cantidad
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;

    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $producto->stock) {
        header("Location: ./vender.php?status=5");
        exit;
    }

    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->precio * $_SESSION["carrito"][$indice]->cantidad;
}

header("Location: ./vender.php");
?>
