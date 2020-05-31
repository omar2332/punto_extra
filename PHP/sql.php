<?php

class sql{

    protected $pdo;

    function cerrar_pdo(){
        $pdo=null;
    }   

    function conexion_pdo(){
        $usuario = 'root';
        $contraseña = 'root';    
        try {
            $this->$pdo = new PDO('mysql:host=localhost:3307;dbname=abarrotes', $usuario, $contraseña);
        } catch (PDOException $e) {
            echo "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        } 


    }

    function buscar_producto_x_nombre($nombre){
        $this->conexion_pdo();
        $sql_categorias = "SELECT * from inventario where descripcion = '$nombre' ";
        $gsent= $this->$pdo -> prepare($sql_categorias);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        return $resultado[0];
    }


}


?>