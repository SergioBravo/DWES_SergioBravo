<?php
  //Llamada a la vista para visualizar el formulario y poder recoger los datos
  require("vista/viewLogin.php");
  //Llamada al modelo de login para recoger las consultas necesarias a la bdd
  require_once("modelo/modelLogin.php");

  if ($_POST) {//Cuando pulsemos el botón Login
    //Abrimos la conexion
    $conn = abrirConexion();
    //LIMPIAMOS LOS DATOS
    $correo = test_input($_POST["email"]);
    $contraseña = test_input($_POST["password"]);
    //LOGICA DE NEGOCIO
    if (empty($correo) || empty($contraseña)) {//En caso de no pasarnos ningun dato sacamos un mensaje de error
      $error = 0;
      require ("vista/viewLogin.php");
    }
    else if (comprobarLogin($correo,$contraseña,$conn)) {//En caso de ser correctos creamos la sesion y redirigimos el usuario al controlador conInicio.php
      session_start();
      $_SESSION['dni'] = $_POST['password'];//Guardamos el dni ya que para realizar consultas nos sera el campo más util
      header("location: controlador/conInicio.php");
    }
    else {//En caso de fallar la autentificación mostramos un mensaje de error
      $error = 1;
      require ("vista/viewLogin.php");
    }
    //CERRAMOS LA CONEXION
    cerrarConexion($conn);
  }
 ?>
