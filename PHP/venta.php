<?php

include_once './PHP/producto_venta.php';

class venta{

    public $productos;
    public $total;
    public $num_vista = 0;
    function __construct() {
        $this->$productos = array();
        $total = 0;
    }

    function __destruct() {
        
    }


    function agregar_producto($producto){

        $this->productos[]= $producto;

        $precio = $producto->precio;
        $cantidad= $producto->cantidad;
        $this->total+= floatval ($precio)*intval ($cantidad);
        $this->num_vista += 1;
    }

}

?>