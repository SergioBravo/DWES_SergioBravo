<?php
  include '../funciones/funcionescompro.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Compra de productos</title>
  </head>
  <body>
    <h1>Compra de productos</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>
      <select name="cliente">Cliente:
        <?php
          $optionsClie = optionsCliente($conn);
          $size = count($optionsClie);

          for ($i=0; $i < $size; $i+=2) {
            echo "<option value=".$optionsClie[$i].">".$optionsClie[$i+1]."</option>";
          }
         ?>
      </select>
    </p>
    <p>
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
    <p><input type=submit name=comprar value=Comprar></p>
    </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $cliente = test_input($_POST['cliente']);
    $producto = test_input($_POST['producto']);
    //Logica de negocio
    $almacen = sacarAlmacenDisponible($producto,$conn);

    if ($almacen = 0) {echo "<h2>NO HAY STOCK DE PRODUCTO<h2>";}
    else {
      ActualizarCompra($cliente,$producto,$conn);
    }
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
