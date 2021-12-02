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
    $dbname="empleadosnn";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function cerrarConexion($conn) {$conn = null;}//Cerramos la conexión

  function optionsEmpleado($conn) {//Nos devuelve los nombres y dni de los empleados para crear luego las options
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT dni,nombre FROM empleado");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $datos[$con] = $row["dni"]." ".$row["nombre"];
          $con++;
       }
       return $datos;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function cambiarSalario($empleado,$salario,$conn) {
    try {
      $empleado = "\"".$empleado."\"";
      $mensaje = "El empleado ".verEmpleado($empleado,$conn)." ha pasado de tener ".verSalario($empleado,$conn)."€ a ";

      if ($salario[0] == "-") {
        $salario = floatval("0.".substr($salario,1,strlen($salario)));
        $stmt = $conn->prepare("UPDATE empleado SET salario = salario - (salario*$salario) WHERE dni = $empleado");
        $stmt->execute();//Ejecutamos el update

        $mensaje .= verSalario($empleado,$conn)."€";
      }
      else {
        if ($salario[0] == "+") {$salario = floatval("1.".substr($salario,1,strlen($salario)));}
        else {$salario = floatval("1.".$salario);}
        $stmt = $conn->prepare("UPDATE empleado SET salario = salario*$salario WHERE dni = $empleado");
        $stmt->execute();//Ejecutamos el update

        $mensaje .= verSalario($empleado,$conn)."€";
      }

      echo $mensaje;
    }
    catch (PDOException $e) {//En caso de fallar el Update mostramos el mensaje de error
      echo "Error: ".$e->getMessage();
    }
  }

  function verSalario($empleado,$conn) {
    $stmt = $conn->prepare("SELECT salario FROM empleado WHERE dni = $empleado");
    $stmt->execute();

    //Guardamos los resultados en un array asociativo
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
      foreach($stmt->fetchAll() as $row) {
        $salario = $row["salario"];
      }

     return $salario;
  }

  function verEmpleado($empleado,$conn) {
    $stmt = $conn->prepare("SELECT nombre FROM empleado WHERE dni = $empleado");
    $stmt->execute();

    //Guardamos los resultados en un array asociativo
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
      foreach($stmt->fetchAll() as $row) {
        $empleado = $row["nombre"];
      }

     return $empleado;
  }
 ?>
