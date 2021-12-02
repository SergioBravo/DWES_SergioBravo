<?php
/*Inserción en tabla - MySQLi Object-oriented*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO departamento (nombre_Departamento) VALUES ('RRHH')";

if ($conn->query($sql) === TRUE) {
    echo "Se ha creado un nuevo departamento";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
