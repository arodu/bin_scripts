#!/usr/bin/env php
<?php
session_id('mhh2i409cdadq9dg3rdqir3hsl');
session_start();

$comm = array_shift($argv);
$exp  = implode($argv);

$M = (isset($_SESSION['m']) ? $_SESSION['m'] : null);

$exp = str_replace("m", $M, $exp);

$_SESSION['m'] = eval("return ".$exp.";");
echo "> ".$_SESSION['m']."\n";

?>
