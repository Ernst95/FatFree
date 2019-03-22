<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();

date_default_timezone_set("Africa/Johannesburg");

$f3->config('App/Config/routes/routes.ini');

$f3->config('App/Config/environment.ini');

if($f3->get('env') == "dev") {

    $f3->config('App/Config/dev/setup.ini');

    $f3->config('App/Config/dev/mysql.ini');

}

if($f3->get('env') == "prod"){

    $f3->config('App/Config/prod/setup.ini');

    $f3->config('App/Config/prod/mysql.ini');

}
 
$f3->run();

?>