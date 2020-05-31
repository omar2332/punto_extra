
<?php include_once 'conexion_pdo.php';?>


<?php

if($_POST){
  $nombre = $_POST['descripcion'];
  $precio_venta = $_POST['precio'];
  $cantidad= $_POST['cantidad'];

  $sql_agregar = 'insert into inventario(descripcion,precio,cantidad) values (?,?,?)';
  $sentencia = $pdo -> prepare($sql_agregar);
  $sentencia-> execute(array($nombre,$precio_venta,$cantidad));
  header('location: agregar.php');
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tienda de abarrotes</title>

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
                $sql_categorias1 = 'SELECT i.descripcion, i.precio, iv.cantidad, iv.cantidad_venta, iv.total, iv.id_inventario_venta FROM inventario i,
                 inventario_venta iv, venta v WHERE i.id_inventario = iv.id_inventario AND iv.id_venta = v.id_venta AND v.finalizado = 0 ';

                $gsent= $pdo -> prepare($sql_categorias1);
                $gsent->execute();
                $resultado = $gsent->fetchAll();
                foreach($resultado as $categoria ): 
                                        ?>
        <tbody>
              <td> <?php echo $categoria['descripcion']; ?> </td>
              <td> <?php echo $categoria['precio']; ?> </td>
              <td> <?php echo $categoria['cantidad_venta']; ?> </td>
              <td> <?php echo $categoria['cantidad']; ?> </td>
              <td> <?php echo $categoria['total']; ?> </td>
              <td>
                <a href="operacion_eliminar_venta.php?id=<?php echo $categoria['id_inventario_venta'];?>" class="button">
                  <button type="button" class="btn btn-light">Eliminar</button>
                </a>
              </td>
            </tr>            
        </tbody>
        <?php endforeach ?>
      </table>
      </section>
    </div>

      <div class="container mb-5 mt-5">
        <form action="accion.php" method="POST" onsubmit="return validar();">
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
            <button type="button" class="mt-5" style="">
              <a href="empezar_venta.php">Nueva compra/Finalizar compra</a>
            </button>
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
