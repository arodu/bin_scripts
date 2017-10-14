#!/usr/bin/php
<?php
  $result = file_get_contents("https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/");
  $data = json_decode($result, true);
  $value = $argv[1]*$data["VEF"]["avg_1h"];

  //var_dump($data["VEF"]);
  echo "Price last 1h: ".number_format( $data["VEF"]["avg_1h"], 2, ",", ".")."\n";
  echo "VEF: ".number_format( $value, 2, ",", ".")."\n";
?>
