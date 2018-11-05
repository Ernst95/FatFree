<?php

class Controller {

    protected $f3;
    protected $db;

    function beforeroute() {
        //echo 'Before route - ';
    }

    function afterroute() {
        //echo '- After route';
    }

    function __construct() {
        
        $f3 = Base::instance();
        $this->f3 = $f3;

        $db = new DB\SQL(
            'mysql:host=localhost;port=3306;dbname=salon',
            'root',
            '',
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
        );

        $this->db = $db;
    }
    
}

?>