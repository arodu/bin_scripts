#!/usr/bin/php
<?php
  date_default_timezone_set('America/Caracas');

  // argv[1]: tiempo guardado en minutos
  // argv[2]: dias a calcular, o dias del mes, por defecto 1
  // argv[3]: horas por dia, por defecto 8

  $time = eval('return '.$argv[1].';');
  $days = (isset($argv[2]) ? $argv[2] : 1);
  $hpd = (isset($argv[3]) ? $argv[3] : 8);

  $time_left = ($days*$hpd*60)-$time;
  $h = (int)($time_left/60);
  $m = $time_left - ($h*60);

  echo "Time Left: ".$h."h ".$m."m\n";  
  // ---------------------
  $estimate = date("h:ia", time()+($time_left*60));
  echo "Estimate: ".$estimate."\n";
?>
