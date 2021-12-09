<?php
  function test_input($data) {//Limpiamos los datos que nos pasan
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function abrirConexion() {//Devolvemos la conexión con el servidor si ha sido posible realizarla
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="empleados1n";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
      return $conn;
    }
  }

  function altaDepartamento($campo) {//Le pasamos el nombre del departamento y lo metemos en la tabla departamento
    $conn = abrirConexion();
    $stmt = mysqli_prepare($conn, "INSERT INTO departamento (nombre_Departamento) VALUES (?)");
    mysqli_stmt_bind_param($stmt, 's', $campo);

    mysqli_stmt_execute($stmt);

    printf("Departamento $campo Insertado.\n", mysqli_stmt_affected_rows($stmt));

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
?>
