#!/usr/bin/php
<?php
  date_default_timezone_set('America/Caracas');

  // argv[1]: monto
  // argv[2]: porcentaje paypal, porcentaje paypal 5.4 por defecto
  // argv[3]: comision paypal, 0.30 por defecto

  $monto = (isset($argv[1])?$argv[1]:0);
  $por = (isset($argv[2]) ? $argv[2] : 5.40)/100;
  $com = (isset($argv[3]) ? $argv[3] : 0.30);

  $enviar = ($com + $monto)/(1-$por);

  $calculo = ($monto*$por) + $com;

  echo "     Para recibir: $ ".round($monto,2)."\n";
  echo "La comision es de: $ ".round($enviar-$monto,2)."\n";
  echo "   Hay que enviar: $ ".round($enviar, 2)."\n";
  echo "-----------------------------------\n";
  echo "     Si se envian: $ ".round($monto,2)."\n";
  echo "La comision es de: $ ".round($calculo,2)."\n";
  echo "       Se reciben: $ ".round($monto-$calculo, 2)."\n";

?>
