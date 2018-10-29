<?php

require_once('vendor/autoload.php');
 
$f3 = Base::instance();
 
$f3->set('AUTOLOAD', 'App/Controllers/');

$f3->route('GET /', 'Homepage->index');
 
$f3->run();

?>