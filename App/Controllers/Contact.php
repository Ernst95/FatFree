<?php

class Contact extends Controller{
    
    function index() {
        echo 'Hello world from contact';
    }

    function getAllUsers() {
        
        $db = new DB\SQL (
            'mysql:host=localhost;port=3306;dbname=salon',
            'root',
            ''
        );

        $result = $db->exec(
            array('SELECT * FROM user')
        );

        var_dump($result);

    }
}

?>