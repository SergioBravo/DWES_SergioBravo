<?php
  function comprobarCarrito($carrito,$patin) {//Le pasamos el array del carrtio y el producto y comprobamos que no este dentro devolviendo un boolean
    $comprado = false;
    $size = count($carrito);
    for ($i=0; $i < $size && $comprado == false; $i++) {//Comprobamos todo el carrito
      if ($carrito[$i] == $patin) {$comprado = true;}
    }
    return $comprado;
  }
 ?>
