#!/usr/bin/php
<?php
  //date_default_timezone_set('America/Caracas');
  
  
  $currency_value = mb_strtoupper($argv[1]);
  $value = isset($argv[2]) ? floatval($argv[2]) : 1;
  $currency_base = isset($argv[3]) ? mb_strtoupper($argv[3]) : "USD";

  $uphold_result = json_decode(utf8_decode(file_get_contents("https://api.uphold.com/v0/ticker/" . $currency_value.'-'.$currency_base, true)), true);

  $price = $uphold_result['bid'];

  echo "= ".$currency_base." ".number_format($price*$value, 2,',','.')."\t\t".$currency_base." ".number_format($price*$value, 2,'.','')."\n";


  /*
  var_dump([
    //$currency_value,
    //$value,
    //$currency_base,
    //$uphold_result,
    ,
  ]);
  */
  


  


?>