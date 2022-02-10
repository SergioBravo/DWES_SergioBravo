<?php
  session_unset();
  session_destroy();
  setcookie("PHPSESSID",'',time() - 3600);
  header("location: ../elogin.php");
 ?>
