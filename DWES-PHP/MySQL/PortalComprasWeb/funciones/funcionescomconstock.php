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

  function optionsProducto($conn) {
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

  function stockProducto($producto,$conn) {//Pasamos un producto y la conexión y comprobamos que cantidad hay del mismo en cada almacen
    try {
      $con = 0;
      $stock = array();
      $stmt = $conn->prepare("SELECT PRODUCTO.NOMBRE,ALMACEN.LOCALIDAD,ALMACENA.CANTIDAD FROM PRODUCTO,ALMACEN,ALMACENA
                              WHERE PRODUCTO.ID_PRODUCTO = ALMACENA.ID_PRODUCTO AND ALMACEN.NUM_ALMACEN = ALMACENA.NUM_ALMACEN
                              AND PRODUCTO.ID_PRODUCTO = '$producto'");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $stock[$con] = "Producto: ".$row['NOMBRE']."||Almacen: ".$row['LOCALIDAD']."||Cantidad: ".$row["CANTIDAD"];
          $con++;
       }
       return $stock;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
