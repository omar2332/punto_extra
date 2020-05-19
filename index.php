
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
            <th scope="col">#</th>
            <th scope="col">Producto(s)</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad en almacen</th>
            <th scope="col">Total</th>
            <th scope="col">X</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Galletas Emperador</td>
            <td>$27.50</td>
            <td>15</td>
            <td>15</td>
            <td>
              <a href="" class="button">
                  <button type="button" class="btn btn-light">Eliminar</button>
              </a>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Gansito</td>
            <td>$7.50</td>
            <td>25</td>
            <td>15</td>
            <td>
                <a href="" class="button">
                    <button type="button" class="btn btn-light">Eliminar</button>
                </a>
            </td>
          </tr>
        </tbody>
      </table>
      </section>
    </div>

      <div class="container mb-5 mt-5">
        <form action="" method="post">
          <div class="form-group">
            <label >Producto</label>
            <input type="text" class="form-control" id="producto"  placeholder="Escriba el producto"  <?php if(isset($_GET['id'])){
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
            <input type="number" class="form-control" id="cantidad" placeholder="Escriba el cantidad">
          
          </div>
          
          <button type="agregar" class="btn btn-primary">Agregar</button>
  
        </form>
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
                        <button type="button" class="btn btn-outline-dark">Dark</button>
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
  </body>
</html>
