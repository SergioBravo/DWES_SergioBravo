<?php
  session_start();
  include '../funciones/funcionescomprocli.php';
  //Abrimos la conexión
  $conn = abrirConexion();
  $carrito = $_SESSION['CARRITO'];
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Compra de productos</title>
  </head>
  <body>
    <h1>Compra de productos</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <?php
      echo "<h2>Sesión iniciada: ".$_SESSION['nombre']."</h2>";
    ?>
    <p>Producto:
      <select name="producto">Producto:
        <?php
          $optionsPro = optionsProducto($conn);
          $size = count($optionsPro);

          for ($i=0; $i < $size; $i+=2) {
            echo "<option value=".$optionsPro[$i].">".$optionsPro[$i+1]."</option>";
          }
         ?>
      </select>
    </p>
    <p>Cesta:
      <select name="cesta">
        <?php
        $size = count($carrito);

        for ($i=0; $i < $size; $i++) {
          echo "<option value=".$carrito[$i].">".sacarNombreProducto($carrito[$i],$conn)."</option>";
        }
         ?>
      </select>
    </p>
    <p><input type=submit name=añadir value="Añadir Producto"></p>
    <p><input type=submit name=borrar value="Borrar Cesta"></p>
    <p><input type=submit name=comprar value=Comprar></p>
    </form>
    <p><a href="../php/comlogincli.php">Volver a pagina de login</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $cliente = $_SESSION['NIF'];
    $producto = test_input($_POST['producto']);
    //Añadir y quitar del carrito
    if (!empty($_POST['añadir'])) {//En caso de que pulsen el botón añadir
      array_push($carrito, $producto);
      echo "Producto añadido al carrito / Consultelo en el desplegable";
      $_SESSION['CARRITO'] = $carrito;
    }
    //Borrar Productos de la cesta
    if (!empty($_POST['borrar'])) {//En caso de que pulsen el botón añadir
      $carrito = [];
      echo "La cesta se ha vaciado";
      $_SESSION['CARRITO'] = $carrito;
    }
    //Comprar Productos
    if (!empty($_POST['comprar'])) {//En caso de que pulsen el botón comprar
      if (empty($carrito)) {echo "No hay productos en el carrito";}
      else {
        $size = count($carrito);

        for ($i=0; $i < $size; $i++) {
          $almacen = sacarAlmacenDisponible($carrito[$i],$conn);
          if ($almacen = 0) {echo "<h2>NO HAY STOCK DE PRODUCTO: ".sacarNombreProducto($carrito[$i],$conn)."<h2>";}
          else {
            ActualizarCompra($cliente,$producto,$conn);
          }
        }
      }
    }
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
