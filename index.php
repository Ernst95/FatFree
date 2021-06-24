<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();

/*header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

header("Access-Control-Allow-Headers: *");*/

date_default_timezone_set("Africa/Johannesburg");

$f3->config('app/config/routes/routes.ini');

$f3->set('ENVIRONMENT', getenv('APPLICATION_ENV'));
$f3->set('USER', getenv('DB_USER'));
$f3->set('PASS', getenv('DB_PASS'));
$f3->set('HOST', getenv('DB_HOST'));
$f3->set('DBNAME', getenv('DB_NAME'));

if($f3->get('ENVIRONMENT') == "development") {
    $f3->config('app/config/dev/setup.ini');
}

if($f3->get('ENVIRONMENT') == "production"){
    $f3->config('app/config/prod/setup.ini');
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