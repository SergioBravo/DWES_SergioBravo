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

  function stockAlmacen($almacen,$conn) {//Pasamos un almacen y comprobamos cuantos productos tiene el mimso
    try {
      $con = 0;
      $stock = array();
      $stmt = $conn->prepare("SELECT ALMACEN.LOCALIDAD,PRODUCTO.NOMBRE,ALMACENA.CANTIDAD FROM ALMACEN,PRODUCTO,ALMACENA
                              WHERE PRODUCTO.ID_PRODUCTO = ALMACENA.ID_PRODUCTO AND ALMACEN.NUM_ALMACEN = ALMACENA.NUM_ALMACEN
                              AND ALMACEN.NUM_ALMACEN = '$almacen';");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $stock[$con] = "Almacen: ".$row['LOCALIDAD']."||Producto: ".$row['NOMBRE']."||Cantidad: ".$row["CANTIDAD"];
          $con++;
       }
       return $stock;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
