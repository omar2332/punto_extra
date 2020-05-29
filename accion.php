<?php 
include_once 'conexion_pdo.php';

$nombreP = $_GET['nombre_producto'];
$cantidad = $_GET['cantidad_venta'];
//$sql_obtener = "SELECT id_inventario, precio, cantidad FROM inventario  WHERE descripcion = '$nombreP';";
$sql_venta = "SELECT * FROM inventario_venta";
$gsent = $pdo->prepare($sql_venta);
$gsent->execute();
$busqueda = $gsent->fetchAll();
//var_dump($busqueda);
//echo($nombreP. $cantidad);
$valor = sizeof($busqueda);
if(empty($busqueda)){
    echo 'La tabla esta vacia' ;
}
else{
    echo $valor;
}//al ser bidimensional toma el valor por conjunto de datos en este caso vale 0
?>
