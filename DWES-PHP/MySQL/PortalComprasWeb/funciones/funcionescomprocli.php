<?php
  function test_input($data) {//Limpiamos los datos que nos pasan
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function abrirConexion() {//Devolvemos la conexión con el servidor si ha sido posible realizarla si no mostramos un mensaje
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="comprasweb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function cerrarConexión($conn) {
    $conn = null;//Cerramos la conexión
  }

  function optionsProducto($conn) {//Sacamos todos los productos de la tabla producto y los devolvemos en un array
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT ID_PRODUCTO,NOMBRE FROM producto");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $options[$con] = $row["ID_PRODUCTO"];
          $con++;
          $options[$con] = $row["NOMBRE"];
          $con++;
       }
       return $options;
    }
    catch(PDOException $e) {
        echo mostrarErrores($e);
    }
  }

  function sacarNombreProducto($producto,$conn) {//Le pasamos un producto y buscamos su nombre en la tabla producto
    try {
      $stmt = $conn->prepare("SELECT NOMBRE FROM PRODUCTO WHERE ID_PRODUCTO = '$producto'");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $nombre = $row["NOMBRE"];
       }
       return $nombre;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function ActualizarCompra($cliente,$producto,$conn) {
    try {
      $stmt = $conn->prepare("INSERT INTO COMPRA (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES (:nif,:producto,:fecha,:unidades)");

      $stmt->bindParam(':nif', $cliente);
      $stmt->bindParam(':producto', $producto);
        $fecha = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
      $stmt->bindParam(':fecha', $fecha);
        $cantidad = 1;
      $stmt->bindParam(':unidades', $cantidad);

      $stmt->execute();

      comprarProducto($cliente,$producto,$conn);
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function comprarProducto($cliente,$producto,$conn) {//Pasamos un cliente, un producto y un almacen a usar y compramos dicho producto en caso de que haya stock
    try {//Intentamos realizar el update
      $almacen = sacarAlmacenDisponible($producto,$conn);
      $stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD = CANTIDAD - 1 WHERE ID_PRODUCTO = '$producto' AND NUM_ALMACEN = $almacen");

      $stmt->execute();

      echo "<h2>PRODUCTO COMPRADO<h2>";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }

  function comprobarStock($producto,$almacen,$conn) {
    try {
      $stock = 0;
      $stmt = $conn->prepare("SELECT ALMACENA.CANTIDAD FROM PRODUCTO,ALMACEN,ALMACENA
                              WHERE PRODUCTO.ID_PRODUCTO = ALMACENA.ID_PRODUCTO AND ALMACEN.NUM_ALMACEN = ALMACENA.NUM_ALMACEN
                              AND PRODUCTO.ID_PRODUCTO = '$producto' AND ALMACEN.NUM_ALMACEN=$almacen");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $stock = $row["CANTIDAD"];
       }
       return $stock;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function sacarAlmacenDisponible($producto,$conn) {//Comprobamos el stock que hay del producto en cada uno de los almacenes
    $numAlmacenes = verAlmacenes($conn);
    $queda = false;//Para comprobar si el almacen tiene stock
    for ($i=0; $i < $numAlmacenes && $queda == false; $i++) {//Comprobamos el stock del producto en cada uno de los almacenes y en caso de que tenga guardamos el almacen a usar
      $stock = comprobarStock($producto,($i*10),$conn);
      if ($stock > 0) {$queda = true;$almacen = ($i*10);}
    }

    if ($queda == false) {$almacen = 0;}

    return $almacen;
  }

  function verAlmacenes($conn) {//Sacamos el número de almacenes creados
    try {
      $stmt = $conn->prepare("SELECT COUNT(NUM_ALMACEN) AS CANTIDAD FROM ALMACEN");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $numero = $row["CANTIDAD"];
       }
       return $numero;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
