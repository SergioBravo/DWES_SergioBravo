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

  function verEmpleadosFecha($fecha,$conn) {//Le pasamos una fecha y nos devuelve un array de mensajes donde nos dice que empleados ha habido en ese departamento antes de esa fecha
    try {
      $con = 0;
      $mensajes = array();
      $fecha = $fecha." 00:00:00";

      $stmt = $conn->prepare("SELECT DISTINCT nombre,nombre_dpto FROM empleado,departamento,emple_depart
        WHERE empleado.dni = emple_depart.dni AND departamento.cod_dpto = emple_depart.cod_dpto
        AND '$fecha' BETWEEN fecha_ini AND fecha_fin");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $mensajes[$con] = "Departamento: ".$row['nombre_dpto']."||Empleado: ".$row['nombre'];
          $con++;
       }
       return $mensajes;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
