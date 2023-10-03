<?php

use App\Error\Shutter;

ini_set('max_execution_time', TIME_OUT);
$shutter = new Shutter();
register_shutdown_function(fn() => $shutter->shutdown());
?>