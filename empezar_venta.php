<?php
include_once 'conexion_pdo.php';
include_once './PHP/venta.php';
include_once './PHP/inventario_producto.php';
include_once './PHP/producto_venta.php';
include_once './PHP/sql.php';
// function maximo ($pdo) {
//     $id_maximo= "SELECT MAX(id_venta) as maximo FROM venta";
//     $gsent3 = $pdo -> prepare($id_maximo);
//     $gsent3 -> execute();
//     $max = $gsent3->fetchAll();
//     return $max[0][0];
// }

// function suma ($pdo, $max){
//     $suma = "SELECT SUM(total) FROM inventario_venta WHERE id_venta = $max";
//     $gsent3 = $pdo -> prepare($suma);
//     $gsent3 -> execute();
//     $sumado = $gsent3 -> fetchAll();
//     return $sumado[0][0];
// }

// function contar($pdo, $max){
//     $contar = "SELECT COUNT(id_inventario_venta) AS productos_vendidos FROM inventario_venta WHERE id_venta = $max";
//     $gsent3 = $pdo -> prepare($contar);
//     $gsent3 -> execute();
//     $resultado = $gsent3 -> fetchAll();
//     return $resultado[0][0];
// }

// function actualizar_tablas($pdo, $max){
//     $inventario = "SELECT cantidad, cantidad_venta, id_inventario FROM inventario_venta WHERE id_venta = $max";
//     $gsent3 = $pdo -> prepare($inventario);
//     $gsent3 -> execute();
//     $resultados = $gsent3 -> fetchAll();
//     //$contador = contar($pdo, $max);
//     foreach($resultados as $cantidades){
//         $diferencia = $cantidades['cantidad'] - $cantidades['cantidad_venta'];
//         $actualizar = "UPDATE inventario SET cantidad = $diferencia WHERE id_inventario = '$cantidades[id_inventario]'";
//         $gsent3 = $pdo -> prepare($actua);
//         $gsent3 -> execute();
//     }
// }

// $sql_checa="SELECT * FROM venta WHERE finalizado = 0";
// $gsent = $pdo->prepare($sql_checa);
// $gsent->execute();
// $busqueda = $gsent->fetchAll();
// if(empty($busqueda)){
//     $sql_iniciar="INSERT INTO venta(total, finalizado) VALUES(0, 0)";
//     $pdo -> query($sql_iniciar);
//     header('location: index.php');
// }
// else{
//     $max_id = maximo($pdo);
//     $suma_total = suma($pdo, $max_id);
//     $sql_terminar = "UPDATE venta SET finalizado = 1 , total = $suma_total WHERE id_venta = $max_id;";
//     $gsent3 = $pdo->prepare($sql_terminar);
//     $gsent3 -> execute();
//     actualizar_tablas($pdo, $max_id);
//     $mensaje = "Total a pagar: $suma_total";
//     echo "<script type='text/javascript'>
//         alert('$mensaje');
//         window.location = 'index.php'
//     </script>";
// }


session_start();


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php if ($_SESSION['venta']->total>0):?>
    <h1>El total de la venta es $<?php echo $_SESSION['venta']->total?></h1>
    <a class="btn btn-primary" href="index.php" role="button">Regresar</a>
    <a class="btn btn-success" href="insertar_venta.php" role="button">Terminar</a>
    <?php else: ?>
    <?php session_destroy(); ?>
        <div class="alert alert-danger mt-5 text-center" role="alert">
                No hay ninguna venta realizada
        </div>
        <a class="btn btn-warning" href="index.php" role="button">Regresar</a>
        
    <?php endif;?>

    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>