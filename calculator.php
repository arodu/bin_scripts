#!/usr/bin/env php
<?php
session_id('mhh2i409cdadq9dg3rdqir3hsl');
session_start();

array_shift($argv); // remove first element
$exp  = implode($argv);

echo "= " . eval_expression($exp) . "\n";

// - being: functions
function eval_expression($exp)
{
    $exp = load_memory($exp);
    $out = eval("return " . $exp . ";");
    save_memory($out);
    return $out;
}

function load_memory($exp)
{
    if (isset($_SESSION['m'])) {
        $exp = str_replace("m", $_SESSION['m'], $exp);
    }
    return $exp;
}

function save_memory($data)
{
    $_SESSION['m'] = $data;
}

function help()
{
    echo "Help options:\n";
}

// - end: functions
