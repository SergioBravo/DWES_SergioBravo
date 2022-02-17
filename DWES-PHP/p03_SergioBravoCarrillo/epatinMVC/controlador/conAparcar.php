<?php
  //Llamamos al fichero que nos conecta a la base de datos
  require_once("../db/db.php");
  session_start();
  //Llamamos al modelo para mostrar los datos del cliente
  require_once "../modelo/modelDatosCliente.php";
  $conn = abrirConexion();
  $carrito = $_SESSION['carrito'];
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);

  require "../vista/viewAparcar.php";
  require_once "../modelo/modelAparcar.php";

  if ($_POST) {//Cuando hagamos un submit del formulario
    //-----------Devolver------------------------
    if (!empty($_POST["devolver"])) {
      //LOGICA DE NEGOCIO
      if (empty($_POST['patinetes']) || count($carrito) == 0) {
        $error = true;
        require "../vista/viewAparcar.php";
      }
      else {
        //LIMPIAMOS LOS DATOS
        $patin = test_input($_POST['patinetes']);
        //PROGRAMA
        devolverPatin($_SESSION['dni'],$patin,$_SESSION['fecha'],$conn);
        actualizarDisponible($carrito[array_search($patin,$carrito)],$conn,"S");
        array_splice($carrito,array_search($patin,$carrito),1);
        $mensaje = true;
        require "../vista/viewAparcar.php";
      }
      $_SESSION['carrito'] = $carrito;
    }
    //------------Volver---------------------
    if (!empty($_POST["volver"])) {
      header("location: conInicio.php");
    }
    //CERRAMOS LA CONEXIÓN
    cerrarConexion($conn);
  }
 ?>
