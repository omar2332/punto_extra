
<?php include_once 'conexion_pdo.php';

include_once './PHP/venta.php';
include_once './PHP/inventario_producto.php';
include_once './PHP/producto_venta.php';
include_once './PHP/sql.php';
?>


<?php
$error = '';
session_start();
if(!isset($_SESSION['venta'])){

  $_SESSION['venta'] =  new venta();

}

$sql_objeto = new sql();


if(isset($_POST['nombre_producto']) && $_POST['nombre_producto'] != ''  ){
  $producto = $sql_objeto->buscar_producto_x_nombre($_POST['nombre_producto']);
  $producto_objeto = new producto_venta();
  
  $decision = $producto_objeto->set_producto_venta($producto,$_POST['cantidad_venta']);
  
  if($decision){
    $_SESSION['venta']-> agregar_producto($producto_objeto);
    $error = '';

  }
  
  

}else{
  if(isset($_POST['nombre_producto'])){
    $error = '<div class="alert alert-danger mt-5" role="alert">
            Por favor introduzca algun producto
            </div>';
  }
  
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tienda de abarrotes</title>
    <?php if( $error != ''  ){
      echo $error;
      } ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="css/tabla.css" rel="stylesheet">
  </head>
  <body>
    <h1 class="py-3 mb-5 text-center"> Tienda de Abarrotes "Los que sobreviven"</h1>


    <h2 class="ml-5 px-5">Seleccione los productos para la venta</h2>
    <div class="container">
      
    
    <section id="tablaProductos">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Producto(s)</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad solicitada</th>
            <th scope="col">Cantidad en almacen</th>
            <th scope="col">Total</th>
            <th scope="col">X</th>
          </tr>
        </thead>
        <?php
        
        for($i=0; $i< $_SESSION['venta']->num_vista; $i++ ): 
            if(!is_null ($_SESSION['venta']->productos[$i]) ):
        ?>
        <tbody>
              <td> <?php echo $_SESSION['venta']->productos[$i]->descripcion; ?> </td>
              <td> $<?php  echo $_SESSION['venta']->productos[$i]->precio; ?> </td>
              <td> <?php  echo $_SESSION['venta']->productos[$i]->cantidad; ?> </td>
              <td> <?php echo $_SESSION['venta']->productos[$i]->cantidad_inventario; ?> </td>
              <td> $<?php echo $_SESSION['venta']->productos[$i]->total; ?> </td>
              <td>
                <a href="operacion_eliminar_venta.php?pos=<?php echo $i; ?>" class="button">
                  <button type="button" class="btn btn-light">Eliminar</button>
                </a>
              </td>
            </tr>            
        </tbody>
            <?php endif;
            endfor; ?>
      </table>
      </section>
    </div>

      <div class="container mb-5 mt-5">
        <form method="POST" onsubmit="return validar();">
          <div class="form-group">
            <label >Producto</label>
            <input type="text" class="form-control" id="producto" name="nombre_producto" placeholder="Escriba el producto"  <?php if(isset($_GET['id'])){
              $sql_categorias = 'select * from inventario where id_inventario ='.$_GET['id'];;
          
              $gsent= $pdo -> prepare($sql_categorias);
              $gsent->execute();
              $resultado = $gsent->fetchAll();
              foreach($resultado as $categoria){
                echo 'value = '.$categoria['descripcion'] ;

              }
             
              }?>>
          
          </div>

          <div class="form-group">
            <label >Cantidad</label>
            <input type="text" class="form-control" id ="cantidad_venta" name="cantidad_venta" placeholder="Escriba el cantidad">
          
          </div>
           <button type="submit"  class="btn btn-primary" >
              Agregar
           </button>
        </form>

      </div>
      <div class="container mb-5 mt-5">
        <section>

              <a class = 'btn btn-success mt-5' href="empezar_venta.php">Finalizar compra</a>

              <a class="btn btn-secondary mt-5" href = 'destruir_sesion.php'>Nueva compra</a>
        </section>
      </div>
      
            <h2 class=" text-center mt-5 mb-5">
              Inventario
            </h2>


            <div class="container">  
              <div class="row mi-fila">
                <div class="col mi-columna">Producto</div>
                <div class="col mi-columna">Precio</div>
                <div class="col mi-columna">Disponibilidad</div>
                <div class="col mi-columna">Seleccionar</div>
                
              </div>
              <?php
                $sql_categorias = 'select * from inventario';
          
                $gsent= $pdo -> prepare($sql_categorias);
                $gsent->execute();
                $resultado = $gsent->fetchAll();
                foreach($resultado as $categoria): 
                                        ?>
              <div class="row mi-fila">
                <div class="col mi-columna"><?php echo $categoria['descripcion']; ?></div>
                <div class="col mi-columna"><?php echo $categoria['precio']; ?></div>
                <div class="col mi-columna"><?php echo $categoria['cantidad']; ?></div>
                <div class="col mi-columna">
                    <a href="index.php?id=<?php echo $categoria['id_inventario']; ?>" class="button">
                        <button type="button" class="btn btn-outline-dark">Agregar</button>
                    </a>
                </div>
                
              </div>
              <?php endforeach ?>
            </div>
          </div>



        

        <div class="container">
          <section style="margin-top: auto;">
            <p class = "ml-5 mt-5">Los mejores productos a los precios mas bajos</p>
            <button type="button" class="ml-5" style="left: 0;">
              <a href="agregar.php">Agregar producto</a>
            </button>
            <button type="button" class= "mr-5" style="right: 0;">
              <a href="eliminar.php">Eliminar producto</a>
            </button>
            </section>
        </div>
        
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="js/registro.js"></script>
  </body>
</html>