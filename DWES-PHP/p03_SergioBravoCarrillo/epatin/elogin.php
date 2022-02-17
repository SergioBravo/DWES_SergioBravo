<?php
  include "funcionesComunes/funcionesComunes.php";
  include "funciones/funcioneselogin.php";
  $conn = abrirConexion();

  if ($_POST) {//Cuando pulsemos el botón Login
    //LIMPIAMOS LOS DATOS
    $correo = test_input($_POST["email"]);
    $contraseña = test_input($_POST["password"]);
    //LOGICA DE NEGOCIO
    if (empty($correo) || empty($contraseña)) {//En caso de no pasarnos ningun dato sacamos un mensaje de error
      echo "<h1>Falta Usuario/Contraseña</h1>";
    }
    else if (comprobarLogin($correo,$contraseña,$conn)) {//En caso de ser correctos creamos la sesion y redirigimos el usuario a la pagina einicio.php
      session_start();
      $_SESSION['dni'] = $_POST['password'];//Guardamos el dni ya que para realizar consultas nos sera el campo más util
      header("location: einicio.php");
    }
    else {//En caso de fallar la autentificación mostramos un mensaje de error
      echo "<h2>Usuario/Contraseña incorrecto porfavor compruebe las credenciales</h2>";
    }
    //CERRAMOS LA CONEXION
    cerrarConexion($conn);
  }
 ?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>

<body>
    <h1>ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">

		<form id="" name="" action="" method="post" class="card-body">

		<div class="form-group">
			Email <input type="text" name="email" placeholder="email" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="password" placeholder="password" class="form-control">
        </div>

		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>

	    </div>
    </div>
    </div>
    </div>

</body>
</html>
