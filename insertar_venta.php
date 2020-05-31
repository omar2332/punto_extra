<?php
include_once 'conexion_pdo.php';
include_once './PHP/venta.php';
include_once './PHP/inventario_producto.php';
include_once './PHP/producto_venta.php';
include_once './PHP/sql.php';
session_start();

$precio_total_venta = $_SESSION['venta']->total; //lo primero que debes insertar para despues obtener el ID

//tu primer insert debe ser con precio_total_venta
//despues buscas el ultimo id de la venta insertada y lo guardar en una variable
//$id_venta =  <-esta variable


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
              
    }

}
    




?>