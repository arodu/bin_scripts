#!/usr/bin/php
<?php
  $result = file_get_contents("https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/");
  $localbitcoins = json_decode($result, true);
	$result = file_get_contents("https://api.coinmarketcap.com/v1/ticker/bitcoin/");
  $coinmarketcap = json_decode($result, true);
	//$result = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
  //$dolartoday = json_decode($result, true);

  $value = $argv[1]*$localbitcoins["VEF"]["avg_1h"];

  //var_dump($dolartoday);
	echo "BTC = $ ".$coinmarketcap[0]["price_usd"]."\n";
	//echo "USD = Bs. ".$dolartoday["USD"]["dolartoday"]."\n";
  echo "BTC = Bs. ".number_format( $localbitcoins["VEF"]["avg_1h"], 2, ",", ".")."\n";
	echo "-------------------------\n";
  echo "Bs. ".number_format( $value, 2, ",", ".")."\n";
?>
