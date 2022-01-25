<?php
  session_start();
  include '../funciones/funcionescomprocli.php';
  //Abrimos la conexión
  $conn = abrirConexion();
  if(!isset($_SESSION['CARRITO'])) {//En caso de que no este creado el carrito creamos la variable de sesión
    $_SESSION['CARRITO'] = array();
    $carrito = $_SESSION['CARRITO'];
  }
  else {$carrito = $_SESSION['CARRITO'];}
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
    <p>Cantidad: <input type="number" name="cantidad" value="1" min="1"></p>
    <p><input type=submit name=añadir value="Añadir Producto"></p>
    <p><input type=submit name=borrar value="Borrar Cesta"></p>
    <p><input type=submit name=ver value="Ver Cesta"></p>
    <p><input type=submit name=comprar value=Comprar></p>
    </form>
    <p><a href="../funciones/comprobarLogin.php">Volver al menú de usuario</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $cliente = $_SESSION['NIF'];
    $producto = test_input($_POST['producto']);
    $cantidad = test_input($_POST['cantidad']);
    //Añadir y quitar del carrito
    if (!empty($_POST['añadir'])) {//En caso de que pulsen el botón añadir
      if (!comprobarCarrito($carrito,$producto)) {//Comprobamos que el producto no este en el carrito ya que no se puede comprar varias veces el mismo producto en el mismo dia
        $carrito[$producto] = $cantidad;
        echo "Producto <b>".sacarNombreProducto($producto,$conn)."</b> añadido / Consultelo su carrito";
      }
      else {
        echo "Ya se ha añadido ese producto al carrito";
      }
      $_SESSION['CARRITO'] = $carrito;
    }
    //Borrar Productos de la cesta
    if (!empty($_POST['borrar'])) {//Cuando se pulse le botón borrar quitamos todos los elementos del carrito
      $_SESSION['CARRITO'] = array();
      echo "El carrito se ha vaciado";
    }
    //Ver productos en la cesta
    if (!empty($_POST['ver'])) {//Cuando se pulse el botón ver visualizamos todo el carrito del usuario
      echo "<h2>Carrito de ". $_SESSION['nombre']."</h2>";
      verCarrito($carrito,$conn);
    }
    //Comprar Productos
    if (!empty($_POST['comprar'])) {//Cuando se pulse el botón comprar comprobamos que haya producto en el carrito y stock y en caso afirmativo compramos los productos que le usuario tenga en el carrito
      if (empty($carrito)) {echo "No hay productos en el carrito";}
      else {
        $size = count($carrito);

        foreach ($carrito as $producto => $numero) {
          $almacen = sacarAlmacenDisponible($producto,$conn);
          if ($almacen == 0) {echo "<h2>NO HAY STOCK DE PRODUCTO: ".sacarNombreProducto($producto,$conn)."<h2>";}
          else {
            comprarProducto($cliente,$producto,$numero,$conn);
          }
        }
        echo "<h2>Se han realizado las gestiones</h2>";
        $_SESSION['CARRITO'] = array();
      }
    }
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
