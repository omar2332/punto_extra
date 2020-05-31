<?php
include_once 'conexion_pdo.php';

$nombreP = $_GET['nombre_producto'];
$cantidad = $_GET['cantidad_venta'];
echo $cantidad;

$sql_obtener = "SELECT id_inventario, precio, cantidad, descripcion FROM inventario  WHERE descripcion = '$nombreP';";
$gsent = $pdo->prepare($sql_obtener);
$gsent->execute();
$busqueda = $gsent->fetchAll();
//echo ($busqueda['cantidad']);
//echo($nombreP. $cantidad);
//$valor = sizeof($busqueda);
//echo ($valor);

//if(empty($busqueda)){
  //  echo (empty($busqueda));// 1
//}

//else{
    //echo $valor;
//}al ser bidimensional toma el valor por conjunto de datos en este caso vale 0

//header('location: index.php');
?>