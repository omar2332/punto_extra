<?php
include_once 'conexion_pdo.php';
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
              <div class="form-group">
                <div>
                  <input type="text" placeholder="Descripcion" name = 'descripcion' class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div>
                  <input type="text" placeholder="Precio de venta" name = 'precio' class="form-control" required>
                </div>
              </div>
              
              <div>
                <div>
                  <input type="number" placeholder="Cantidad en almacen" name = 'cantidad' class="form-control" required>
                </div>
              </div>
              <div>
                <div>
                  <button type="submit">Enviar</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

      <h2 style = 'margin-top: 50px; text-align: center;'>  Productos</h2>
      <section id="tablaProductos" style = 'margin-top: 100px; margin-left:360px'>
      <table>

      
        <tr>
          <th>Producto(s)</th>
          <th>Precio</th>
          <th>Cantidad en almacen</th>
        </tr>
        <?php
        $sql_categorias = 'select * from inventario';
  
        $gsent= $pdo -> prepare($sql_categorias);
        $gsent->execute();
        $resultado = $gsent->fetchAll();
        foreach($resultado as $categoria): 
                                        ?>
        <tr>
          <td id="<?php echo $categoria['id_inventario']; ?>">
                <p><?php echo $categoria['descripcion']; ?></p>
          </td>
          <td ><?php echo $categoria['precio']; ?></td>
          <td ><?php echo $categoria['cantidad']; ?></td>
        </tr>

        <?php endforeach?>
      </table>
      </section>
      <section>

      <button type="button" style="margin-top:40px;position: absolute; right: 0; margin-right:60px; width:100px; height:40px">
          <a href="index.php">regresar</a>
      </button>
  </body>
</html>
