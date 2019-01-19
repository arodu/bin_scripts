#!/usr/bin/php
<?php
  date_default_timezone_set('America/Caracas');

  // argv[1]: tiempo guardado en minutos, o en formato HH:MM
  // argv[2]: dias a calcular, o dias del mes, por defecto 1
  // argv[3]: horas por dia, por defecto 8

  if(!empty($argv[1]) && preg_match("/[0-9]*[0-9]+:[0-5]+[0-9]+/", $argv[1])){
    list($ht, $mt) = explode(":", $argv[1]);
    $time = ($ht*60)+$mt;
  }elseif(!empty($argv[1]) && strpos($argv[1], ':')){
    echo "Syntax error! is not a valid time format [".$argv[1]."]\n";
    exit();
  }else{
    $time = eval('return '.(isset($argv[1])?$argv[1]:0).';');
  }

  $days = (isset($argv[2]) ? $argv[2] : 1);
  $hpd = (isset($argv[3]) ? $argv[3] : 8);

  $time_left = ($days*$hpd*60)-$time;
  $h = (int)($time_left/60);
  $m = round($time_left - ($h*60));

  echo "Time Left: ".$h."h ".$m."m\n";
  // ---------------------
  $estimate = date("h:ia", time()+($time_left*60));
  echo "Estimate: ".$estimate."\n";
?>
