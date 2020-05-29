<?php
    include_once 'conexion_pdo.php';
    $id = $_GET['id'];
    $sql_eliminar = 'delete from inventario_venta where id_inventario_venta = ?';
    $sentencia_eliminar = $pdo -> prepare($sql_eliminar);
    $sentencia_eliminar ->execute(array($id));
    header('location: index.php');

?>