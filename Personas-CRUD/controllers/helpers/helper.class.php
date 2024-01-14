<?php

class Helper
{
  public function limpiarParametro($string)
  {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $string;
  }

  public function validarDecimal($string)
  {
    //00.00
    $valido = false;
    if (preg_match('/^[0-9]\d{1,6}(\.\d{1,2})?$/', $string)) {
      $valido = true;
    }
    return $valido;
  }

  public function validarTelefono($string)
  {
    //0000-0000
    $valido = false;
    if (preg_match('/^\([0-9]{3}\) [0-9]{4}[0-9]{4}$/', $string)) {
      $valido = true;
    }else{
      $valido = false;
    }
    return $valido;
  }

  public function validarDui($string)
  {
    //00000000-0
    $valido = false;
    if (preg_match('/^([0-9]{8})[-][0-9]{1}$/', $string)) {
      $valido = true;
    }
    return $valido;
  }

}





