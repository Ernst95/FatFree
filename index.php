<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();

/*header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

header("Access-Control-Allow-Headers: *");*/

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

$f3->set('ONERROR', 
    function($f3) {
        echo json_encode(array(
            'success' => false,
            'message' => $f3->get('ERROR.text'),
            'code' => $f3->get('ERROR.code')
        ));
    }
);
 
$f3->run();

?>