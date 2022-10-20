#!/usr/bin/php
<?php
  date_default_timezone_set('America/Caracas');

  // argv[1]: tiempo guardado en minutos
  // argv[2]: pago por hora (default: 2.75)

  $time = eval('return '.(isset($argv[1])?$argv[1]:0).';');
  $ph = (isset($argv[2]) ? $argv[2] : 2.75);

  $p = round(($time/60)*$ph, 2);
  $p20 = round($p*0.2, 2);
  $p10 = round($p*0.1, 2);

  echo "Monto\t\t$ ".round($p,2)."\n";
  echo "  +10%\t".round($p10, 2)."\t$ ".round($p10+$p, 2)."\n";
  echo "  +20%\t".round($p20, 2)."\t$ ".round($p20+$p, 2)."\n";

?>
