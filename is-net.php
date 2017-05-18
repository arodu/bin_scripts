#!/usr/bin/php
<?php

  $out = exec("ping -q -w 1 -c 1 8.8.8.8 > /dev/null && echo Online || echo Offline");
  echo $out."\n";
  
?>
