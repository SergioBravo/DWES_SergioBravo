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

  function optionsAlmacen($conn) {
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD FROM almacen");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $options[$con] = $row["NUM_ALMACEN"];
          $con++;
          $options[$con] = $row["LOCALIDAD"];
          $con++;
       }
       return $options;
    }
    catch(PDOException $e) {
        echo mostrarErrores($e);
    }
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

  function asignarProductosAlmacen($almacen,$producto,$cantidad,$conn) {//Pasamos un almacen, un producto, una cantidad del producto y la conexion para asignarlo a almacena
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO almacena (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) VALUES (:almacen,:producto,:cantidad)");

      $stmt->bindParam(':almacen', $almacen);
      $stmt->bindParam(':producto', $producto);
      $cantidad = intval($cantidad);
      $stmt->bindParam(':cantidad', $cantidad);
      $stmt->execute();//Ejecutamos el insert
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }
 ?>
