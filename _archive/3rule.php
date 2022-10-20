#!/usr/bin/php

<?php
	/*
	 *      b ---> a
	 *  	y ---> ?
	 *
	 *    $x = ($y*$a)/$b
	 */

	$a = $argv[2];
	$b = $argv[1];
	$y = $argv[3];
	
	$x = ($y*$a)/$b;

	echo "\t".$b."\t---->\t".$a."\n";
	echo "\t".$y."\t---->\t?\n";
	echo "\tResultado: ".$x."\n";
?>
