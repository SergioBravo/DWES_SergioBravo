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

  function altaCliente($nif,$nombre,$apellido,$cp,$direccion,$ciudad,$conn) {//Pasamos los datos de un cliente y creamos una nueva fila en la tabla cliente
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO cliente (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD,CLAVE) VALUES (:nif,:nombre,:apellido,:cp,:direccion,:ciudad,:clave)");

      $stmt->bindParam(':nif', $nif);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':apellido', $apellido);
      $stmt->bindParam(':cp', $cp);
      $stmt->bindParam(':direccion', $direccion);
      $stmt->bindParam(':ciudad', $ciudad);
        $clave = strrev(strtolower($apellido));
      $stmt->bindParam(':clave', $clave);
      $stmt->execute();//Ejecutamos el insert

      echo "Cliente $nombre creado";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      $mensaje = controlErrores($e);
      echo $mensaje;
    }
  }

  function controlErrores($e) {
    $mensaje = "Error: ";
    if ($e->getCode() == 23000) {
      $mensaje .= "NIF de cliente duplicado";
    } else {
      $mensaje .= $e->getMessage();
    }

    return $mensaje;
  }
 ?>
