<?php
include_once'conexion_pdo.php';

function maximo ($pdo) {
    $id_maximo= "SELECT MAX(id_venta) as maximo FROM venta";
    $gsent3 = $pdo -> prepare($id_maximo);
    $gsent3 -> execute();
    $max = $gsent3->fetchAll();
    return $max[0][0];
}

function suma ($pdo, $max){
    $suma = "SELECT SUM(total) FROM inventario_venta WHERE id_venta = $max";
    $gsent3 = $pdo -> prepare($suma);
    $gsent3 -> execute();
    $sumado = $gsent3 -> fetchAll();
    return $sumado[0][0];
}

$sql_checa="SELECT * FROM venta WHERE finalizado = 0";
$gsent = $pdo->prepare($sql_checa);
$gsent->execute();
$busqueda = $gsent->fetchAll();
if(empty($busqueda)){
    $sql_iniciar="INSERT INTO venta(total, finalizado) VALUES(0, 0)";
    $pdo -> query($sql_iniciar);
    header('location: index.php');
}
else{
    $max_id = maximo($pdo);
    $suma_total = suma($pdo, $max_id);
    $sql_terminar = "UPDATE venta SET finalizado = 1 , total = $suma_total WHERE id_venta = $max_id;";
    $gsent3 = $pdo->prepare($sql_terminar);
    $gsent3 -> execute();
    $mensaje = "Total a pagar: $suma_total";
    echo "<script type='text/javascript'>
        alert('$mensaje');
        window.location = 'index.php'
    </script>";
}
?>