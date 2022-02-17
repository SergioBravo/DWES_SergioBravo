<?php
  //Llamamos al fichero que nos conecta a la base de datos
  require_once("../db/db.php");
  session_start();
  //Llamamos al modelo para mostrar los datos del cliente
  require_once "../modelo/modelDatosCliente.php";
  require_once "../modelo/modelAparcar.php";
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);
  $alquilados = sacarAlquilados($_SESSION['dni'],$conn);
  $sizeAlquilados = count($alquilados);

  require "../vista/viewAparcar.php";

  if ($_POST) {//Cuando hagamos un submit del formulario
    //-----------Devolver------------------------
    if (!empty($_POST["devolver"])) {
      //LOGICA DE NEGOCIO
      if (empty($_POST['patinetes']) || $sizeAlquilados == 0) {
        $error = true;
        require "../vista/viewAparcar.php";
      }
      else {
        //LIMPIAMOS LOS DATOS
        $patin = test_input($_POST['patinetes']);
        //PROGRAMA
        devolverPatin($_SESSION['dni'],$patin,$_SESSION['fecha'],$conn);
        actualizarDisponible($alquilados[array_search($patin,$alquilados)],$conn,"S");
        array_splice($alquilados,array_search($patin,$alquilados),1);
        $mensaje = true;
        require "../vista/viewAparcar.php";
      }
    }
    //------------Volver---------------------
    if (!empty($_POST["volver"])) {
      header("location: conInicio.php");
    }
    //CERRAMOS LA CONEXIÓN
    cerrarConexion($conn);
  }
 ?>
