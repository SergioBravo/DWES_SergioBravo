<?php
  //Llamamos al fichero que nos conecta a la base de datos
  require_once("../db/db.php");
  session_start();
  //Llamamos al modelo para mostrar los datos del cliente
  require_once "../modelo/modelDatosCliente.php";
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);

  require "../vista/viewConsultar.php";
  require_once "../modelo/modelConsultar.php";

  if ($_POST) {//Cuando hagamos un submit del formulario
    //-----------Consultar------------------------
    if (!empty($_POST["consultar"])) {
      //LIMPIAMOS LOS PARAMETROS
      $inicio = test_input($_POST['fechadesde']);
      $fin = test_input($_POST['fechahasta']);
      $consultar = ConsultarPatines($_SESSION['dni'],$inicio,$fin,$conn);
      $size = count($consultar);
      //LOGICA DEL PROGRAMA
      if (empty($_POST['fechadesde']) || empty($_POST['fechahasta'])) {
        $error = 1;
        require "../vista/viewConsultar.php";
      }
      else if ($size == 0) {
        $error = 2;
        require "../vista/viewConsultar.php";
      }
      else {
        $crearTabla = true;
        require "../vista/viewConsultar.php";
      }//Cierre del else
    }
    //------------Volver---------------------
    if (!empty($_POST["Volver"])) {
      header("location: conInicio.php");
    }
    //CERRAMOS LA CONEXIÓN
    cerrarConexion($conn);
  }
?>
