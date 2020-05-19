<?php
include_once 'conexion_pdo.php';
if($_POST){
    $nombre = $_POST['descripcion'];
    $precio_venta = $_POST['precio'];
    $cantidad= $_POST['cantidad'];

    $sql_agregar = 'update inventario  set descripcion = ?,precio = ?,cantidad=? where id_inventario = ?';
    $sentencia = $pdo -> prepare($sql_agregar);
    $sentencia-> execute(array($nombre,$precio_venta,$cantidad,$_GET['id']));
    header('location: eliminar.php');
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Agregar Producto</title>
    <link href="css/registro.css" rel="stylesheet">
    <link href="css/tabla.css" rel="stylesheet">
  </head>
  <body>
    <div style= "size: 75%;">
        <div>
          <form class="form-horizontal" method="POST">
            <fieldset>
              <legend class="text-center header">Agregar Producto</legend>
              <?php
                    $sql_categorias = 'select * from inventario where id_inventario = '.$_GET['id'];
                   
                    $gsent= $pdo -> prepare($sql_categorias);
                    $gsent->execute();
                    $resultado = $gsent->fetchAll();
                    foreach($resultado as $categoria):
                     ?>
                    
              <div class="form-group">
              
                <div>
                  <input type="text"  name = 'descripcion' class="form-control" value="<?php echo $categoria['descripcion'];?>" required>
                </div>
              </div>
              <div class="form-group">
                <div>
                  <input type="text"  name = 'precio' class="form-control" value="<?php echo $categoria['precio'];?>" required>
                </div>
              </div>
              
              <div>
                <div>
                  <input type="number"  name = 'cantidad' class="form-control" value="<?php echo $categoria['cantidad'];?>" required>
                </div>
              </div>
              <div>
                  <?php endforeach ?>
                <div>
                  <button type="submit">Enviar</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

      <button type="button" style="margin-top:40px;position: absolute; right: 0; margin-right:60px; width:100px; height:40px">
          <a href="index.php">regresar</a>
      </button>
  </body>
</html>
