<?php
  session_unset();
  session_destroy();
  setcookie("PHPSESSID",'',time() - 3600000);
  header("location: ../php/comlogincli.php");
?>
