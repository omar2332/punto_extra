
<?php include_once 'conexion_pdo.php';
session_start();
$sql_categorias = 'select count(id_venta) as maxGroup from venta';
  
$gsent= $pdo -> prepare($sql_categorias);
$gsent->execute();
$test = $gsent->fetch(PDO::FETCH_ASSOC);

$_SESSION['id'] = $test['maxGroup'] +1; 
$_SESSION['posc'] = 0;




if($_POST){
  
    $sql_categorias = 'select * from inventario where descripcion = "'.$_POST['producto'].'"';        
    $gsent= $pdo -> prepare($sql_categorias);
    $gsent->execute();
    $result = $gsent->fetchAll();
    
    foreach ($result as $row) {
      $_SESSION[$_SESSION['posc'] ] = array($row['id_inventario'],$row['descripcion'],$row['precio'], $_POST['cantidad'], ( (int)$_POST['cantidad'] )*( (int)$row['precio'] )    );
      $_SESSION['posc'] = $_SESSION['posc'] +1;

    }
}

?>

<?php

    $sql_categorias = 'select * from inventario';
              
    $gsent= $pdo -> prepare($sql_categorias);
    $gsent->execute();
    $result = $gsent->fetchAll();
    $array = array();
    foreach($result as $row){
        
        $equipo = utf8_encode($row['descripcion']);
        array_push($array, $equipo); // equipos

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
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
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

          <?php for ($i=0; $i < $_SESSION['posc']; $i++): 
           ?>
          
           <?php if(isset($_SESSION[$i])): ?>
          <tr>
            <th scope="row"> <?php echo $_SESSION[$i][0]; ?></th>
            <td><?php echo $_SESSION[$i][1]; ?></td>
            <td><?php echo $_SESSION[$i][2]; ?></td>
            <td><?php echo $_SESSION[$i][3]; ?></td>
            <td><?php echo $_SESSION[$i][4]; ?> </td>
            <td>
              <a href="" class="button">
                  <button type="button" class="btn btn-light">Eliminar</button>
              </a>
            </td>
          </tr>
          <?php endif ?>
          <?php endfor?>


        </tbody>
        <?php endforeach ?>
      </table>
      </section>
    </div>

      <div class="container mb-5 mt-5">
        <form  method="POST">
          <div class="form-group">
            <label >Producto</label>
            <?php var_dump($_SESSION)  ?>
            <input type="text" class="form-control" id="tag" name = "producto"  placeholder="Escriba el producto"  <?php if(isset($_GET['id'])){
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
            <input type="number" class="form-control" name="cantidad" placeholder="Escriba el cantidad" required>
          
          </div>
          
          <button type="submit" class="btn btn-primary">Agregar</button>
  
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
    <script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
	  
    <script type="text/javascript" src="js/jquery-ui.js"></script>  
    
    <script type="text/javascript">
		$(document).ready(function () {
			var items = <?= json_encode($array); ?>

			$("#tag").autocomplete({
				source: items,
				select: function (event, item) {
					var params = {
						equipo: item.item.value
					};
				}
			});
		});
	</script>              
 
  </body>
</html>
