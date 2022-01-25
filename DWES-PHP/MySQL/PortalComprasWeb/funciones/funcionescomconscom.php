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

  function optionsCliente($conn) {
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT NIF,NOMBRE FROM cliente");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $options[$con] = $row["NIF"];
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

  function verProductos($cliente,$inicio,$fin,$conn,&$total) {
    try {
      $con = 0;
      $mensaje = array();

      $stmt = $conn->prepare("SELECT CLIENTE.NOMBRE AS CLIENTE,PRODUCTO.NOMBRE AS PRODUCTO,PRODUCTO.PRECIO,COMPRA.FECHA_COMPRA FROM CLIENTE,PRODUCTO,COMPRA
        WHERE CLIENTE.NIF = COMPRA.NIF AND PRODUCTO.ID_PRODUCTO = COMPRA.ID_PRODUCTO
        AND CLIENTE.NIF = '$cliente' AND COMPRA.FECHA_COMPRA >= '$inicio' AND COMPRA.FECHA_COMPRA <= '$fin'");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $mensaje[$con] = "Cliente: ".$row['CLIENTE']." || Producto: ".$row['PRODUCTO']." || Precio: ".$row['PRECIO']."€ ||FechaCompra ".$row['FECHA_COMPRA'];
          $con++;
          $total += $row['PRECIO'];
       }
       return $mensaje;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
