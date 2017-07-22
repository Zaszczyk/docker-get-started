<?php

$start = microtime(true);

$result = array();
$result['version'] = '1.1';
$result['sysinfo']['time'] = date("Y-m-d H:i:s");
$result['sysinfo']['php_version'] = PHP_VERSION;
$result['sysinfo']['platform'] = PHP_OS;
$result['sysinfo']['server_name'] = $_SERVER['SERVER_NAME'];
$result['sysinfo']['server_addr'] = $_SERVER['SERVER_ADDR'];


for ($i = 0; $i < 3; $i++) {
    test_math($result);
}
$end = microtime(true);


var_dump($end - $start);
echo '<br />' . $_SERVER['SERVER_ADDR'];


function test_math(&$result, $count = 99999)
{
    $timeStart = microtime(true);
    $mathFunctions = array("abs", "acos", "asin", "atan", "bindec", "floor", "exp", "sin", "tan", "pi", "is_finite", "is_nan", "sqrt");
    for ($i = 0; $i < $count; $i++) {
        foreach ($mathFunctions as $function) {
            call_user_func_array($function, array($i));
        }
    }
    $result['benchmark']['math'] = timer_diff($timeStart);
}

function timer_diff($timeStart)
{
    return number_format(microtime(true) - $timeStart, 3);
}