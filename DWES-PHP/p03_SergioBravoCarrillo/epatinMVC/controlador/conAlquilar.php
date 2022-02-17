<?php
  //Llamamos al fichero que nos conecta a la base de datos
  require_once("../db/db.php");
  session_start();
  //Llamamos al modelo para mostrar los datos del cliente
  require_once "../modelo/modelDatosCliente.php";
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);
  $_SESSION['fecha'] = date('Y-m-d h:i:s', time());

  if(!isset($_SESSION['carrito'])) {//En caso de que no este creado el carrito creamos la variable de sesión
    $_SESSION['carrito'] = array();
    $carrito = $_SESSION['carrito'];
  }
  else {$carrito = $_SESSION['carrito'];}
  //Llamamos al modelo modelAlquilar
  require_once "../modelo/modelAlquilar.php";
  //Guardamos estas variables para poder mostrar los patines disponibles
  $optionsPatines = optionsPatines($conn);
  $sizeoptionsPatines = count($optionsPatines);

  //Llamada a la vista para visualizar el formulario
  require("../vista/viewAlquilar.php");
  //Llamada a las funciones externas del controlador para distintas comprobaciones
  require_once("funciones/funcionesConAlquilar.php");

  if ($_POST) {//Cuando se realize cualquier submitt del formulario
    //LOGICA DE NEGOCIO
    //--------------Agregar al carrito---------------------------
    if (!empty($_POST['agregar'])) {
      if (empty($_POST['patinetes'])) {
        $error = 1;
        require("../vista/viewAlquilar.php");
      }
      else if (!comprobarCarrito($carrito,$_POST['patinetes'])) {//Comprobamos que el patin no se haya agregado ya al carrito
        //LIMPIAMOS LOS DATOS
        $patin = test_input($_POST['patinetes']);
        //PROGRAMA
        array_push($carrito,$patin);
        $mensajes = 1;
        actualizarDisponible($patin,$conn,"N");
        require("../vista/viewAlquilar.php");
      }
      else {
        $error = 2;
        require("../vista/viewAlquilar.php");
      }
      $_SESSION['carrito'] = $carrito;
    }
    //--------------Alquilar patines---------------------------------
    if (!empty($_POST['alquilar'])) {
      if (count($carrito) == 0) {//En caso de no haber productos en el carrito
        $error = 3;
        require("../vista/viewAlquilar.php");
      }
      else if ($datosCliente[2] <= 10) {//En caso de tener menos de 10€ en la cuenta no puede alquilar
        $error = 4;
        require("../vista/viewAlquilar.php");
      }
      else {
        $size = count($carrito);
        for ($i=0; $i < $size; $i++) {//Alquilamos cada uno de los patines
          alquilarPatin($_SESSION['dni'],$carrito[$i],$_SESSION['fecha'],$conn);
        }
        $mensajes = 2;
        require("../vista/viewAlquilar.php");
        $_SESSION['carrito'] = array();
      }
    }
    //---------------Vaciar el carrito--------------------------------------
    if (!empty($_POST['vaciar'])) {
      $size = count($carrito);
      for ($i=0; $i < $size; $i++) {//Volvemos a dejar disponibles todos los productos del carrito
        actualizarDisponible($carrito[$i],$conn,"S");
      }
      $_SESSION['carrito'] = array();
      $mensajes = 3;
      require("../vista/viewAlquilar.php");
    }
    //-----------Volver------------------------
    if (!empty($_POST["volver"])) {//Volvemos al menu de usuario
      header("location: conInicio.php");
    }
  }
 ?>
