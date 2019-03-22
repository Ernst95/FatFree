<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();

date_default_timezone_set("Africa/Johannesburg");

$f3->config('app/config/routes/routes.ini');

$f3->config('app/config/environment.ini');

if($f3->get('env') == "dev") {

    $f3->config('app/config/dev/setup.ini');

    $f3->config('app/config/dev/mysql.ini');

}

if($f3->get('env') == "prod"){

    $f3->config('app/config/prod/setup.ini');

    $f3->config('app/config/prod/mysql.ini');

}
 
$f3->run();

?>