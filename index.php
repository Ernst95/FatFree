<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();
 
$f3->config('App/Config/setup.cfg');

$f3->config('App/Config/routes.cfg');
 
$f3->run();

?>