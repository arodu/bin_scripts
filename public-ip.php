#!/usr/bin/php
<?php

  $public_ip = exec("curl -s ipinfo.io/ip");
  echo $public_ip."\n";
  
?>
