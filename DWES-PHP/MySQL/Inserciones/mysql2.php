<?php
/*Inserción en tabla - MySQLi procedural*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO departamento (nombre_Departamento) VALUES ('Finanzas')";

if (mysqli_query($conn, $sql)) {//Comprobamos que se ejecute correctamente
    echo "Se ha creado un nuevo departamento";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
