<?php
include_once './PHP/venta.php';
include_once './PHP/inventario_producto.php';
include_once './PHP/producto_venta.php';
session_start();

var_dump( $_GET['pos']);
$precio = $_SESSION['venta']->productos[ intval($_GET['pos'])]->precio;
$cantidad = $_SESSION['venta']->productos[ intval($_GET['pos'])]->cantidad;
$_SESSION['venta']->total-= floatval ($precio)*intval ($cantidad)  ; 
unset($_SESSION['venta']->productos[ intval($_GET['pos'])] );
//$_SESSION['venta']->num_vista -=1;

header('location: index.php');
?>