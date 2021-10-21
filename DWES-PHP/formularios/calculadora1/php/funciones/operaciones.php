<?php
  function Suma($op1,$op2) {
    return $op1+$op2;
  }

  function Resta($op1,$op2) {
    return $op1-$op2;
  }

  function Producto($op1,$op2) {
    return $op1*$op2;
  }

  function Division($op1,$op2) {
    if ($op2 == 0) {return -1;}
    else {
      return $op1/$op2;
    }
  }
 ?>
