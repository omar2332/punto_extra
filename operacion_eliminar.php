<?php
    include_once 'conexion_pdo.php';
    $id = $_GET['id'];
    $sql_eliminar = 'delete from inventario where id_inventario = ?';
    $sentencia_eliminar = $pdo -> prepare($sql_eliminar);
    $sentencia_eliminar ->execute(array($id));
    header('location: eliminar.php');

?>