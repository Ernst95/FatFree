<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();

date_default_timezone_set("Africa/Johannesburg");
 
$f3->config('App/Config/setup.ini');

$f3->config('App/Config/routes.ini');
 
$f3->run();

?>