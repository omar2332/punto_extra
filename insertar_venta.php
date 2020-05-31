<?php
include_once 'conexion_pdo.php';
include_once './PHP/venta.php';
include_once './PHP/inventario_producto.php';
include_once './PHP/producto_venta.php';
include_once './PHP/sql.php';
session_start();

$precio_total_venta = $_SESSION['venta']->total; //lo primero que debes insertar para despues obtener el ID

$sql_iniciar="INSERT INTO venta(total) VALUES($precio_total_venta)";
$pdo -> query($sql_iniciar);

$id_venta =  maximo($pdo);

$productos_x_venta_total = $_SESSION['venta']->num_vista; //es el total de productos insertados en la venta
$hoy = getdate(); //la fecha, se debe ajustar para poder insertar

//aqui esta tu for para que insertes los datos requeridos en la tabla inventario_venta
// y a su vez actualices en la tabla inventario la cantidad
for($i=0; $i< $productos_x_venta_total; $i++ ){
    if(!is_null ($_SESSION['venta']->productos[$i]) ){ #A la hora de eliminar los indices no se reacomodan
       
              
              $cantidad = $_SESSION['venta']->productos[$i]->cantidad; #Esta es la cantidad insertada
              $diferencia_inventario_venta = intval($_SESSION['venta']->productos[$i]->cantidad_inventario) - intval($_SESSION['venta']->productos[$i]->cantidad);
              //diferencia__inventario_venta para que actualices el inventario  
              $total_x_producto = $_SESSION['venta']->productos[$i]->total; #total del producto por venta
              $id_producto = $_SESSION['venta']->productos[$i]->id;  #id del producto
              actualizar_inventario($diferencia_inventario_venta, $id_producto, $pdo);
              insertar_inventario_venta($id_venta, $id_producto, $cantidad, $total_x_producto, $pdo);
              
    }

}
header('Location: destruir_sesion.php');
    
function maximo ($pdo) {
         $id_maximo= "SELECT MAX(id_venta) as maximo FROM venta";
         $gsent3 = $pdo -> prepare($id_maximo);
         $gsent3 -> execute();
         $max = $gsent3->fetchAll();
         return $max[0][0];
}

function actualizar_inventario($diferencia, $id, $pdo){
    $actualizar = "UPDATE inventario SET cantidad = $diferencia WHERE id_inventario = $id";
    $gsent3 = $pdo-> prepare ($actualizar);
    $gsent3 -> execute();
}

function insertar_inventario_venta($id_venta, $id_producto, $cantidad, $total, $pdo){
    $insertar = "INSERT INTO inventario_venta (id_venta, id_inventario, cantidad_venta, total) VALUES ($id_venta, $id_producto, $cantidad, $total)";
    $gsent3 = $pdo -> prepare ($insertar);
    $gsent3 -> execute();
}




?>