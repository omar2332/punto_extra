<?php

class producto_venta{
    public $id;
    public $descripcion;
    public $precio;
    public $cantidad;
    public $cantidad_inventario;
    public $total;
    

    function __construct() { }

    function set_producto_venta($producto, $cantidad){
        
        if( intval ($cantidad) <= intval ($producto['cantidad']) ){
            $this->id = $producto['id_inventario'];
            $this->descripcion = $producto['descripcion'];;
            $this->precio = $producto['precio'];
            $this->cantidad = $cantidad;
            $this->cantidad_inventario= $producto['cantidad'];
            $this->total = floatval($this->cantidad)*floatval($this->precio);
            $this->num_vista +=1;
            return true;
            
        }else{
            echo '<div class="alert alert-danger mt-5" role="alert">
                    La cantidad insertada es mayor que la cantidad en almacen
                  </div>';
            return false;
        }

    }


}


?>