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
            $f3->get('mysql.db'),
            $f3->get('mysql.username'),
            $f3->get('mysql.password'),
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
        );

        $this->db = $db;
    }
    
}

?>