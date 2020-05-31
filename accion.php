<?php
include_once 'conexion_pdo.php';

function insertar($pdo, $total, $id_inventario, $cantidad, $nombre, $cantidad_venta, $id_venta){
    $sql="INSERT INTO inventario_venta (id_venta, id_inventario, cantidad, cantidad_venta, total) VALUES ($id_venta, $id_inventario, $cantidad, $cantidad_venta, $total)";
    $gsent = $pdo->prepare($sql);
    $gsent->execute();
}

$nombreP = $_POST['nombre_producto'];
$cantidad_venta = $_POST['cantidad_venta'];

$sql_obtener = "SELECT id_inventario, precio, cantidad FROM inventario  WHERE descripcion = '$nombreP';";
$gsent = $pdo->prepare($sql_obtener);
$gsent->execute();
$busqueda = $gsent->fetchAll();
$total = $cantidad_venta * $busqueda[0]['precio'];

$gsent2 = $pdo->prepare("SELECT id_venta FROM venta  WHERE finalizado = 0;");
$gsent2->execute();
$venta =$gsent2->fetchAll();

insertar($pdo, $total, $busqueda[0]['id_inventario'], $busqueda[0]['cantidad'], $nombreP, $cantidad_venta, $venta[0]['id_venta']);
header('location: agregar.php');
?>