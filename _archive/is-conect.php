#!/usr/bin/php
<?php

  $out = exec("ping -q -w 1 -c 1 `ip r | grep default | cut -d ' ' -f 3` > /dev/null && echo Online || echo Offline");
  echo $out."\n";
  
?>
