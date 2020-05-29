

<?php include_once 'conexion_pdo.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Agregar Producto</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="css/registro.css" rel="stylesheet">
  </head>
  <body>

      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Producto</th>
              <th scope="col">Eliminar</th>
              <th scope="col">Editar</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $sql_categorias = 'select * from inventario';
      
            $gsent= $pdo -> prepare($sql_categorias);
            $gsent->execute();
            $resultado = $gsent->fetchAll();
            foreach($resultado as $categoria): 
                                            ?>
            <tr>
            <tr>
              <td> <?php echo $categoria['descripcion'];?></td>
              <td>
                  <a href="operacion_eliminar.php?id=<?php echo $categoria['id_inventario'];?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">X</a>
              </td>
              <td>
                  <a href="editar.php?id=<?php echo $categoria['id_inventario'];?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Editar</a>
              </td>
            </tr>
            <?php endforeach?>
          </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary btn-lg active mt-5" role="button" aria-pressed="true">Regresar</a>

      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
