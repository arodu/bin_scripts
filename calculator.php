#!/usr/bin/env php
<?php
session_id('mhh2i409cdadq9dg3rdqir3hsl');
session_start();

$comm = array_shift($argv); // remote first element
$exp  = implode($argv); 

echo "= ".eval_expretion($exp)."\n";

// - being: functions
  function eval_expretion($exp){
    $exp = load_memory($exp);
    $out = eval("return ".$exp.";");
    save_memory($out);
    return $out;
  }


  function load_memory($exp){
    if(isset($_SESSION['m'])){
      $exp = str_replace("m", $_SESSION['m'], $exp);
    }
    return $exp;
  }

  function save_memory($data){
    $_SESSION['m'] = $data;
  }
// - end: functions
?>
